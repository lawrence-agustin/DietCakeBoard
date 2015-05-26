<?php
function validate_between($check, $min, $max)            
{
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function validate_name($string)
{
    return preg_match('/^[a-zA-Z -]+$/', $string);
}

function validate_email($string)
{
    if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}