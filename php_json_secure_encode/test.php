<?php

var_dump('"\u003C\u003E\u0026\u0027\u0022"' === json_secure_encode('<>&\'"'));