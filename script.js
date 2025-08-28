const btn1 = document.getElementById('MiBtn1');
const conta1 = document.getElementById('conta1');

const btn2 = document.getElementById('MiBtn2');
const conta2 = document.getElementById('conta2');

const btn3 = document.getElementById('MiBtn3');
const conta3 = document.getElementById('conta3');

const btn4 = document.getElementById('MiBtn4');
const conta4 = document.getElementById('conta4');

const btn5 = document.getElementById('MiBtn5');
const conta5 = document.getElementById('conta5');

const RestoBotones = document.querySelectorAll('.boton');


let itcj = 0, tec = 0, urn = 0, uacj = 0, uach = 0;


function deshabilitarTodos() {
  RestoBotones.forEach(boton => {
    boton.disabled = true;
  
  });
}


btn1.addEventListener('click', function() {
  itcj++;
  conta1.textContent = itcj;
  deshabilitarTodos();
  btn1.textContent = 'Votado'; 
  btn1.classList.add("votado");
});

btn2.addEventListener('click', function() {
  tec++;
  conta2.textContent = tec;
  deshabilitarTodos();
  btn2.textContent = 'Votado';
  btn2.classList.add("votado");
});

btn3.addEventListener('click', function() {
  urn++;
  conta3.textContent = urn;
  deshabilitarTodos();
  btn3.textContent = 'Votado';
  btn3.classList.add("votado");

});

btn4.addEventListener('click', function() {
  uacj++;
  conta4.textContent = uacj;
  deshabilitarTodos();
  btn4.textContent = 'Votado';
  btn4.classList.add("votado");
});

btn5.addEventListener('click', function() {
  uach++;
  conta5.textContent = uach;
  deshabilitarTodos();
  btn5.textContent = 'Votado';
  btn5.classList.add("votado");
});
