<?php

$rooms = [];
$bca = [];
$bbm = [];

function randomizeArray($list) {
    shuffle($list);
    return $list;   
}

function planSeat($bca, $bbm) {
    $randomized_bca = randomizeArray($bca);
    $randomized_bbm = randomizeArray($bbm);

    $a = []; // Left side of left column
    $b = []; // Right side of left column
    $c = []; // Left side of right column
    $d = []; // Right side of right column

    $maxLength = max(count($randomized_bca), count($randomized_bbm));

    for ($i = 0; $i < $maxLength; $i++){
        if ($i % 2 == 0){
            $a[] = $randomized_bca[$i] ?? null;
            $b[] = $randomized_bbm[$i] ?? null;
        }else{
            $c[] = $randomized_bca[$i] ?? null;
            $d[] = $randomized_bbm[$i] ?? null;
        }
    }

    return ['a' => $a, 'b' => $b, 'c' => $c, 'd' => $d];
}

function assignRoom($a, $b, $c, $d, $rooms) {
    $seatPlanDict = [];
    $totalRooms = count($rooms);
    $currentRoom = 0;

    $seatPlanDict[$rooms[$currentRoom]] = [
        'a' => array_slice($a, 0, 8),
        'b' => array_slice($b, 0, 8),
        'c' => array_slice($c, 0, 8),
        'd' => array_slice($d, 0, 8)
    ];

    $currentRoom++;
    if ($currentRoom < $totalRooms) {
        $seatPlanDict[$rooms[$currentRoom]] = [
            'a' => array_slice($a, 8),
            'b' => array_slice($b, 8),
            'c' => array_slice($c, 8),
            'd' => array_slice($d, 8)
        ];
    }

    return $seatPlanDict; 
}

// Get the seat plan
$seatPlan = planSeat($bca, $bbm);
extract($seatPlan); // Extract $a, $b, $c, $d from the returned array

// Assign students to rooms and store the result in an object
$roomAssignments = assignRoom($a, $b, $c, $d, $rooms);

// echo json_encode($roomAssignments, JSON_PRETTY_PRINT);

?>