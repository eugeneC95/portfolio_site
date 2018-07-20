<?php
 
print_r(Caesar::bruteForce('vtxltkvbiaxkbltlnulmbmnmbhgvbiaxk'));
 
class Caesar
{
    /**
     * @var string
     */
    private static $chars = 'abcdefghijklmnopqrstuvwxyz';
 
    /**
     * @param string $cipher
     * @return array
     */
    public static function bruteForce($cipher)
    {
        $result = [];
 
        for ($i = 0; $i < 26; $i++) {
            $result[] = self::decrypt($cipher, $i);
        }
 
        return $result;
    }
 
    /**
     * @param string $cipher
     * @param int    $key
     * @return string
     */
    public static function decrypt($cipher, $key)
    {
        $cipher   = strtolower($cipher);
        $plain    = '';
        $charsLen = strlen(self::$chars);
 
        for ($i = 0, $len = strlen($cipher); $i < $len; $i++) {
            $next = strpos(self::$chars, $cipher[$i]) + (int)$key;
 
            if ($next >= $charsLen) {
                $next -= $charsLen;
            }
 
            $plain .= self::$chars[$next];
        }
 
        return $plain;
    }
}