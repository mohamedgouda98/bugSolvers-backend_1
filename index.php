<?php

/**
 * create function and take 2 param [value - array].
 * validate if value is in array or not
 */


var_dump(checkInArray(30,[10,30,40]));
echo '<hr>';
var_dump(checkInArray(9,[1,2,3,4,5]));



function checkInArray($value, $array)
{

    for ($i=0; $i< count($array); $i++)
    {
        if($array[$i] == $value)
        {
            return true;
        }
    }

    return false;
}


?>
