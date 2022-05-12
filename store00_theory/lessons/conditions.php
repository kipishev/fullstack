<?php

$number = 4;

if ($number > 5) {
    echo 'число больше 5';
    echo '<br>';
    echo '!';
}

echo '<br>';
echo 'Это строка выводится всегда';

if ($number > 5) {
    echo '<br>';
    echo 'число больше 5';
} else {
    echo '<br>';
    echo 'число меньше или равно 5';
}

if ($number > 5) {
    echo '<br>';
    echo 'число больше 5';
} else if ($number > 3) {
    echo '<br>';
    echo 'число меньше или равно 5, но больше 3';
} else if ($number > 0) {
    echo '<br>';
    echo 'либо 1, либо 2, либо 3';
} else {
    echo '<br>';
    echo '0 либо отрицательное';
}

$second_number = 1;

echo '<hr>';

if ($number > 0 && $second_number == 0) {
    echo '$number > 0 и $second_numbe равно 0';
}

if ($number > 0 || $second_number == 0) {
    echo '$number > 0 или $second_numbe равно 0';
}

echo '<br>';


if ($number > 0) {
    if ($number > 2) {
        echo 'число больше 2';
    }
}

if ($number != 0) {
    echo '<br>';
    echo 'число не 0';
}

# вывести одно из 3 сообщений
# если возраст меньше 7: Вы дошкольник
# если старше 6 и младше 19: Вы в школе
# если старше 18: Закончили школу

echo '<hr>';

$adult = 77;

if ( $adult < 7 ) {
    echo "Вы дошкольник";
} else if ( $adult > 6 and $adult < 19 ) {
    echo "Вы в школе";
} else {
    echo "Закончили школу";
}