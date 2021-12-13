<?php
// -------------------------------------------------- Задача 1:
function hydrated($t) {
    return floor($t * 0.5);
}
$time = 11.8;
echo hydrated($time) . '<br>';
// -------------------------------------------------- Задача 2:
function repeatStr($n, $str) {
    return str_repeat($str, $n);
}
$n = 6;
echo repeatStr($n, "Hello") . '<br>';
// -------------------------------------------------- Задача 3:
function nthEvenNumber($n) {
    return $n * 2 - 2;
}
$num = 1298734;
echo nthEvenNumber($num) . '<br>';
// -------------------------------------------------- Задача 4:
function reversStr($str) {
    return strrev($str);
}
$word = "world";
echo reversStr($word) . '<br>';
// -------------------------------------------------- Задача 5:
function nameQuote($name, $quote) {
    return "$name said: \"$quote\"";
}
$name = 'Grae';
$quote = 'Practice makes perfect';
echo nameQuote($name, $quote) . '<br>';
// -------------------------------------------------- Задача 6:
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












