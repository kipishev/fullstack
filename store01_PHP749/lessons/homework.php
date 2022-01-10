<?php
// -------------------------------------------------- Задача 1:
// https://www.codewars.com/kata/582cb0224e56e068d800003c/php
function hydrated($t) {
    return floor($t * 0.5);
}
$time = 11.8;
echo hydrated($time) . '<br>';
// -------------------------------------------------- Задача 2:
// https://www.codewars.com/kata/57a0e5c372292dd76d000d7e
function repeatStr($n, $str) {
    return str_repeat($str, $n);
}
$n = 6;
echo repeatStr($n, "Hello") . '<br>';
// -------------------------------------------------- Задача 3:
// https://www.codewars.com/kata/5933a1f8552bc2750a0000ed/php
function nthEvenNumber($n) {
    return $n * 2 - 2;
}
$num = 1298734;
echo nthEvenNumber($num) . '<br>';
// -------------------------------------------------- Задача 4:
// https://www.codewars.com/kata/5168bb5dfe9a00b126000018/php
function reversStr($str) {
    return strrev($str);
}
$word = "world";
echo reversStr($word) . '<br>';
// -------------------------------------------------- Задача 5:
// https://www.codewars.com/kata/5859c82bd41fc6207900007a/php
function nameQuote($name, $quote) {
    return "$name said: \"$quote\"";
}
$name = 'Grae';
$quote = 'Practice makes perfect';
echo nameQuote($name, $quote) . '<br>';
// -------------------------------------------------- Задача 6:
// https://www.codewars.com/kata/54ff3102c1bad923760001f3/php
function getCount($str) {
    $vowelsCount = 0;
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    foreach ($vowels as $vowel) {
        // $vowelsCount = $vowelsCount + substr_count($str, $vowel);
        $vowelsCount += substr_count($str, $vowel);
    }
    return $vowelsCount;
}
$str = 'abracadabra';
echo getCount($str) . '<br>';
// -------------------------------------------------- Задача 7:
// https://www.codewars.com/kata/55bf01e5a717a0d57e0000ec/php
/* Write a function, persistence, that takes in a positive parameter num and returns its
multiplicative persistence, which is the number of times you must multiply the digits in num until
you reach a single digit. */
function persistence(int $n): int{
    $count = mb_strlen($n);
    for ($i = 0; $count > 1; $i++) {
        $n = str_split($n);
        $n = array_product($n);
        $count = mb_strlen($n);
    }
    return $i;
}
$num = 999;
echo persistence($num);












