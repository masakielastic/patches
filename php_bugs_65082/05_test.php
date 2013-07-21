<?php
class JsonTest implements JsonSerializable {
    private $test;
    public function __construct($test) {
        $this->test = $test;
    }
    public function jsonSerialize() {
        return $this->test;
    }
}
 
var_dump(
    '{"a\ufffd":"a\ufffd"}' === json_encode(new JsonTest(["a\x80" => "a\x80"]), JSON_NOTUTF8_SUBSTITUTE),
    '{"'."a\xEF\xBF\xBD".'":"'."a\xEF\xBF\xBD".'"}' === json_encode(new JsonTest(["a\x80" => "a\x80"]), JSON_UNESCAPED_UNICODE | JSON_NOTUTF8_SUBSTITUTE),
    '{"a":"a"}' === json_encode(new JsonTest(["a\x80" => "a\x80"]), JSON_NOTUTF8_IGNORE),
    '{"a":"a"}' === json_encode(new JsonTest(["a\x80" => "a\x80"]), JSON_UNESCAPED_UNICODE | JSON_NOTUTF8_IGNORE),
    // https://en.wikipedia.org/wiki/UTF-8#Examples
    // U+0024
    '"'."\x24".'"' === json_encode("\x24", JSON_UNESCAPED_UNICODE),
    // U+00A2
    '"'."\xC2\xA2".'"' === json_encode("\xC2\xA2", JSON_UNESCAPED_UNICODE),
    // U+20AC
    '"'."\xE2\x82\xAC".'"' === json_encode("\xE2\x82\xAC", JSON_UNESCAPED_UNICODE),
    // U+24B62
    '"'."\xF0\xA4\xAD\xA2".'"' === json_encode("\xF0\xA4\xAD\xA2", JSON_UNESCAPED_UNICODE),
    "a\xEF\xBF\xBD" === json_decode('"'."a\x80".'"', false, 512, JSON_NOTUTF8_SUBSTITUTE),
    "a" === json_decode('"'."a\x80".'"', false, 512, JSON_NOTUTF8_IGNORE)
);