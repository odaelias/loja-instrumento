const password = document.querySelectorAll('input[type=password]');

//INÍCIO OLHO MÁGICO
const eye = document.getElementsByClassName('olhoMagico');

if(eye.length > 0){
    eye[1].addEventListener('change', function(){
        if (this.checked) {
            password[0].type ='text';
            eye[0].style.opacity = "1";
        } else {
            password[0].type ='password';
            eye[0].style.opacity = "0.5";
        }
    });
    if(eye.length > 2){
        eye[3].addEventListener('change', function(){
            if (this.checked) {
                password[1].type ='text';
                eye[2].style.opacity = "1";
            } else {
                password[1].type ='password';
                eye[2].style.opacity = "0.5";
            }
        });
    }
    if(eye.length > 4){
        eye[5].addEventListener('change', function(){
            if (this.checked) {
                password[2].type ='text';
                eye[4].style.opacity = "1";
            } else {
                password[2].type ='password';
                eye[4].style.opacity = "0.5";
            }
        });
    }
}
//FIM OLHO MÁGICO

//INÍCIO CONFIRMAR SENHA
const submit = document.querySelectorAll('input[type="submit"]');

if (submit.length > 0) {
    if (password.length > 1) {
        submit[0].disabled = true;
        password[1].addEventListener('keyup', function () {
            if (password[0].value === password[1].value) {
                submit[0].disabled = false;
            } else {
                submit[0].disabled = true;
            }
        });
    }
}

//FIM CONFIRMAR SENHA

//INÍCIO ENDEREÇO VIZINHO
const checkbox1 = document.getElementById('chc-vizinho');
if(checkbox1){
    const inputNome1 = document.getElementById('txt-vizinho');
    const labelNome1 = document.querySelector('label[for="txt-vizinho"]');

    inputNome1.style.display = 'none';
    labelNome1.style.display = 'none';

    checkbox1.addEventListener('change', function () {
        if (checkbox1.checked) {
        inputNome1.style.display = 'inline';
        labelNome1.style.display = 'inline';
        } else {
        inputNome1.style.display = 'none';
        labelNome1.style.display = 'none';
        }
    });
}
//FIM ENDEREÇO VIZINHO