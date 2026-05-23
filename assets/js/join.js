/*
|--------------------------------------------------------------------------
| Paste From Clipboard
|--------------------------------------------------------------------------
*/

async function pasteClipboard(){

    try{

        const text = await navigator.clipboard.readText();

        if(text){

            document
            .getElementById("gameInput")
            .value = text;

            showToast(
                "Game link pasted successfully"
            );

        }

    }catch(error){

        showToast(
            "Clipboard access denied",
            "error"
        );

    }

}

/*
|--------------------------------------------------------------------------
| Clear Input
|--------------------------------------------------------------------------
*/

function clearInput(){

    document
    .getElementById("gameInput")
    .value = "";

    document
    .getElementById("gameInput")
    .focus();

}

/*
|--------------------------------------------------------------------------
| Toast Message
|--------------------------------------------------------------------------
*/

function showToast(message, type = "success"){

    const toastBox =
    document.getElementById("toastBox");

    const toast =
    document.createElement("div");

    toast.className = "toast-message";

    toast.innerHTML = `

        <i class="bi bi-info-circle-fill"></i>

        <span>${message}</span>

    `;

    toastBox.appendChild(toast);

    setTimeout(() => {

        toast.style.opacity = "0";

        toast.style.transform =
        "translateX(40px)";

        setTimeout(() => {

            toast.remove();

        }, 300);

    }, 3000);

}

/*
|--------------------------------------------------------------------------
| Input Effects
|--------------------------------------------------------------------------
*/

const input =
document.getElementById("gameInput");

if(input){

    input.addEventListener("input", () => {

        input.value =
        input.value.replace(/\s{2,}/g, " ");

    });

}

/*
|--------------------------------------------------------------------------
| Card Mouse Effect
|--------------------------------------------------------------------------
*/

const card =
document.querySelector(".join-card");

if(card){

    card.addEventListener("mousemove", e => {

        const rect =
        card.getBoundingClientRect();

        const x =
        e.clientX - rect.left;

        const y =
        e.clientY - rect.top;

        const rotateY =
        ((x / rect.width) - 0.5) * 8;

        const rotateX =
        ((y / rect.height) - 0.5) * -8;

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