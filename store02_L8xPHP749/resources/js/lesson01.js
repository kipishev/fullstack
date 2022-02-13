console.log('Hello world!')
let n = 10
n = 99
const COLOR_RED = '#ff0000'

// Типы данных
let name1 = 'Andrei'
console.log(name1, typeof name1)

let a = 1
let b = 0
let result = 1 / 0
console.log(result)
console.log(typeof result)
console.log(name1 - a)

let bg = 123n
console.log(bg, typeof bg)

let flag = false
console.log(flag, typeof flag)

let new_result = null
console.log(new_result, typeof new_result)

console.log(undefined_result, typeof undefined_result)

let person = {
    name: 'Andrei',
    age: 28,
}
console.log(person, typeof person)

console.log(a + '0')
console.log(2 + 2 + '5')
console.log(2 ** 53 - 1)

// alert, prompt, confirm
/*alert('Вот такое вот сообщение')
console.log('Вот это вот выводится после алерта')

let age = prompt('Сколько Вам лет?', 'default value')
console.log(age)

let access = confirm('Получить доступ?')
console.log(access)*/

// Приведение типов данных
let numb = 999
let numbString = String(numb)
console.log(numbString, typeof numbString)

numbString = Number(numbString)
console.log(numbString, typeof numbString)

let str = 'Какая-то строка'
console.log( Number(str) )

console.log(new_result, Number(new_result))
console.log(undefined_result, Number(undefined_result))

console.log(Number('       123     '))
