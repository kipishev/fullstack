console.log(2 > 5) // Получаем false

let x = 10
let y = 5
let res = x > y
console.log('x == 5', x == 5)

let a = 'a'
let z = 'z'
console.log('a > z', a > z)

let str1 = 'abc'
let str2 = 'abbb'
console.log('str1 > str2', str1 > str2)

console.log("'1' == 1", '1' == 1)
console.log("'1' === 1", '1' === 1)

let variable = '0'
let variable1 = 0

console.log(Boolean(variable), Boolean(variable1))
console.log('variable == variable1', variable == variable1)

console.log('null == undefined', null == undefined)

console.log('null > 0', null > 0)
console.log('null == 0', null == 0)
console.log('null >= 0', null >= 0)

console.log('undefined > 0', undefined > 0)
console.log('undefined == 0', undefined == 0)
console.log('undefined >= 0', undefined >= 0)

// Условные конструкции

//let answer = prompt('Какой сейчас год?')

/*if (answer == 2022) {
    alert('Правильно!')
} else if (answer < 2022) {
    alert('Больше!')
} else {
    alert('Вы что из будущего?')
}*/

let age = 28
let access = age > 18 ? 'Доступ есть' : 'Доступа нет'
console.log('access', access)

// Логические операторы && ||

let haveLicence = true
let number1 = 123
let string1 = ''
res = number1 || string1 || haveLicence

if (res) {
    console.log('Yes')
} else {
    console.log('No')
}
console.log(res)

res = number1 && string1 && haveLicence

if (res) {
    console.log('Yes')
} else {
    console.log('No')
}
console.log(res)

// Циклы

let i = 0
while (i < 10) {
    console.log(i++)
}

let j = 0
for (j = 0; j < 5; j++) {
    if (j == 2) {
        continue
    }
    console.log(j)
}
console.log('j', j)
