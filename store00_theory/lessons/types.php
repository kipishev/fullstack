<?php

$name = 'Rail';
echo $name . ' ' . gettype($name) . ' ' . '<br>';

$age = 28;
echo $age . ' ' . gettype($age) . ' ' . '<br>';

$money = 999.99;
echo $money . ' ' . gettype($money) . ' ' . '<br>';

$isRain = true;
echo $isRain . ' ' . gettype($isRain) . ' ' . '<br>';


echo $notExist . ' ' . gettype($notExist) . ' ' . '<br>';

echo '<hr>';

if ($name) {
    echo '$name true <br>';
} else {
    echo '$name false <br>';
}

$emptyString = '';

if ($emptyString) {
    echo '$emptyString true <br>';
} else {
    echo '$emptyString false <br>';
}

$zeroString = '0';
if ($zeroString) {
    echo '$zeroString true <br>';
} else {
    echo '$zeroString false <br>';
}

$space = ' ';
if ($space) {
    echo '$space true <br>';
} else {
    echo '$space false <br>';
}

$number = 99;
if ($number) {
    echo '$number true <br>';
} else {
    echo '$number false <br>';
}

$zero = 0;
if ($zero) {
    echo '$zero true <br>';
} else {
    echo '$zero false <br>';
}

$false = false;
if ($false) {
    echo '$false true <br>';
} else {
    echo '$false false <br>';
}

$null = NULL;
if ($null) {
    echo '$null true <br>';
} else {
    echo '$null false <br>';
}

if ($null == $false) {
    echo '$null == $false true <br>';
} else {
    echo '$null == $false false <br>';
}

if ($null === $false) {
    echo '$null === $false true <br>';
} else {
    echo '$null === $false false <br>';
}

if (0 == "") {
    echo '0 == "" true <br>';
} else {
    echo '0 == "" $false false <br>';
}

if (0 === "") {
    echo '0 === "" true <br>';
} else {
    echo '0 === "" $false false <button>!!!</button> <br>';
}

echo 'My name\'s Rail <br>';


$message = "значение переменной name = $name <br>";
echo $message;

echo htmlspecialchars('<img src="images/img.png">');
echo '<br>';
$number = 10;
$number++;
echo $number;
echo '<br>';
$number--;
echo $number;
echo '<br>';

$n = 10;
$new_number = $n++;
echo $new_number;
echo '<br>';

$n = 10;
$new_number = ++$n;
echo $new_number;
echo '<hr>';

$n = -1;

if (++$n) {
    echo 'true';
} else {
    echo 'false';
}

echo '<hr>';
$n = 10;
$n *= 2;
echo $n;

echo '<hr>';

$name = 'Rail';
$name .= ' Mingaliev';
echo $name;