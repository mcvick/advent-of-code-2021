<?php
    //https://adventofcode.com/2021/day/3

    $diagReport = file_get_contents('input.txt');
    $diagReport  = preg_split("/\r\n/", $diagReport);

    ///////Part 1
    $diagReportPart1 = $diagReport;
    $anylizeDiag = [];
    $threshold = count($diagReport)/2;
    $gamma = '';
    $espilon = '';

    //setup for appropriate amount of digits
    for ($i = 0; $i < strlen($diagReportPart1[0]); $i++){
        $anylizeDiag[] = 0;
    }

    //process report
    foreach($diagReportPart1 as $entry){
        $entry = str_split($entry);
        
        //add up each "column" in the numbers
        foreach($entry as $pos => $val){
            $anylizeDiag[$pos] += (int)$val;
        }
    }

    //analyze data
    foreach($anylizeDiag as $pos => $val){
        //if total is more the half of the amount of entries, then 1 wins
        $gamma .= (int)($val > $threshold);
        //opposite for espilon
        $espilon .= (int)($val < $threshold);
    }

    echo 'Part 1: ' . (bindec($gamma)*bindec($espilon));

    ///////Part 2
    $diagReportPart2 = $diagReport;

    $oxyResult = processReport($diagReportPart2,'oxy');
    $co2Result = processReport($diagReportPart2,'co2');

    echo '<br>Part 2: ' . ($oxyResult*$co2Result);

    function processReport($data, $type){
        //sort array so that we can evaluate the middle entry to see what is more common
        //sorted descending which will use "1" entries when they are equal amounts
        arsort($data);
        $data = array_values($data);
        $reportCount = count($data);
        $maxLoops = strlen($data[0]);
        $evalPosition = 0;
        $winningDigit;

        while($reportCount > 1 && $maxLoops){
            //find middle entry
            $middleIndex = ceil($reportCount/2)-1;
            $middleEntry = $data[$middleIndex];
            //pull number for the position we are currently looking at
            $winningDigit = $middleEntry[$evalPosition];
            
            //filter out entries based on the report type
            $data = array_filter($data, function($elem) use($evalPosition,$winningDigit,$type){
                if($type == 'oxy'){
                    return $elem[$evalPosition] == $winningDigit;
                }else{
                    return $elem[$evalPosition] != $winningDigit;
                }
            });
            //reset index numbers
            $data = array_values($data);
    
            $reportCount = count($data);
            $evalPosition++;
            $maxLoops--;
        }
        
        //convert binary
        return bindec($data[0]);

    }