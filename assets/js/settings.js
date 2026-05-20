/*
|--------------------------------------------------------------------------
| Tabs
|--------------------------------------------------------------------------
*/

const tabs = document.querySelectorAll(".settings-tab");
const sections = document.querySelectorAll(".settings-section");

tabs.forEach(tab => {

    tab.addEventListener("click", () => {

        tabs.forEach(t => t.classList.remove("active"));

        tab.classList.add("active");

        const target = tab.dataset.target;

        sections.forEach(section => {

            section.style.display = "none";

        });

        document.getElementById(target).style.display = "block";

    });

});

/*
|--------------------------------------------------------------------------
| Message Box
|--------------------------------------------------------------------------
*/

function showMessage(message, type = "success") {

    const box = document.createElement("div");

    box.className = `message-box ${type}`;

    box.innerText = message;

    document.body.appendChild(box);

    setTimeout(() => {

        box.classList.add("show");

    }, 100);

    setTimeout(() => {

        box.classList.remove("show");

        setTimeout(() => {

            box.remove();

        }, 300);

    }, 3000);

}

/*
|--------------------------------------------------------------------------
| Save Settings
|--------------------------------------------------------------------------
*/

const settingsForm = document.getElementById("settingsForm");

if(settingsForm){

    settingsForm.addEventListener("submit", e => {

        e.preventDefault();

        const btn = settingsForm.querySelector("button");

        btn.disabled = true;

        btn.innerHTML = "Saving...";

        fetch("update_settings.php", {

            method:"POST",
            body:new FormData(settingsForm)

        })
        .then(res => res.json())
        .then(data => {

            if(data.status === "success"){

                showMessage(data.message);

            }else{

                showMessage(data.message, "error");

            }

            btn.disabled = false;

            btn.innerHTML = "Save Settings";

        });

    });

}

/*
|--------------------------------------------------------------------------
| Account Form
|--------------------------------------------------------------------------
*/

const accountForm = document.getElementById("accountForm");

if(accountForm){

    accountForm.addEventListener("submit", e => {

        e.preventDefault();

        fetch("update_account.php", {

            method:"POST",
            body:new FormData(accountForm)

        })
        .then(res => res.json())
        .then(data => {

            if(data.status === "success"){

                showMessage(data.message);

                accountForm.reset();

            }else{

                showMessage(data.message, "error");

            }

        });

    });

}