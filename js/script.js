// # BURGER MENU #


// const action = document.querySelector('.toggle');
// const nav = document.querySelector('nav');


// action.addEventListener('click', function () {
//     nav.classList.toggle('open');
// });

const closePopInAdd = document.querySelector('.closePopInAdd');
const popin_Success_Add  = document.querySelector('.popin_Success_Add');

closePopInAdd.addEventListener('click', function() {
    popin_Success_Add.style.opacity = '0';
});



const popin_Fail_Add  = document.querySelector('.popin_Fail_Add');


closePopInAdd.addEventListener('click', function() {
    popin_Fail_Add.style.opacity = '0';
});