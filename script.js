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

function deshabilitarTodos() {
  RestoBotones.forEach(boton => boton.disabled = true);
}

function enviarVoto(proyecto, boton, contador) {
    fetch('votar.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `proyecto=${proyecto}`
    })
    .then(res => res.text())
    .then(respuesta => {
        if(respuesta === 'ok'){
            contador.textContent = parseInt(contador.textContent) + 1;
            boton.textContent = 'Votado';
            boton.classList.add("votado");
            deshabilitarTodos();
        } else if(respuesta === 'ya_voto'){
            alert('Ya votaste por este proyecto.');
            boton.disabled = true;
            boton.classList.add("votado");
        } else {
            alert('Error al registrar tu voto');
        }
    });
}

btn1.addEventListener('click', () => enviarVoto('ITCJ', btn1, conta1));
btn2.addEventListener('click', () => enviarVoto('TEC', btn2, conta2));
btn3.addEventListener('click', () => enviarVoto('URN', btn3, conta3));
btn4.addEventListener('click', () => enviarVoto('UACJ', btn4, conta4));
btn5.addEventListener('click', () => enviarVoto('UACH', btn5, conta5));
