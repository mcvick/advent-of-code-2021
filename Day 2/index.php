<?php
    //https://adventofcode.com/2021/day/2

    $plannedCourse = file_get_contents('input.txt');
    $plannedCourse = preg_split("/\n/", $plannedCourse);

    //Part 1
    $plannedCoursePart1 = $plannedCourse;
    $positionPart1 = [0,0]; //horizontal,depth

    foreach($plannedCoursePart1 as $move){
        $move = explode(' ',$move);
        switch ($move[0]) {
            case 'forward':
                $positionPart1[0] += (int)$move[1];
                break;
            case 'up':
                $positionPart1[1] -= (int)$move[1];
                break;
            case 'down':
                $positionPart1[1] += (int)$move[1];
                break;
        }
    }

    echo 'Part 1 (Horizontal*Depth): ' . ($positionPart1[0]*$positionPart1[1]);

    //Part 2
    $plannedCoursePart2 = $plannedCourse;
    $positionPart2 = [0,0,0]; //horizontal,depth,aim

    foreach($plannedCoursePart2 as $move){
        $move = explode(' ',$move);
        switch ($move[0]) {
            case 'forward':
                $positionPart2[0] += (int)$move[1];
                $positionPart2[1] += $positionPart2[2]*(int)$move[1];
                break;
            case 'up':
                $positionPart2[2] -= (int)$move[1];
                break;
            case 'down':
                $positionPart2[2] += (int)$move[1];
                break;
        }
    }

    echo '<br>Part 2 (Horizontal*Depth): ' . ($positionPart2[0]*$positionPart2[1]);