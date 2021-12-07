<?php
    //https://adventofcode.com/2021/day/6

    $fishReport = file_get_contents('input.txt');
    $fishReport = explode(",", $fishReport);

    //PART 1
    $daysIntoFuture = 80;
    $perDayAmounts = [
        timeMachine(0,$daysIntoFuture),
        timeMachine(1,$daysIntoFuture),
        timeMachine(2,$daysIntoFuture),
        timeMachine(3,$daysIntoFuture),
        timeMachine(4,$daysIntoFuture),
        timeMachine(5,$daysIntoFuture),
        timeMachine(6,$daysIntoFuture),
        timeMachine(7,$daysIntoFuture),
        timeMachine(8,$daysIntoFuture),
    ];
    
    $totalFishes = 0;
    foreach($fishReport as $fish){
        $totalFishes += $perDayAmounts[$fish];
    }
    
    echo 'Part 1: Number of fish - ' . $totalFishes;
    
    //PART 2
    $daysIntoFuture = 256;
    $perDayAmounts = [
        timeMachine(0,$daysIntoFuture),
        timeMachine(1,$daysIntoFuture),
        timeMachine(2,$daysIntoFuture),
        timeMachine(3,$daysIntoFuture),
        timeMachine(4,$daysIntoFuture),
        timeMachine(5,$daysIntoFuture),
        timeMachine(6,$daysIntoFuture),
        timeMachine(7,$daysIntoFuture),
        timeMachine(8,$daysIntoFuture),
    ];
    
    $totalFishes = 0;
    foreach($fishReport as $fish){
        $totalFishes += $perDayAmounts[$fish];
    }
    
    echo '<br>Part 2: Number of fish - ' . $totalFishes;

    function timeMachine($daysTillDueDate, $daysIntoFuture){
        $fishCount = [0,0,0,0,0,0,0,0,0];
        $fishCount[$daysTillDueDate] = 1;
        for($d = 1; $d <= $daysIntoFuture; $d++){
            $newMothers = array_shift($fishCount);

            $fishCount[6] += $newMothers;
            $fishCount[] = $newMothers;
            $fishCount = array_values($fishCount);
        }
        
        return array_sum($fishCount);
    }