document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.querySelector('.js-email input'),
        usernameInput = document.querySelector('.js-username input'),
        nameInput = document.querySelector('.js-name input'),
        passInput = document.querySelector('.js-password input'),
        mobileInput = document.querySelector('.js-mobile input'),
        confirmInput = document.querySelector('.js-confirm input');

    emailInput.addEventListener('focus', () => {
        focusState(emailInput);
    });

    emailInput.addEventListener('blur', () => {
        blurState(emailInput);
    });

    usernameInput.addEventListener('focus', () => {
        focusState(usernameInput);
    });

    usernameInput.addEventListener('blur', () => {
        blurState(usernameInput);
    });

    nameInput.addEventListener('focus', () => {
        focusState(nameInput);
    });

    nameInput.addEventListener('blur', () => {
        blurState(nameInput);
    });

    passInput.addEventListener('focus', () => {
        focusState(passInput);
    });

    passInput.addEventListener('blur', () => {
        blurState(passInput);
    });

    mobileInput.addEventListener('focus', () => {
        focusState(mobileInput);
    });

    mobileInput.addEventListener('blur', () => {
        blurState(mobileInput);
    });

    confirmInput.addEventListener('focus', () => {
        focusState(confirmInput);
    });

    confirmInput.addEventListener('blur', () => {
        blurState(confirmInput);
    });

    function focusState(element) {
        const parentEl = element.parentElement;
        parentEl.classList.add('active');
    }

    function blurState(element) {
        const parentEl = element.parentElement;
        if (!element.value) {
            parentEl.classList.remove('active');
        }
    }

    window.addEventListener('pageshow', () => {
        if (emailInput && emailInput.value) {
            focusState(emailInput);
        }
        if (passInput && passInput.value) {
            focusState(passInput);
        }
        if (mobileInput && mobileInput.value) {
            focusState(mobileInput);
        }
        if (confirmInput && confirmInput.value) {
            focusState(confirmInput);
        }
    });


    console.log('usernameInput:', usernameInput);
console.log('nameInput:', nameInput);
console.log('passInput:', passInput);
console.log('mobileInput:', mobileInput);
console.log('confirmInput:', confirmInput);

});
