/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/test.js ***!
  \******************************/
//const answer = prompt('Сколько будет 2 + 2?')
answer = 99;

switch (answer) {
  case '4':
    {
      alert('Правильно');
      break;
    }

  case '3':
    {
      alert('Больше');
      break;
    }

  case '5':
    {
      alert('Меньше');
      break;
    }

  /*default: {
      alert('Не правильно')
      break
  }*/
} // FUNCTION DECLARATION


function sayHello() {
  str = 'Hello World!';
  console.log('Внутри функции', str);
}

var str = 'Hello!';
sayHello();
console.log('После функции', str);

function sum(a) {
  var b = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
  console.log(a + b);
}

var a = 10;
var b = 15;
sum(1, 2);

function sum2(a, b) {
  if (b === undefined) {
    b = 0;
  }

  console.log(a + b);
}

sum2(5);

function noReturn() {
  console.log('Вызвали функцию noReturn');
}

var res = noReturn();
console.log('res = ', res);

function fullName(firstName, lastName) {
  return firstName + '' + lastName;
}

var myName = fullName(Andrei, Tikishev);
console.log('name = ', myName); // FUNCTION EXPRESSION

var sayHelloWorld = function sayHelloWorld() {
  console.log('Hello World!');
};

console.log('sayHelloWorld = ', sayHelloWorld);
sayHelloWorld();

function callBackExample(access, accept, decline) {
  if (access) {
    accept();
  } else {
    decline();
  }
}

var accept = function accept() {
  alert('Доступ предоставлен');
};

var decline = function decline() {
  alert('Доступ запрещен');
};

callBackExample(true, accept, decline);
/******/ })()
;