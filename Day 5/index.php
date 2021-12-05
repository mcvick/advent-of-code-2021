<?php
    //https://adventofcode.com/2021/day/5
    $part = (isset($_GET['part']) ? $_GET['part'] : 1);

    $ventLocations = file_get_contents('input.txt');
    $ventLocations = preg_split("/\r\n/", $ventLocations);
    $lineLocations = [];

    foreach($ventLocations as $key => $ventLocation){
        $ventLocations[$key] = explode(" -> ", $ventLocation);
        foreach($ventLocations[$key] as $i => $coords){
            $ventLocations[$key][$i] = explode(",", $coords);
        }

        if(array_intersect($ventLocations[$key][0],$ventLocations[$key][1])){
            $lineLocations[] = $ventLocations[$key];
        }
        
    }

    ///////Part 1
    $part1hits = countDoubleHits($lineLocations);
    echo '<br>Part 1: Number of points hit twice or more, no diagonals - ' . $part1hits;


    ///PART 2
    $part2hits = countDoubleHits($ventLocations);
    echo '<br>Part 2: Number of points hit twice or more with diagonals - ' . $part2hits;
    

    
    function countDoubleHits($report){
        $hits = [];
        $doubleHitsCount = 0;

        foreach($report as $key => $coordinate){
            $startX = (int)$coordinate[0][0];
            $startY = (int)$coordinate[0][1];
            $endX = (int)$coordinate[1][0];
            $endY = (int)$coordinate[1][1];
            
            $currentX = $startX;
            $currentY = $startY; 
            $finalCoords = false;
            $maxLoops = 1000; //max distance coords shouldn't plot more then 1000 points

            while($maxLoops){
                //tally plot hit
                $currentPoint = $currentX . ',' . $currentY;
                $hits[$currentPoint] = (isset($hits[$currentPoint])?$hits[$currentPoint]:0) + 1;
                //only count tallies of exactly 2 or we will end up counting points multiple times
                if($hits[$currentPoint] == 2) $doubleHitsCount++;
                
                //break when we've tallied the last point of this coordinate
                if($currentX == $endX && $currentY == $endY) break;
                
                //increment coordinate
                if($currentX != $endX){
                    if($currentX < $endX){
                        $currentX++;
                    }else{
                        $currentX--;
                    }
                } 
                if($currentY != $endY){
                    if($currentY < $endY){
                        $currentY++;
                    }else{
                        $currentY--;
                    }
                } 

                $maxLoops--;
            }
        }

        return $doubleHitsCount;
    }
