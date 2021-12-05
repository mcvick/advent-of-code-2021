<?php
    //https://adventofcode.com/2021/day/4

    $bingoData = file_get_contents('input.txt');
    $bingoData  = preg_split("/\r\n\r\n/", $bingoData);

    ///////Part 1
    $bingoCards = $bingoData;
    $bingoCallouts = array_shift($bingoCards);
    
    //Build Storage Array
    foreach($bingoCards as $cardNum => $bingoCard){
        $bingoCards[$cardNum] = [];
        $bingoCards[$cardNum]['board'] = $bingoCard;
        $bingoCards[$cardNum]['cardNumbers'] = preg_split('/(\r\n|\s{1,2})/',$bingoCard);
        $bingoCards[$cardNum]['winSets'] = preg_split('/\r\n/',$bingoCard);

        $colWinSets = [];
        foreach($bingoCards[$cardNum]['winSets'] as $row => $rowNumberSet){
            //win set list from string to arrays
            $bingoCards[$cardNum]['winSets'][$row] = preg_split('/\s{1,2}/', $rowNumberSet);

            foreach($bingoCards[$cardNum]['winSets'][$row] as $colNumber => $cardNumber){ 
                $colWinSets[$colNumber][] = $cardNumber; 
            }

        }
        $bingoCards[$cardNum]['winSets'] = array_merge($bingoCards[$cardNum]['winSets'], $colWinSets);
    }

    $bingoCallouts = explode(',', $bingoCallouts);
    $calledNumbers = array_slice($bingoCallouts, 0, 4);
    $maxLoops = count($bingoCallouts) - 4;
    $winners = [];
    
    //Check for Winners
    while(empty($winners) && $maxLoops){
        $calledNumbers[] = $bingoCallouts[count($calledNumbers)];
        foreach($bingoCards as $cardNum => $bingoCard){
            foreach($bingoCard['winSets'] as $winSet){
                $matches = array_intersect($winSet, $calledNumbers);

                if(count($matches) == 5){
                    $winners[$cardNum]['cardNumbers'] = $bingoCard['cardNumbers'];
                    $winners[$cardNum]['winningSet'] = $matches;
                }
            }
        }

        $maxLoops--;
    }

    if(empty($winners)){
        echo 'No winners.';
    }else{
        //Calculate Winners Score
        foreach($winners as $cardNum => $winner){
            $notUsedNumbers = array_diff($winner['cardNumbers'],$calledNumbers);
            $winners[$cardNum] = array_sum($notUsedNumbers) * end($calledNumbers);
        }
    
        asort($winners);
        $winningBoard = key($winners);

        echo 'Part 1: Board number ' . $winningBoard . ' - Score ' . $winners[$winningBoard];

    } 


    ///////Part 2

    $calledNumbers2 = array_slice($bingoCallouts, 0, 4);
    $cardCount2 = count($bingoCallouts);
    $maxLoops2 = $cardCount2 - 4;
    $winners2 = [];
    
    //Check for Last Winner
    while(count($winners2) < $cardCount2 && $maxLoops2){
        $calledNumbers2[] = $bingoCallouts[count($calledNumbers2)];
        foreach($bingoCards as $cardNum => $bingoCard){
            foreach($bingoCard['winSets'] as $winSet){
                $matches = array_intersect($winSet, $calledNumbers2);

                if(count($matches) == 5){
                    $winners2[$cardNum]['cardNumbers'] = $bingoCard['cardNumbers'];
                    $winners2[$cardNum]['winningSet'] = $matches;
                }
            }
        }

        $maxLoops2--;
    }

    if(empty($winners2)){
        echo 'No winners.';
    }else{
        //Calculate Last Winners Score
        $lastWinner = end($winners2);
        $lastBoard = array_key_last($winners2);
        $notUsedNumbers2 = array_diff($lastWinner['cardNumbers'],$calledNumbers2);
        $lastWinnerScore = array_sum($notUsedNumbers2) * end($calledNumbers2);
    

        echo '<br>Part 2: Board number ' . $lastBoard . ' - Score ' . $lastWinnerScore;

    } 