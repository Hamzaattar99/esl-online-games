const form = document.getElementById("loginForm");
const userError = document.getElementById("userError");
const passError = document.getElementById("passError");
const lockBox = document.getElementById("lockBox");
const timer = document.getElementById("timer");

let isLocked = false;

form.addEventListener("submit", function(e) {
    e.preventDefault();


    if (isLocked) return; // منع الإرسال أثناء القفل


    // clear errors
    userError.innerText = "";
    passError.innerText = "";

    let formData = new FormData(form);

    fetch("login_op.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {

        data = data.trim();

        if (data === "success") {
            window.location.href = "index.php";
        }

        else if (data === "error") {
            userError.innerText = "Invalid username or password";
        }

        else if (data === "empty") {
            userError.innerText = "Please fill all fields";
        }

        else if (data === "locked") {
            isLocked = true;
            lockBox.style.display = "block";
            startTimer(60);
        }

    });

});

function startTimer(seconds) {
    let time = seconds;

    timer.innerText = time;

    let interval = setInterval(() => {

        time--;
        timer.innerText = time;

        if (time <= 0) {
            clearInterval(interval);
            lockBox.style.display = "none";
            isLocked = false; // مهم جداً
        }

    }, 1000);
}