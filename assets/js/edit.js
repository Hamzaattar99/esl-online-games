const form = document.getElementById("editForm");
const container = document.getElementById("questionsContainer");
const addBtn = document.getElementById("addQuestion");

/*
|--------------------------------------------------------------------------
| ADD QUESTION
|--------------------------------------------------------------------------
*/

addBtn.addEventListener("click", () => {

    const html = `
    <div class="question-card">

        <input type="text" name="question[]" class="form-control" placeholder="Question">

        <input type="text" name="correct[]" class="form-control mt-2" placeholder="Correct Answer">

        <input type="text" name="opt1[]" class="form-control mt-2" placeholder="Option 1">

        <input type="text" name="opt2[]" class="form-control mt-2" placeholder="Option 2">

        <input type="text" name="opt3[]" class="form-control mt-2" placeholder="Option 3">

        <button type="button" class="remove btn btn-danger btn-sm mt-2">
            Remove
        </button>

    </div>`;

    container.insertAdjacentHTML("beforeend", html);

});

/*
|--------------------------------------------------------------------------
| REMOVE QUESTION
|--------------------------------------------------------------------------
*/

container.addEventListener("click", (e) => {

    if(e.target.classList.contains("remove")){
        e.target.closest(".question-card").remove();
    }

});

/*
|--------------------------------------------------------------------------
| SUBMIT
|--------------------------------------------------------------------------
*/

form.addEventListener("submit", (e) => {

    e.preventDefault();

    let formData = new FormData(form);

    fetch("edit_op.php", {
        method:"POST",
        body:formData
    })
    .then(res => res.text())
    .then(data => {

        if(data.trim() === "success"){

            showToast("Updated successfully");

            setTimeout(() => {
                window.location.href = "content.php";
            }, 1200);

        }else{
            alert("Error updating content");
        }

    });

});

/*
|--------------------------------------------------------------------------
| TOAST
|--------------------------------------------------------------------------
*/

function showToast(msg){

    let toast = document.createElement("div");

    toast.className = "custom-toast";
    toast.innerText = msg;

    document.body.appendChild(toast);

    setTimeout(() => toast.classList.add("show"), 100);

    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 300);
    }, 1500);

}