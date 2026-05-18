<?php

include 'auth_check.php';
include '../config/db.php';

$page_title = "Content Library";

include 'admin_header.php';

/*
|--------------------------------------------------------------------------
| Sorting
|--------------------------------------------------------------------------
*/

$sort = $_GET['sort'] ?? 'newest';

$orderBy = "c.created_at DESC";

switch($sort){

    case 'oldest':
        $orderBy = "c.created_at ASC";
    break;

    case 'az':
        $orderBy = "c.content_title ASC";
    break;

    case 'za':
        $orderBy = "c.content_title DESC";
    break;
}

/*
|--------------------------------------------------------------------------
| Get Content
|--------------------------------------------------------------------------
*/

$query = "
SELECT 
    c.*,
    t.template_title
FROM content c
LEFT JOIN templates t
ON c.template_id = t.template_id
ORDER BY $orderBy
";

$result = $conn->query($query);

?>

<link rel="stylesheet" href="../assets/css/content.css?v=<?= time() ?>">

<div class="content-page fade-in">

    <!-- HEADER -->
    <div class="content-header">

        <div>
            <h2 class="section-title">Content Library</h2>
            <p class="text-muted">
                Manage your games, quizzes and lessons
            </p>
        </div>

        <a href="create.php" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle"></i>
            Create Content
        </a>

    </div>

    <!-- ACTION BAR -->
    <div class="action-bar">

        <!-- SEARCH -->
        <div class="search-box">

            <i class="bi bi-search"></i>

            <input
                type="text"
                id="searchInput"
                placeholder="Search content..."
                class="form-control"
            >

        </div>

        <!-- FILTERS -->
        <div class="filter-buttons">

            <button class="filter-btn active" data-filter="all">
                All
            </button>

            <button class="filter-btn" data-filter="game">
                Games
            </button>

            <button class="filter-btn" data-filter="quiz">
                Quizzes
            </button>

            <button class="filter-btn" data-filter="lesson">
                Lessons
            </button>

        </div>

        <!-- SORT -->
        <form method="GET">

            <select
                name="sort"
                class="form-select"
                onchange="this.form.submit()"
            >

                <option value="newest" <?= $sort == 'newest' ? 'selected' : '' ?>>
                    Newest
                </option>

                <option value="oldest" <?= $sort == 'oldest' ? 'selected' : '' ?>>
                    Oldest
                </option>

                <option value="az" <?= $sort == 'az' ? 'selected' : '' ?>>
                    A-Z
                </option>

                <option value="za" <?= $sort == 'za' ? 'selected' : '' ?>>
                    Z-A
                </option>

            </select>

        </form>

    </div>

    <!-- CONTENT GRID -->
    <div class="row g-4 mt-1" id="contentGrid">

        <?php if($result->num_rows > 0): ?>

            <?php while($row = $result->fetch_assoc()): ?>

                <div
                    class="col-lg-4 col-md-6 content-item"
                    data-type="<?= $row['content_type'] ?>"
                    data-title="<?= strtolower($row['content_title']) ?>"
                >

                    <div class="content-card">

                        <!-- THUMB -->
                        <div class="thumb-area">

                            <?php if(!empty($row['thumbnail'])): ?>

                                <img
                                    src="<?= $row['thumbnail'] ?>"
                                    class="content-thumb"
                                >

                            <?php else: ?>

                                <div class="default-thumb">
                                    <i class="bi bi-controller"></i>
                                </div>

                            <?php endif; ?>

                            <span class="type-badge <?= $row['content_type'] ?>">
                                <?= ucfirst($row['content_type']) ?>
                            </span>

                        </div>

                        <!-- BODY -->
                        <div class="content-body">

                            <h5 class="content-title">
                                <?= htmlspecialchars($row['content_title']) ?>
                            </h5>

                            <p class="template-name">
                                <?= $row['template_title'] ?? 'No Template' ?>
                            </p>

                            <small class="text-muted">
                                <?= $row['created_at'] ?>
                            </small>

                        </div>

                        <!-- ACTIONS -->
                        <div class="content-actions">

                            <a
                                href="edit.php?id=<?= $row['content_id'] ?>"
                                class="btn btn-sm btn-light"
                            >
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button
                                class="btn btn-sm btn-danger delete-btn"
                                data-id="<?= $row['content_id'] ?>"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="empty-state">

                <i class="bi bi-folder-x"></i>

                <h4>No content found</h4>

                <p>Create your first interactive game or lesson</p>

            </div>

        <?php endif; ?>

    </div>

</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content custom-modal">

            <div class="modal-body text-center p-4">

                <i class="bi bi-exclamation-triangle-fill delete-icon"></i>

                <h4 class="mt-3">Delete Content?</h4>

                <p class="text-muted">
                    This action cannot be undone
                </p>

                <div class="d-flex gap-2 justify-content-center mt-4">

                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button
                        class="btn btn-danger"
                        id="confirmDelete"
                    >
                        Delete
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="../assets/js/content.js?v=<?= time() ?>"></script>

<?php include 'admin_footer.php'; ?>