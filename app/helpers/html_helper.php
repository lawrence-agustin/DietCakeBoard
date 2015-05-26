<?php
function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function readable_text($string)
{
    if (!isset($string)) return;
    $string = htmlspecialchars($string, ENT_QUOTES);
    $string = nl2br(trim($string));
    echo $string;
}

function redirect($url)
{
	header("Location: " . $url);
	exit();
}

