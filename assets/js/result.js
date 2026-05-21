document.addEventListener("DOMContentLoaded", () => {

    animateScore();

    setupShareButton();

    setupCopyButton();

});

/* =========================
   Score Animation
========================= */

function animateScore(){

    const scoreEl = document.querySelector(".score-circle");

    if(!scoreEl) return;

    const finalScore = parseInt(scoreEl.dataset.score);

    let current = 0;

    const interval = setInterval(() => {

        current++;

        scoreEl.innerText = current;

        if(current >= finalScore){

            clearInterval(interval);

        }

    }, 20);

}

/* =========================
   Share Result
========================= */

function setupShareButton(){

    const shareBtn = document.getElementById("shareResultBtn");

    if(!shareBtn) return;

    shareBtn.addEventListener("click", async () => {

        const text = `
I scored ${shareBtn.dataset.score}
points in this ESL game!
`;

        if(navigator.share){

            navigator.share({
                title:"ESL Game Result",
                text:text,
                url:window.location.href
            });

        }else{

            alert("Sharing not supported");

        }

    });

}

/* =========================
   Copy Link
========================= */

function setupCopyButton(){

    const copyBtn = document.getElementById("copyLinkBtn");

    if(!copyBtn) return;

    copyBtn.addEventListener("click", () => {

        navigator.clipboard.writeText(
            window.location.href
        );

        copyBtn.innerHTML = `
        <i class="bi bi-check-lg"></i>
        Copied
        `;

        setTimeout(() => {

            copyBtn.innerHTML = `
            <i class="bi bi-copy"></i>
            Copy Link
            `;

        }, 2000);

    });

}