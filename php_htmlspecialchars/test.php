<?php
//      Code Points   First Byte Second Byte Third Byte Fourth Byte
//   U+0800 -   U+0FFF   E0         A0 - BF     80 - BF
//   U+D000 -   U+D7FF   ED         80 - 9F     80 - BF
//  U+10000 -  U+3FFFF   F0         90 - BF     80 - BF    80 - BF
// U+100000 - U+10FFFF   F4         80 - 8F     80 - BF    80 - BF

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