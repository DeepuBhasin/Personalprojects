<?php

function sum($number)
{
    if ($number == 0) {
        return 0;
    }

    return $number + sum($number - 1);
}


$output = sum(3);
echo $output;

/*
1. 3 => 3 + 3
2. 2 => 2 + 1
3. 1 => 1 + 0
4. 0 => 0

*/
