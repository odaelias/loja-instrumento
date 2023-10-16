//INÍCIO OLHO MÁGICO
const eye = document.getElementsByClassName('olhoMagico');
const password = document.querySelectorAll('input[type=password]');

eye[1].addEventListener('change', function(){
    if (this.checked) {
        password[0].type ='text';
        eye[0].style.opacity = "1";
    } else {
        password[0].type ='password';
        eye[0].style.opacity = "0.5";
    }
});

eye[3].addEventListener('change', function(){
    if (this.checked) {
        password[1].type ='text';
        eye[2].style.opacity = "1";
    } else {
        password[1].type ='password';
        eye[2].style.opacity = "0.5";
    }
});

eye[5].addEventListener('change', function(){
    if (this.checked) {
        password[2].type ='text';
        eye[4].style.opacity = "1";
    } else {
        password[2].type ='password';
        eye[4].style.opacity = "0.5";
    }
});
//FIM OLHO MÁGICO

//INÍCIO CONFIRMAR SENHA
const count = document.querySelectorAll('input[type=password]').length;
if (count > 1){
    const submit = document.querySelectorAll('input[type=submit]');
    submit.disabled=true;

    password[1].addEventListener('keyup', function(){
        if(password[0].value === password[1].value){
            submit.disabled=false;
        } else{
            submit.disabled=true;
        }
    });
}
//FIM CONFIRMAR SENHA