<?php

$numbers = [1, 2, 3, 4, 5];

echo $numbers[2];
echo '<br>';

$count = count($numbers);
for ($i = 0; $i < $count; $i++) {
    echo "$i $numbers[$i] <br>";
}

echo '<hr>';

foreach ($numbers as $key => $value) {
    echo "$key: $value <br>";
}

$new_numbers = [];

for ($i = 0; $i < 10; $i++) {
    $new_numbers[] = $i ** 2;
}

$new_numbers[3] = 99;
$new_numbers[10] = 100;

$new_numbers[67] = 67 * 67;

echo '<pre>';
print_r($new_numbers);

$person = [
    'name' => 'Rail',
    'age' => 28,
    'city' => 'London',
    'language' => 'PHP'
];

echo '<pre>';
print_r($person);

$person['car'] = true;

$person['name'] = '';

echo '<pre>';
print_r($person);

unset($person['name']);

echo '<pre>';
print_r($person);

echo '<hr>';

$colors = ['red', 'green', 'blue'];

$output = '';
foreach ($colors as $color) {
    $output = $output . ' ' . $color;
}



$string_colors = implode(', ', $colors);

echo "$string_colors<br>";

$new_str = 'Предложение из 4 слов';
$array = explode(' ', $new_str);

print_r($array);

$numbers = [2, 4, 6, 1, 3];
print_r($numbers);

sort($numbers);

print_r($numbers);

print_r($person);

sort($person);

print_r($person);

$person = [
    'name' => 'Rail',
    'age' => 28,
    'city' => 'London',
    'language' => 'PHP'
];

asort($person);

print_r($person);

ksort($person);

print_r($person);

rsort($numbers);

print_r($numbers);

arsort($person);

print_r($person);

krsort($person);

print_r($person);

echo '<hr>';

$persons = [
    [
        'name' => 'Rail',
        'age' => 28,
        'city' => 'London',
        'languages' => ['PHP', 'JS']
    ],
    [
        'name' => 'Jhon',
        'age' => 20,
        'city' => 'Madrid'
    ],
    [
        'name' => 'Petr',
        'age' => 35,
        'city' => 'Kazan'
    ]
];

function sortByAge ($a, $b) {
    if ($a['age'] > $b['age']) {
        return 1;
    } else if ($a['age'] < $b['age']) {
        return -1;
    } else {
        return 0;
    }
}

function sortByCity ($a, $b) {
    return $a['city'] <=> $b['city'];
}

print_r($persons);

usort($persons, 'sortByCity');

print_r($persons);

echo '<hr>';

$numberOne = 15;
$numberTwo = 15;

// if ($numberOne > $numberTwo) {
//     echo 1;
// } else if ($numberOne < $numberTwo) {
//     echo -1;
// } else {
//     echo 0;
// }

echo $numberOne <=> $numberTwo;

$names = array_column($persons, 'name');

print_r($names);

array_multisort($names, SORT_DESC, $persons);

print_r($persons);

$keys = array_keys($person);

print_r($keys);

$values = array_values($person);

print_r($values);

print_r($persons[0]['languages'][0][0]);
echo '<br>';
print_r($persons[0]['name']);
echo '<br>';
print_r($persons[1]['age']);