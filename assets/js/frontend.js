document.addEventListener("mousemove", e => {

    const bg = document.querySelector(".hero-bg");

    if(bg){

        bg.style.transform = `
        translate(
            ${e.clientX * 0.01}px,
            ${e.clientY * 0.01}px
        )
        `;
    }

});