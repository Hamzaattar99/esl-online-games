
// ------------- NavBar -------------------------------------
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.querySelector('.sidebar');

if (menuToggle && sidebar) {

    // فتح/إغلاق عند الضغط على الزر
    menuToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.classList.toggle('active');
    });

    // إغلاق عند الضغط خارج القائمة
    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    });

    // إغلاق عند الضغط على أي رابط داخل القائمة
    const links = sidebar.querySelectorAll('a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    });

}

// ------------------------------------------------------------

// index page

document.addEventListener("DOMContentLoaded", () => {

    const cards = document.querySelectorAll(".dash-card");

    cards.forEach((card, i) => {

        setTimeout(() => {
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, i * 120);

    });

});

// --------------------------------------------------------------------