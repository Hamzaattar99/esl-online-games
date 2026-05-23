<?php

include 'auth_check.php';
include '../config/db.php';

$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM content WHERE content_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Content not found");
}

$content = $result->fetch_assoc();

$questions = json_decode($content['data_json'], true) ?? [];

$page_title = "Edit Content";

include 'admin_header.php';

?>

<link rel="stylesheet" href="../assets/css/edit.css?v=<?= time() ?>">

<div class="edit-page fade-in">

    <form id="editForm">

        <input type="hidden" name="content_id" value="<?= $content['content_id'] ?>">

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-lg-6">

                <div class="card p-3">

                    <h4>Edit Content</h4>

                    <input type="text" name="content_title"
                           class="form-control mt-3"
                           value="<?= htmlspecialchars($content['content_title']) ?>">

                    <select name="content_type" class="form-control mt-2">

                        <option value="game" <?= $content['content_type']=='game'?'selected':'' ?>>Game</option>
                        <option value="quiz" <?= $content['content_type']=='quiz'?'selected':'' ?>>Quiz</option>
                        <option value="lesson" <?= $content['content_type']=='lesson'?'selected':'' ?>>Lesson</option>

                    </select>

                    <textarea name="description"
                              class="form-control mt-2"
                              placeholder="Description"><?= htmlspecialchars($content['description']) ?></textarea>



                    <!-- Is_published -->
       

              <input class="form-check-input"
                type="checkbox"
                name="is_published"
                <?= ((int)$content['is_published']) === 1 ? 'checked' : '' ?>>

               <?php if(((int)$content['is_published']) === 1): ?>
                
                <label class="form-check-label">
                    Published
                </label>

                <?php endif; ?>

        

                    <button type="button" id="addQuestion"
                            class="btn btn-primary-custom mt-3 w-100">
                        + Add Question
                    </button>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-6">

                <div class="card p-3">

                    <h4>Questions</h4>

                    <div id="questionsContainer">

                        <?php foreach($questions as $q): ?>

                            <div class="question-card">

                                <input type="text" name="question[]"
                                       class="form-control"
                                       placeholder="Question"
                                       value="<?= htmlspecialchars($q['question']) ?>">

                                <input type="text" name="correct[]"
                                       class="form-control mt-2"
                                       placeholder="Correct Answer"
                                       value="<?= htmlspecialchars($q['correct_answer']) ?>">

                                <input type="text" name="opt1[]"
                                       class="form-control mt-2"
                                       value="<?= $q['option1'] ?>">

                                <input type="text" name="opt2[]"
                                       class="form-control mt-2"
                                       value="<?= $q['option2'] ?>">

                                <input type="text" name="opt3[]"
                                       class="form-control mt-2"
                                       value="<?= $q['option3'] ?>">

                                <button type="button" class="remove btn btn-danger btn-sm mt-2">
                                    Remove
                                </button>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-4 d-flex gap-2">

            <button type="submit" class="btn btn-success">
                Save Changes
            </button>

            <a href="content.php" class="btn btn-secondary">
                Cancel
            </a>

        </div>

    </form>

</div>

<script src="../assets/js/edit.js?v=<?= time() ?>"></script>

<?php include 'admin_footer.php'; ?>