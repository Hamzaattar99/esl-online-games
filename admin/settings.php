<?php

include 'auth_check.php';
include '../config/db.php';
include '../includes/helpers.php';

$page_title = "Settings";

include 'admin_header.php';

/*
|--------------------------------------------------------------------------
| Statistics
|--------------------------------------------------------------------------
*/

$totalContent = $conn->query("
SELECT COUNT(*) total FROM content
")->fetch_assoc()['total'];

$totalGames = $conn->query("
SELECT COUNT(*) total
FROM content
WHERE content_type='game'
")->fetch_assoc()['total'];

$totalQuiz = $conn->query("
SELECT COUNT(*) total
FROM content
WHERE content_type='quiz'
")->fetch_assoc()['total'];

$totalLessons = $conn->query("
SELECT COUNT(*) total
FROM content
WHERE content_type='lesson'
")->fetch_assoc()['total'];

$totalTemplates = $conn->query("
SELECT COUNT(*) total
FROM templates
")->fetch_assoc()['total'];

$totalResults = $conn->query("
SELECT COUNT(*) total
FROM results
")->fetch_assoc()['total'];

$totalUsers = $conn->query("
SELECT COUNT(*) total
FROM users
")->fetch_assoc()['total'];

?>

<link rel="stylesheet"
href="../assets/css/settings.css?v=<?= time() ?>">

<div class="settings-page">

    <div class="settings-layout">

        <!-- SIDEBAR -->
        <div class="settings-sidebar">

            <button
                class="settings-tab active"
                data-target="generalSection">

                <i class="bi bi-gear"></i>
                General Settings

            </button>

            <button
                class="settings-tab"
                data-target="statsSection">

                <i class="bi bi-bar-chart"></i>
                Statistics

            </button>

            <button
                class="settings-tab"
                data-target="frontendSection">

                <i class="bi bi-window"></i>
                Frontend Settings

            </button>

            <button
                class="settings-tab"
                data-target="accountSection">

                <i class="bi bi-shield-lock"></i>
                Account & Security

            </button>

        </div>

        <!-- CONTENT -->
        <div class="settings-content">

            <!-- GENERAL -->
            <div
                class="settings-card settings-section"
                id="generalSection">

                <h3>General Settings</h3>

                <form id="settingsForm">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label>Site Name</label>

                            <input
                                type="text"
                                name="site_name"
                                class="form-control"
                                value="<?= getSetting('site_name') ?>">

                        </div>

                        <div class="col-md-6">

                            <label>Primary Color</label>

                            <input
                                type="color"
                                name="primary_color"
                                class="form-control form-control-color"
                                value="<?= getSetting('primary_color') ?>">

                        </div>

                        <div class="col-12">

                            <label>Footer Text</label>

                            <input
                                type="text"
                                name="footer_text"
                                class="form-control"
                                value="<?= getSetting('footer_text') ?>">

                        </div>

                    </div>

                    <button
                        class="btn btn-primary mt-4 settings-save-btn">

                        Save Settings

                    </button>

                </form>

            </div>

            <!-- STATS -->
            <div
                class="settings-card settings-section"
                id="statsSection"
                style="display:none;">

                <h3>Platform Statistics</h3>

                <div class="stats-grid">

                    <div class="stat-box">
                        <small>Total Content</small>
                        <h2><?= $totalContent ?></h2>
                    </div>

                    <div class="stat-box">
                        <small>Games</small>
                        <h2><?= $totalGames ?></h2>
                    </div>

                    <div class="stat-box">
                        <small>Quizzes</small>
                        <h2><?= $totalQuiz ?></h2>
                    </div>

                    <div class="stat-box">
                        <small>Lessons</small>
                        <h2><?= $totalLessons ?></h2>
                    </div>

                    <div class="stat-box">
                        <small>Templates</small>
                        <h2><?= $totalTemplates ?></h2>
                    </div>

                    <div class="stat-box">
                        <small>Results</small>
                        <h2><?= $totalResults ?></h2>
                    </div>

                    <div class="stat-box">
                        <small>Users</small>
                        <h2><?= $totalUsers ?></h2>
                    </div>

                </div>

            </div>

            <!-- FRONTEND -->
            <div
                class="settings-card settings-section"
                id="frontendSection"
                style="display:none;">

                <h3>Frontend Settings</h3>

                <div class="form-check form-switch mb-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        checked>

                    <label class="form-check-label">

                        Enable Sounds

                    </label>

                </div>

                <div class="form-check form-switch mb-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        checked>

                    <label class="form-check-label">

                        Enable Timer

                    </label>

                </div>

                <div class="form-check form-switch">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        checked>

                    <label class="form-check-label">

                        Show Progress Bar

                    </label>

                </div>

            </div>

            <!-- ACCOUNT -->
            <div
                class="settings-card settings-section"
                id="accountSection"
                style="display:none;">

                <h3>Account & Security</h3>

                <form id="accountForm">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label>Current Username</label>

                            <input
                                type="text"
                                name="current_username"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label>New Username</label>

                            <input
                                type="text"
                                name="new_username"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label>Current Password</label>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label>New Password</label>

                            <input
                                type="password"
                                name="new_password"
                                class="form-control">

                        </div>

                    </div>

                    <button
                        class="btn btn-warning mt-4">

                        Update Account

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script src="../assets/js/settings.js?v=<?= time() ?>"></script>

<?php include 'admin_footer.php'; ?>