// =========================
// Error Page Effects
// =========================

document.addEventListener("DOMContentLoaded", () => {

    const card = document.querySelector(".error-card");

    if(card){

        card.addEventListener("mousemove", (e) => {

            const rect = card.getBoundingClientRect();

            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const rotateY = ((x / rect.width) - 0.5) * 6;
            const rotateX = ((y / rect.height) - 0.5) * -6;

            card.style.transform = `
                perspective(1000px)
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
            `;

        });

        card.addEventListener("mouseleave", () => {

            card.style.transform = `
                perspective(1000px)
                rotateX(0deg)
                rotateY(0deg)
            `;

        });

    }

});