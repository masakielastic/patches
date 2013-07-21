Benchmark for Request #65082	
============================

See https://bugs.php.net/bug.php?id=65082 for the details.

Common code for benchmark
-------------------------

```php
function timer(callable $callable, $runs = 10000) {

    $start = microtime(true);

    do {
        $callable();
    } while(--$runs);

    $stop = microtime(true);

    return $stop - $start;

}

$array = array_fill(0, 100, str_repeat("\x24"."\xC2\xA2"."\xE2\x82\xAC"."\xF0\xA4\xAD\xA2", 100));
```

json_utf8_to_utf16 vs json_utf8_to_utf32
----------------------------------------

### Benchmark code

```php
$array = array_fill(0, 100, str_repeat("\x24"."\xC2\xA2"."\xE2\x82\xAC"."\xF0\xA4\xAD\xA2", 100));

echo 'no option', PHP_EOL,
    timer(function() use ($array) { json_encode($array); }), PHP_EOL;
```

### Result

name: no patch
average(s): 11.57733232975

name: 02_json_utf8_to_utf32_without_new_options.c   
average(s): 11.559496402741

### Data

no patch
11.556622028351
11.563809156418
11.582066059113
11.592036008835
11.540698051453
11.563404083252
11.538574934006
11.572077989578
11.643928050995
11.620106935501

02_json_utf8_to_utf32_without_new_options.c
11.714975118637
11.439930915833
11.443930864334
11.426358938217
11.445488929749
11.483592987061
11.371997117996
11.772797107697
11.705342054367
11.790549993515

Byte access vs json_utf8_to_utf32
---------------------------------

### Benchmark code

```php
$array = array_fill(0, 100, str_repeat("\x24"."\xC2\xA2"."\xE2\x82\xAC"."\xF0\xA4\xAD\xA2", 100));

echo 'JSON_UNESCAPED_UNICODE', PHP_EOL,
    timer(function() use ($array) { json_encode($array, JSON_UNESCAPED_UNICODE); }), PHP_EOL;
```

### Result

name: no patch
average(s): 10.251899194717

name: 02_json_utf8_to_utf32_without_new_options.c 
average(s): 8.7696504116058

### Data

no patch
10.568419933319
10.583604097366
10.069458007812
10.490511894226
10.086683034897
10.047739982605
10.035900115967
10.397008895874
10.191834926605
10.047831058502

02_json_utf8_to_utf32_without_new_options.c
9.0121171474457
9.1226680278778
8.6015610694885
8.5934910774231
8.6290209293365
8.8736889362335
9.0154299736023
8.6388158798218
8.5978729724884
8.6118381023407

utf8_to_utf32 vs php_next_utf8_char
-----------------------------------

### Benchmark code

```php
$array = array_fill(0, 100, str_repeat("\x24"."\xC2\xA2"."\xE2\x82\xAC"."\xF0\xA4\xAD\xA2", 100));

echo 'JSON_NOTUTF8_SUBSTITUTE', PHP_EOL,
    timer(function() use ($array) { json_encode($array, JSON_NOTUTF8_SUBSTITUTE); }), PHP_EOL;
```

### Result

name: 03_json_utf8_to_utf32.c
average(s): 11.869680118561

name: 04_php_next_utf8_char_in_json_escape_string.c
average(s): 11.734688210488

### Data

03_json_utf8_to_utf32.c
12.274589061737
12.303457021713
11.701003074646
11.773336172104
11.722233057022
11.733282804489
11.843135118484
11.759351968765
11.803786039352
11.782626867294

04_php_next_utf8_char_in_json_escape_string.c
11.593976020813
12.252948045731
12.145417928696
11.684551000595
11.628424882889
11.595145940781
11.582008123398
11.651746988297
11.609498023987
11.603165149689

utf8_to_utf32 vs php_next_utf8_char
-----------------------------------

### Benchmark code

```php
$array = array_fill(0, 100, str_repeat("\x24"."\xC2\xA2"."\xE2\x82\xAC"."\xF0\xA4\xAD\xA2", 100));

echo 'JSON_NOTUTF8_SUBSTITUTE|JSON_UNESCAPED_UNICODE', PHP_EOL,
    timer(function() use ($array) { json_encode($array, JSON_NOTUTF8_SUBSTITUTE|JSON_UNESCAPED_UNICODE); }), PHP_EOL;
```

### Result

name: 03_json_utf8_to_utf32.c
average(s): 9.0312395334244

name: 04_php_next_utf8_char_in_json_escape_string.c
average(s): 8.5260551214218

### Data

03_json_utf8_to_utf32.c
9.2738838195801
8.9508287906647
8.9606170654297
9.0159950256348
9.0346999168396
8.9346950054169
8.9902551174164
8.9374408721924
9.3183097839355
8.8956699371338

04_php_next_utf8_char_in_json_escape_string.c
8.6885390281677
8.3932950496674
8.8615410327911
8.8210861682892
8.4182300567627
8.3813960552216
8.4350378513336
8.4221830368042
8.4023628234863
8.4368801116943
