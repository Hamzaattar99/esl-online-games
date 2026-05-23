/*
|--------------------------------------------------------------------------
| Counter Animation
|--------------------------------------------------------------------------
*/

const counters = document.querySelectorAll(".counter");

counters.forEach(counter => {

    const update = () => {

        const target =
        +counter.getAttribute("data-target");

        const current =
        +counter.innerText;

        const increment =
        Math.ceil(target / 40);

        if(current < target){

            counter.innerText =
            current + increment;

            setTimeout(update, 40);

        }else{

            counter.innerText = target;

        }

    };

    update();

});

/*
|--------------------------------------------------------------------------
| Mouse Background Effect
|--------------------------------------------------------------------------
*/

document.addEventListener("mousemove", e => {

    const circles =
    document.querySelectorAll(".bg-circle");

    circles.forEach((circle, index) => {

        const speed = (index + 1) * 0.01;

        const x = e.clientX * speed;
        const y = e.clientY * speed;

        circle.style.transform = `
        translate(${x}px, ${y}px)
        `;

    });

});

/*
|--------------------------------------------------------------------------
| Scroll Reveal
|--------------------------------------------------------------------------
*/

const revealElements =
document.querySelectorAll(".fade-in");

window.addEventListener("scroll", () => {

    revealElements.forEach(el => {

        const top =
        el.getBoundingClientRect().top;

        if(top < window.innerHeight - 80){

            el.classList.add("show");

        }

    });

});