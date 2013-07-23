<?php

function str_scrub($str)
{
    return htmlspecialchars_decode(htmlspecialchars($str, ENT_SUBSTITUTE, 'UTF-8'));
}

$ufffd_x2 = "\xEF\xBF\xBD"."\xEF\xBF\xBD";
$ufffd_x3 = $ufffd_x2."\xEF\xBF\xBD";
$ufffd_x4 = $ufffd_x3."\xEF\xBF\xBD";

var_dump([
    $ufffd_x2 === str_scrub("\xE0\x80"),
    $ufffd_x3 === str_scrub("\xE0\x80\x80"),
    $ufffd_x2 === str_scrub("\xED\xBF"),
    $ufffd_x3 === str_scrub("\xED\xBF\x80")
],[
    $ufffd_x2 === str_scrub("\xF0\x80"),
    $ufffd_x3 === str_scrub("\xF0\x80\x80"),
    $ufffd_x4 === str_scrub("\xF0\x80\x80\x80"),
    $ufffd_x2 === str_scrub("\xF4\x90"),
    $ufffd_x3 === str_scrub("\xF4\x90\x80"),
    $ufffd_x4 === str_scrub("\xF4\x90\x80\x80") 
]);