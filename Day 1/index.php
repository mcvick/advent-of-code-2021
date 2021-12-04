<?php
    //https://adventofcode.com/2021/day/1

    $report = file_get_contents('input.txt');
    $report = preg_split("/\n/", $report);

    //PART 1
    $reportPart1 = $report;
    $increasePart1 = 0;
    $prevDepth = (int)array_shift($reportPart1);

    foreach($reportPart1 as $depth){
        if($prevDepth < $depth) $increasePart1++;
        $prevDepth = (int)$depth;
    }

    echo 'Part 1 increase: '. $increasePart1;
    

    //PART 2
    $reportPart2 = $report;
    $increasePart2 = 0;
    $rollingDepths = [(int)array_shift($reportPart2),(int)array_shift($reportPart2),(int)array_shift($reportPart2)];
    $prevDepthSum = array_sum($rollingDepths);

    foreach($reportPart2 as $depth){
        //trash oldest depth
        array_shift($rollingDepths);
        //add next depth
        $rollingDepths[] = (int)array_shift($reportPart2);
        //sum current depth set
        $currentDepthSum = array_sum($rollingDepths);

        if($prevDepthSum < $currentDepthSum) $increasePart2++;
        $prevDepthSum = $currentDepthSum;
    }

    echo '<br>Part 2 increase: '. $increasePart2;
