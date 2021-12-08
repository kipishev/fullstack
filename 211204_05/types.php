<?php
$name = 'Andrei'; // строка (string)
$age = 28; // целое число число (integer)
$money = 999.99; // не целое число (double / float)
$isRain = true; // правда или ложь (boolean)
// есть еще тип данных, значения которых отсутсвуют (NULL)

echo $name . ' ' . gettype($name) . ' ' . '<br>'; // функция позволяет получить тип данных переменной
echo $age . ' ' . gettype($age) . ' ' . '<br>'; // функция позволяет получить тип данных переменной
echo $money . ' ' . gettype($money) . ' ' . '<br>'; // функция позволяет получить тип данных переменной
echo $isRain . ' ' . gettype($isRain) . ' ' . '<br>'; // функция позволяет получить тип данных переменной
echo $notExist . ' ' . gettype($notExist) . ' ' . '<br>'; // функция позволяет получить тип данных переменной

echo '<hr>';
/*--------------------------------- Проверка на истенность */
if ($name) {
    echo '$name true <br>';
} else {
    echo '$name false <br>';
}
$emptyString = ''; // false
if ($emptyString) {
    echo '$emptyString true <br>';
} else {
    echo '$emptyString false <br>';
}
$zeroString = '0'; // false
if ($zeroString) {
    echo '$zeroString true <br>';
} else {
    echo '$zeroString false <br>';
}
$zeroString = '0.0'; // true
if ($zeroString) {
    echo '$zeroString true <br>';
} else {
    echo '$zeroString false <br>';
}
$space = ' '; // true
if ($space) {
    echo '$space true <br>';
} else {
    echo '$space false <br>';
}
$number = 99; // true
if ($number) {
    echo '$number true <br>';
} else {
    echo '$number false <br>';
}
$zero = 0.0; // false
if ($zero) {
    echo '$zero true <br>';
} else {
    echo '$zero false <br>';
}
$false = false; // false
if ($false) {
    echo '$false true <br>';
} else {
    echo '$false false <br>';
}
$null = NULL; // false
if ($null) {
    echo '$null true <br>';
} else {
    echo '$null false <br>';
}
/*--------------------------------- Проверка типа данных */
if ($null == $false) { // true (если мы не проверяем тип данных, не используем строго сравнение)
    echo '$null == $false true <br>';
} else {
    echo '$null == $false false <br>';
}
if ($null === $false) { // false (если мы используем строгое сравнение)
    echo '$null === $false true <br>';
} else {
    echo '$null === $false false <br>';
}
if (0 == "") { // true (если мы не проверяем тип данных, не используем строго сравнение)
    echo '0 == "" true <br>';
} else {
    echo '0 == "" false <br>';
}
if (0 === "") { // false (если мы используем строгое сравнение)
    echo '0 === "" true <br>';
} else {
    echo '0 === "" false <br>';
}
/*--------------------------------- Вывод значений переменных */
// если есть двойные кавычки, PHP будет искать переменные, чтобы их вывести
$message = "Значение переменной = $name";
echo $message . '<br>';
/*--------------------------------- Экранирование */
echo 'My name\'s Andrei <br>';
/*--------------------------------- Экранирование тегов HTML */
echo htmlspecialchars('<br>');
echo '<br>';
/*--------------------------------- Примеры с инкрементацией */
// Пример 1
$n = 10;
$new_number = $n++; // сначала присваивается значение, затем оно увеличивается на 1 (значение $n меняется после присваивания), рузультат = 10
echo $new_number;
echo '<br>';
$n = 10;
$new_number = ++$n; // сначала идет квеличение на 1, а затем присваивание, рузультат = 11
echo $new_number;
echo '<br>';

// Пример 2
$n = -1;
if ($n) { /*будет true*/
    echo 'true <br>';
} else {
    echo 'false <br>';
}
$n = -1;
if ($n++) { /*все расно будет true, т.к. инкримент сработает после проверки*/
    echo 'true';
} else {
    echo 'false';
}
$n = -1;
if (++$n) { /*будет false, т.к. инкримент сработает до проверки*/
    echo 'true';
} else {
    echo 'false';
}

// Пример 3
echo '<hr>';
$n = 10;
$n = $n + 11;
$n += 11; // сокращенная запись: до знака = ставим действие, которое необходимо выполнить самому с собой
$n *= 2;

$name = 'Andrei';
$name .= ' Tikishev';

/*--------------------------------- Изменение типа данных */
$str = '123';
$number = (int) $str;
echo "$number" . gettype($number);



