<?php

function search($needle)
{
    $fileName = 'images.txt';
    $file = fopen($fileName, 'r');
    while(!feof($file))
    {
        $line = fgets($file);
        if(strpos($line, $needle) !== false)
        {
            return true;
        }
    }
    return false;
}

//echo search($fileName, $needle);