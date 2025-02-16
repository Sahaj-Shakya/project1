<?php

$rooms = []; // This should be populated with room numbers
$bca = []; // Populate this array with the BCA student list
$bbm = []; // Populate this array with the BBM student list

// Function to randomize an array (students list)
function randomizeArray($list) {
    shuffle($list);
    return $list;
}

// Function to plan the seating arrangement
function planSeat($bca, $bbm) {
    $randomized_bca = randomizeArray($bca);
    $randomized_bbm = randomizeArray($bbm);

    $a = []; // Left side of left column
    $b = []; // Right side of left column
    $c = []; // Left side of right column
    $d = []; // Right side of right column

    $maxLength = max(count($randomized_bca), count($randomized_bbm));

    for ($i = 0; $i < $maxLength; $i++) {
        if ($i % 2 == 0) {
            $a[] = $randomized_bca[$i] ?? null;
            $b[] = $randomized_bbm[$i] ?? null;
        } else {
            $c[] = $randomized_bca[$i] ?? null;
            $d[] = $randomized_bbm[$i] ?? null;
        }
    }

    return ['a' => $a, 'b' => $b, 'c' => $c, 'd' => $d];
}

// Function to assign rooms to students
function assignRoom($a, $b, $c, $d, $rooms) {
    $seatPlanDict = [];
    $totalRooms = count($rooms);
    $allStudents = ['a' => $a, 'b' => $b, 'c' => $c, 'd' => $d]; // Combine all sides into one array

    // Calculate the number of students per room
    $totalStudents = count($a) + count($b) + count($c) + count($d);
    $studentsPerRoom = ceil($totalStudents / $totalRooms);

    // Assign students to rooms
    foreach ($rooms as $index => $roomNo) {
        $seatPlanDict[$roomNo] = ['a' => [], 'b' => [], 'c' => [], 'd' => []];

        // Assign students to each side of the room
        foreach (['a', 'b', 'c', 'd'] as $side) {
            $start = $index * ($studentsPerRoom / 4); // Divide students equally among sides
            $seatPlanDict[$roomNo][$side] = array_slice($allStudents[$side], $start, $studentsPerRoom / 4);
        }
    }

    return $seatPlanDict;
}

// Store the seat plan in the database
function storeSeatPlan($roomAssignments, $conn, $selectedBca, $selectedBbm) {
    $isStored = true; // Flag to track whether the data is stored successfully

    foreach ($roomAssignments as $roomNo => $sides) {
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
                    $roll_no = $student['roll_no'];
                    $name = $student['name'];
                    $semester = $student['semester'];
                    $faculty = $student['faculty'];

                    $query = "INSERT INTO seat_plan (name, room_no, semester, roll_no, faculty, bench_no, side) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $query);

                    if (!$stmt) {
                        $isStored = false; // Set flag to false if statement preparation fails
                        break;
                    }

                    // Bind parameters
                    mysqli_stmt_bind_param($stmt, 'sssssss', $name, $roomNo, $semester, $roll_no, $faculty, $benchNoWithColumn, $benchSide);

                    if (!mysqli_stmt_execute($stmt)) {
                        $isStored = false; // Set flag to false if execute fails
                        break;
                    }
                }
            }
        }
    }

    return $isStored; // Return whether the data was stored successfully or not
}

?>