<?php

// Function to randomize an array (students list)
function randomizeArray($list) {
    shuffle($list);
    return $list;
}

// Function to plan the seating arrangement
function planSeat($students) {
    $randomizedStudents = randomizeArray($students);

    $a = []; // Left side of left column
    $b = []; // Right side of left column
    $c = []; // Left side of right column
    $d = []; // Right side of right column

    $maxLength = count($randomizedStudents);

    for ($i = 0; $i < $maxLength; $i++) {
        if ($i % 2 == 0) {
            $a[] = $randomizedStudents[$i] ?? null;
        } else {
            $b[] = $randomizedStudents[$i] ?? null;
        }

        if ($i % 2 == 0) {
            $c[] = $randomizedStudents[$i] ?? null;
        } else {
            $d[] = $randomizedStudents[$i] ?? null;
        }
    }

    return ['a' => $a, 'b' => $b, 'c' => $c, 'd' => $d];
}

// Function to assign rooms to students
function assignRoom($a, $b, $c, $d, $selectedRooms) {
    $seatPlanDict = [];
    $totalRooms = count($selectedRooms);
    $allStudents = ['a' => $a, 'b' => $b, 'c' => $c, 'd' => $d]; // Combine all sides into one array

    // Calculate the number of students per room
    $totalStudents = count($a) + count($b) + count($c) + count($d);
    $studentsPerRoom = ceil($totalStudents / $totalRooms);

    // Assign students to rooms
    foreach ($selectedRooms as $index => $roomSn) {
        $seatPlanDict[$roomSn] = ['a' => [], 'b' => [], 'c' => [], 'd' => []];

        // Assign students to each side of the room
        foreach (['a', 'b', 'c', 'd'] as $side) {
            $start = $index * ($studentsPerRoom / 4); // Divide students equally among sides
            $seatPlanDict[$roomSn][$side] = array_slice($allStudents[$side], $start, $studentsPerRoom / 4);
        }
    }

    return $seatPlanDict;
}

// Store the seat plan in the database
function storeSeatPlan($roomAssignments, $conn, $selectedSemesters) {
    $isStored = true; // Flag to track whether the data is stored successfully

    // Begin a transaction for atomicity
    mysqli_begin_transaction($conn);

    try {
        // Check if $roomAssignments is empty
        if (empty($roomAssignments)) {
            throw new Exception("No room assignments to store.");
        }

        foreach ($roomAssignments as $roomSn => $sides) {
            // Validate room_sn before proceeding
            if (!validateRoomSn($roomSn, $conn)) {
                error_log("Invalid room_sn: $roomSn");
                continue; // Skip this room
            }

            foreach ($sides as $side => $studentsList) {
                foreach ($studentsList as $index => $student) {
                    if ($student !== null) {
                        // Determine the column (left or right) based on the side
                        $column = ($side === 'a' || $side === 'b') ? 'L' : 'R';

                        // Calculate bench number (1 to 8 per column)
                        $benchNo = ($index % 8) + 1; // 8 benches per column

                        // Format bench_no as 1(L) or 2(R), etc.
                        $benchNoWithColumn = $benchNo . '(' . $column . ')';

                        // Determine the side of the bench (left or right)
                        $benchSide = ($side === 'a' || $side === 'c') ? 'L' : 'R';

                        // Insert into the database
                        $roll_no = $student['roll_no']; // Use roll_no instead of student_sn
                        $name = $student['name'];
                        $semester = $student['semester'];
                        $faculty = $student['faculty'];

                        // Check for missing required fields
                        if (empty($roomSn) || empty($roll_no) || empty($benchNoWithColumn)) {
                            error_log("Missing required fields: room_sn=$roomSn, roll_no=$roll_no, bench_no=$benchNoWithColumn");
                            continue; // Skip this record
                        }

                        // Insert query
                        $query = "INSERT INTO seat_plan (name, roll_no, semester, faculty, bench_no, side, room_sn) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_prepare($conn, $query);

                        if (!$stmt) {
                            throw new Exception("Failed to prepare statement: " . mysqli_error($conn));
                        }

                        // Bind parameters
                        mysqli_stmt_bind_param($stmt, 'sissssi', $name, $roll_no, $semester, $faculty, $benchNoWithColumn, $benchSide, $roomSn);

                        if (!mysqli_stmt_execute($stmt)) {
                            throw new Exception("Failed to execute statement: " . mysqli_error($conn));
                        }
                    }
                }
            }
        }

        // Commit the transaction if all queries succeed
        mysqli_commit($conn);
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($conn);
        error_log($e->getMessage());
        $isStored = false;
    }

    return $isStored; // Return whether the data was stored successfully or not
}

// Function to validate room_sn
function validateRoomSn($roomSn, $conn) {
    $query = "SELECT * FROM rooms WHERE sn = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $roomSn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) > 0;
}
?>