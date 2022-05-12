<?php

function sayHello () {
    echo 'Hello!!!<br>';
}

function plusOne ($a) {
    echo ++$a . '<br>';
}

function multiply (int $a, int $b) {
    echo 'Результат: ' . $a * $b . '<br>';
}

function sumNumbers ($a, $b, $c = 0) {
    echo $a + $b + $c . '<br>';
}

function returnPlusOne ($a) {
    return [
        'oldValue' => $a,
        'newValue' => ++$a
    ];
    echo 'lalala';
}

sayHello();

echo 'Hi!<br>';

sayHello();

sayHello();

plusOne(55);

echo ' . Какой-то текст';

$number = 18;
plusOne($number);

$number = 9;
$result = returnPlusOne($number);
echo "Старое число: {$result['oldValue']}, новое число: {$result['newValue']} <br>";

multiply(10, 5);

sumNumbers(1, 2, 3);

$res = sumNumbers(1, 2);

echo '<pre>';
var_dump($res);

$numbers = [1, 5, 3, 7, 2, 4];

function maxNumber (array $numbers) {
    $max = $numbers[0];
    foreach ($numbers as $number) {
        if ($number > $max) {
            $max = $number;
        }
    }
    return $max;
}

function sumArray (array $numbers) {
    $res = 0;
    foreach ($numbers as $number) {
        $res += $number;
    }
    return $res;
}

function positive_sum ($arr) {
    $res = 0;
    foreach ($arr as $number) {
        if ($number > 0) {
            $res += $number;
        }
    }
    return $res;
  }

function adjacentElementsProduct($array) {
    $arraySum = [];
    $count = count($array);
    for ($i = 0; $i < $count - 1; ++$i) {
        $arraySum[] = $array[$i] * $array[$i + 1];
    }
    return max($arraySum);
    echo '<pre>';
}

function binaryArrayToNumber($arr) {
    $res = 0;
    $count = count($arr) - 1;
    foreach ($arr as $n) {
        $res += $n * (2 ** $count--);
    }
    return $res;
}

echo maxNumber($numbers) . '<br>';

echo max($numbers) . '<br>';