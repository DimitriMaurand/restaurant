// Import des styles pour compilation.
import "./bootstrap.js";
import "./styles/app.css";

// Fonction pour attacher les événements aux boutons déroulants
function attachEventListeners() {
    const boutonsDeroulants = document.getElementsByClassName("boutonDeroulant");

    for (let index = 0; index < boutonsDeroulants.length; index++) {
        boutonsDeroulants[index].addEventListener("click", () => {
            const menuDeroulantDuBouton =
                boutonsDeroulants[index].getElementsByClassName("menuDeroulant");

            toggleMenuDeroulant(menuDeroulantDuBouton[0]);
        });
    }
}

// Fonction pour ouvrir/fermer les menus déroulants
function toggleMenuDeroulant(menu) {
    menu.classList.toggle("hidden");
}

console.log(document.getElementById('mobileMenuButton'))

document.getElementById('mobileMenuButton').addEventListener('click', function () {
    console.log("gt");

    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');
})

function mobileMenuButton() {
    console.log("coucou");

    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');
}

// Appeler après chaque navigation via Turbo
document.addEventListener("turbo:load", () => {
    attachEventListeners();
});

// document.addEventListener('DOMContentLoaded', function () {
//     let slides = document.querySelectorAll('.slideshow-image');
//     let currentSlide = 0;

//     function showNextSlide() {
//         slides[currentSlide].classList.add('opacity-0');
//         slides[currentSlide].classList.remove('opacity-100');

//         currentSlide = (currentSlide + 1) % slides.length;

//         slides[currentSlide].classList.add('opacity-100');
//         slides[currentSlide].classList.remove('opacity-0');
//     }

//     setInterval(showNextSlide, 5000); // Change slide every 5 seconds
// });