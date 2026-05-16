<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo isset($page_title) ? $page_title : 'Admin Panel'; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/css/style.css?v=<?= time() ?>">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?= time() ?>">
</head>

<body>

<div class="admin-wrapper">

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="logo-area">
            <h3>ESL Games</h3>
        </div>

        <nav class="sidebar-menu">

            <a href="index.php">
                <i class="bi bi-grid-fill"></i>
                Dashboard
            </a>

            <a href="content.php">
                <i class="bi bi-controller"></i>
                Content
            </a>

            <a href="create.php">
                <i class="bi bi-plus-circle-fill"></i>
                Create
            </a>

            <a href="settings.php">
                <i class="bi bi-gear-fill"></i>
                Settings
            </a>

            <a href="logout.php" class="logout-link">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>

        </nav>

    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Topbar -->
        <div class="topbar">

            <button class="menu-toggle d-lg-none" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>

            <h4 class="page-title">
                Admin Panel
            </h4>

        </div>


        <script src="../assets/js/admin.js?v=<?= time() ?>"></script>