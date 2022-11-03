const signIn = document.querySelector('#signIn');
const login = document.querySelector('#login');
const divSignIn = document.querySelector('.container-signIn');
const divLogin = document.querySelector('.container-login');
const forms = document.querySelectorAll('.form');
const passwords = document.querySelectorAll('.password');
const error = document.querySelector('.error');
const success = document.querySelector('.success');


if (success.innerText.includes('You created your account successfuly!, please login')) {
    let count = 0;
    setInterval(() => {
        if (count < 20) {
            success.style.display = "flex";
            count++
            console.log(count);
        } else {
            success.style.display = 'none';
            clearInterval();
        }
    }, 100);

}

forms[0].addEventListener('submit', (e) => {
    if (passwords[0].value !== passwords[1].value) {
        e.preventDefault();
        error.innerText = 'Passwords need match';
    } else {
        forms[0].requestSubmit();
    }
})
forms[0].addEventListener('click', (e) => {
    if (e.target === forms[0]) {
        divSignIn.classList.toggle('hide');
    }
})
forms[1].addEventListener('click', (e) => {
    if (e.target === forms[1]) {
        divLogin.classList.toggle('hide');
    }
})

signIn.addEventListener('click', () => {
    divSignIn.classList.toggle('hide');
})

login.addEventListener('click', (e) => {
    console.log(e)
    divLogin.classList.toggle('hide');
})