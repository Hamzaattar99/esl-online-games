const addQuestionBtn = document.getElementById("addQuestionBtn");
const questionsContainer = document.getElementById("questionsContainer");

let questionCount = 0;

// =========================
// ADD QUESTION
// =========================

addQuestionBtn.addEventListener("click", () => {

    questionCount++;

    const questionHTML = `

        <div class="question-card">

            <button type="button"
                    class="btn btn-danger btn-sm remove-question">

                <i class="bi bi-trash"></i>

            </button>

            <div class="question-number">
                Question ${questionCount}
            </div>

            <input type="text"
                   name="question[]"
                   class="form-control"
                   placeholder="Enter question"
                   required>

            <input type="text"
                   name="correct_answer[]"
                   class="form-control"
                   placeholder="Correct Answer"
                   required>

            <input type="text"
                   name="option1[]"
                   class="form-control"
                   placeholder="Option 1">

            <input type="text"
                   name="option2[]"
                   class="form-control"
                   placeholder="Option 2">

            <input type="text"
                   name="option3[]"
                   class="form-control"
                   placeholder="Option 3">

        </div>

    `;

    questionsContainer.insertAdjacentHTML("beforeend", questionHTML);

});

// =========================
// REMOVE QUESTION
// =========================

questionsContainer.addEventListener("click", (e) => {

    if (e.target.closest(".remove-question")) {

        e.target.closest(".question-card").remove();

    }

});