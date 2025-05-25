const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');



loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
});
