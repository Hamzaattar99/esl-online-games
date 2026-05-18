<?php

include 'auth_check.php';
include '../config/db.php';

$page_title = "Create Content";

include 'admin_header.php';

// get templates
$templates = $conn->query("SELECT * FROM templates ORDER BY template_id ASC");

?>

<link rel="stylesheet" href="../assets/css/create.css?v=<?= time() ?>">

<div class="create-page fade-in">

    <div class="create-header mb-4">
        <h2>Create New Content</h2>
        <p class="text-muted">
            Build games, quizzes, and interactive lessons.
        </p>
    </div>

    <form action="create_op.php" method="POST" enctype="multipart/form-data" id="createForm">

        <!-- BASIC INFO -->
        <div class="card-custom mb-4">

            <h4 class="section-title mb-4">
                <i class="bi bi-info-circle"></i>
                Basic Information
            </h4>

            <div class="row g-3">

                <!-- Title -->
                <div class="col-md-6">
                    <label class="form-label">Content Title</label>

                    <input type="text"
                           name="content_title"
                           class="form-control"
                           placeholder="Example: Animals Quiz"
                           required>
                </div>

                <!-- Type -->
                <div class="col-md-3">
                    <label class="form-label">Content Type</label>

                    <select name="content_type" class="form-select" required>
                        <option value="">Select</option>
                        <option value="game">Game</option>
                        <option value="quiz">Quiz</option>
                        <option value="lesson">Lesson</option>
                    </select>
                </div>

                <!-- Template -->
                <div class="col-md-3">
                    <label class="form-label">Template</label>

                    <select name="template_id" class="form-select" required>

                        <option value="">Select</option>

                        <?php while($template = $templates->fetch_assoc()) { ?>

                            <option value="<?= $template['template_id'] ?>">
                                <?= $template['template_title'] ?>
                            </option>

                        <?php } ?>

                    </select>
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label class="form-label">Description</label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              placeholder="Short description..."></textarea>
                </div>

                <!-- Thumbnail -->
                <div class="col-md-6">
                    <label class="form-label">Thumbnail</label>

                    <input type="file"
                           name="thumbnail"
                           class="form-control">
                </div>

            </div>

        </div>

        <!-- QUESTIONS -->
        <div class="card-custom mb-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4 class="section-title">
                    <i class="bi bi-patch-question"></i>
                    Questions Builder
                </h4>

                <button type="button"
                        class="btn btn-primary"
                        id="addQuestionBtn">

                    <i class="bi bi-plus-circle"></i>
                    Add Question

                </button>

            </div>

            <div id="questionsContainer">

                <!-- Dynamic Questions -->

            </div>

        </div>

        <!-- SETTINGS -->
        <div class="card-custom mb-4">

            <h4 class="section-title mb-4">
                <i class="bi bi-gear"></i>
                Settings
            </h4>

            <div class="form-check form-switch">

                <input class="form-check-input"
                       type="checkbox"
                       name="is_published"
                       checked>

                <label class="form-check-label">
                    Publish Content
                </label>

            </div>

        </div>

        <!-- SUBMIT -->
        <div class="text-end">

            <button type="submit" class="btn btn-success btn-lg px-5">

                <i class="bi bi-check-circle"></i>
                Create Content

            </button>

        </div>

    </form>

</div>

<script src="../assets/js/create.js?v=<?= time() ?>"></script>

<?php include 'admin_footer.php'; ?>