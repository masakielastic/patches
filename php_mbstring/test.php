<?php
mb_substitute_character(0xFFFD);
var_dump(
    "\xEF\xBF\xBD"."\xEF\xBF\xBD" === mb_convert_encoding("\xE0\x80", 'UTF-8', 'UTF-8'),
    "\xEF\xBF\xBD"."\xEF\xBF\xBD" === mb_convert_encoding("\xED\xA0", 'UTF-8', 'UTF-8'),
    "\xEF\xBF\xBD"."\xEF\xBF\xBD" === mb_convert_encoding("\xF0\x80", 'UTF-8', 'UTF-8'),
    "\xEF\xBF\xBD"."\xEF\xBF\xBD" === mb_convert_encoding("\xF0\x90", 'UTF-8', 'UTF-8')
);