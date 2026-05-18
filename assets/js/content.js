const searchInput = document.getElementById("searchInput");
const filterButtons = document.querySelectorAll(".filter-btn");
const contentItems = document.querySelectorAll(".content-item");

let currentFilter = "all";

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

searchInput.addEventListener("keyup", filterContent);

/*
|--------------------------------------------------------------------------
| FILTER BUTTONS
|--------------------------------------------------------------------------
*/

filterButtons.forEach(button => {

    button.addEventListener("click", () => {

        filterButtons.forEach(btn => {
            btn.classList.remove("active");
        });

        button.classList.add("active");

        currentFilter = button.dataset.filter;

        filterContent();

    });

});

/*
|--------------------------------------------------------------------------
| FILTER FUNCTION
|--------------------------------------------------------------------------
*/

function filterContent(){

    const search = searchInput.value.toLowerCase();

    contentItems.forEach(item => {

        const type = item.dataset.type;
        const title = item.dataset.title;

        const matchSearch = title.includes(search);

        const matchFilter =
            currentFilter === "all" ||
            currentFilter === type;

        if(matchSearch && matchFilter){

            item.style.display = "block";

        }else{

            item.style.display = "none";

        }

    });

}

/*
|--------------------------------------------------------------------------
| DELETE
|--------------------------------------------------------------------------
*/

let deleteId = null;

const deleteButtons = document.querySelectorAll(".delete-btn");
const confirmDelete = document.getElementById("confirmDelete");

deleteButtons.forEach(button => {

    button.addEventListener("click", () => {

        deleteId = button.dataset.id;

        const modal = new bootstrap.Modal(
            document.getElementById("deleteModal")
        );

        modal.show();

    });

});

confirmDelete.addEventListener("click", () => {

    if(!deleteId) return;

    const formData = new FormData();
    formData.append("id", deleteId);

    fetch("delete_content.php", {
        method:"POST",
        body:formData
    })
    .then(res => res.text())
    .then(data => {

        data = data.trim();

        if(data === "success"){

            const card = document.querySelector(
                `.delete-btn[data-id="${deleteId}"]`
            ).closest(".content-item");

            card.style.opacity = "0";

            setTimeout(() => {
                card.remove();
            }, 300);

            bootstrap.Modal.getInstance(
                document.getElementById("deleteModal")
            ).hide();

        }else{

            alert("Delete failed");

        }

    });

});