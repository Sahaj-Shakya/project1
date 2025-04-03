<?php

function randomizeArray($list)
{
    shuffle($list);
    return $list;
}

function planSeat($students)
{
    $randomizedStudents = randomizeArray($students);

    $a = []; // Left side of left column
    $b = []; // Right side of left column
    $c = []; // Left side of right column
    $d = []; // Right side of right column

    $maxLength = count($randomizedStudents);

    for ($i = 0; $i < $maxLength; $i++) {
        if ($i % 4 == 0) {
            $a[] = $randomizedStudents[$i] ?? null;
        } elseif ($i % 4 == 1) {
            $b[] = $randomizedStudents[$i] ?? null;
        } elseif ($i % 4 == 2) {
            $c[] = $randomizedStudents[$i] ?? null;
        } elseif ($i % 4 == 3) {
            $d[] = $randomizedStudents[$i] ?? null;
        }
    }

    return ['a' => $a, 'b' => $b, 'c' => $c, 'd' => $d];
}

function assignRoom($a, $b, $c, $d, $selectedRooms)
{
    $seatPlanDict = [];
    $totalRooms = count($selectedRooms);

    $allStudents = array_merge($a, $b, $c, $d);
    $totalStudents = count($allStudents);

    $studentsPerRoom = ceil($totalStudents / $totalRooms);

    foreach ($selectedRooms as $index => $roomSn) {
        $seatPlanDict[$roomSn] = ['a' => [], 'b' => [], 'c' => [], 'd' => []];

        $start = $index * $studentsPerRoom;
        $end = $start + $studentsPerRoom;

        for ($i = $start; $i < $end; $i++) {
            if (isset($allStudents[$i])) {
                $student = $allStudents[$i];

                if (in_array($student, $a)) {
                    $seatPlanDict[$roomSn]['a'][] = $student;
                } elseif (in_array($student, $b)) {
                    $seatPlanDict[$roomSn]['b'][] = $student;
                } elseif (in_array($student, $c)) {
                    $seatPlanDict[$roomSn]['c'][] = $student;
                } elseif (in_array($student, $d)) {
                    $seatPlanDict[$roomSn]['d'][] = $student;
                }
            }
        }
    }

    return $seatPlanDict;
}

function storeSeatPlan($roomAssignments, $conn, $selectedSemesters)
{
    $isStored = true; 
    $rm_old_value_query = "TRUNCATE TABLE `project1`.`seat_plan`";
    $rm_old_value_result = mysqli_query($conn, $rm_old_value_query);

    if ($rm_old_value_result) {
        mysqli_begin_transaction($conn);

        try {
         
            if (empty($roomAssignments)) {
                throw new Exception("No room assignments to store.");
            }

            foreach ($roomAssignments as $roomSn => $sides) {
       
                if (!validateRoomSn($roomSn, $conn)) {
                    error_log("Invalid room_sn: $roomSn");
                    continue; 
                }

                foreach ($sides as $side => $studentsList) {
                    foreach ($studentsList as $index => $student) {
                        if ($student !== null) {
                            $roll_no = $student['roll_no'];

                            $checkQuery = "SELECT * FROM seat_plan WHERE roll_no = '$roll_no'";
                            $checkResult = mysqli_query($conn, $checkQuery);

                            if (mysqli_num_rows($checkResult) > 0) {
                                continue;
                            }

                            $column = ($side === 'a' || $side === 'b') ? 'L' : 'R';

                            $benchNo = ($index % 8) + 1; 

                            $benchNoWithColumn = $benchNo . '(' . $column . ')';

                            $benchSide = ($side === 'a' || $side === 'c') ? 'L' : 'R';

                            $name = $student['name'];
                            $semester = $student['semester'];
                            $faculty = $student['faculty'];

                            $query = "INSERT INTO seat_plan (name, roll_no, semester, faculty, bench_no, side, room_sn) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_prepare($conn, $query);

                            if (!$stmt) {
                                throw new Exception("Failed to prepare statement: " . mysqli_error($conn));
                            }

                            mysqli_stmt_bind_param($stmt, 'sissssi', $name, $roll_no, $semester, $faculty, $benchNoWithColumn, $benchSide, $roomSn);

                            if (!mysqli_stmt_execute($stmt)) {
                                throw new Exception("Failed to execute statement: " . mysqli_error($conn));
                            }
                        }
                    }
                }
            }

            mysqli_commit($conn);
        } catch (Exception $e) {
            mysqli_rollback($conn);
            error_log($e->getMessage());
            $isStored = false;
        }
    }

    return $isStored; 
}

function validateRoomSn($roomSn, $conn)
{
    $query = "SELECT * FROM rooms WHERE sn = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $roomSn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) > 0;
}