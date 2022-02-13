//const answer = prompt('Сколько будет 2 + 2?')
answer = 99
switch (answer) {
    case '4': {
        alert('Правильно')
        break
    }
    case '3': {
        alert('Больше')
        break
    }
    case '5': {
        alert('Меньше')
        break
    }
    /*default: {
        alert('Не правильно')
        break
    }*/
}

// FUNCTION DECLARATION

function sayHello () {
    str = 'Hello World!'
    console.log('Внутри функции', str)
}
let str = 'Hello!'
sayHello()
console.log('После функции', str)

function sum (a, b = 0) {
    console.log(a + b)
}
let a = 10
let b = 15
sum(1, 2)

function sum2 (a, b) {
    if (b === undefined) {
        b = 0
    }
    console.log(a + b)
}
sum2(5)

function noReturn () {
    console.log('Вызвали функцию noReturn')
}
let res = noReturn()
console.log('res = ', res)

function fullName (firstName, lastName) {
    return firstName + '' + lastName
}
let myName = fullName(Andrei, Tikishev)
console.log('name = ', myName)

// FUNCTION EXPRESSION

let sayHelloWorld = function () {
    console.log('Hello World!')
}
console.log('sayHelloWorld = ', sayHelloWorld)

sayHelloWorld()

function callBackExample (access, accept, decline) {
    if (access) {
        accept()
    } else {
        decline()
    }
}

const accept = function () {
    alert('Доступ предоставлен')
}
const decline = function () {
    alert('Доступ запрещен')
}

callBackExample(true, accept, decline)


