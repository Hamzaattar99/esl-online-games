<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/login.css?v=<?= time() ?>">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="login-card shadow-lg">

        <div class="text-center mb-4">
            <i class="bi bi-controller login-icon"></i>
            <h3 class="mt-2 text-white">ESL Games Login</h3>
            <p class="text-secondary">Admin Access Panel</p>
        </div>

        <form id="loginForm">

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label text-white">
                    <i class="bi bi-person"></i> Username
                </label>

                <input type="text" name="username" id="username"
                       class="form-control custom-input"
                       placeholder="Enter username">

                <small class="text-danger" id="userError"></small>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label text-white">
                    <i class="bi bi-lock"></i> Password
                </label>

                <input type="password" name="password" id="password"
                       class="form-control custom-input"
                       placeholder="Enter password">

                <small class="text-danger" id="passError"></small>
            </div>

            <button type="submit" class="btn btn-primary w-100 login-btn">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>

        </form>

        <!-- Lock Box -->
        <div class="lock-box text-center mt-3" id="lockBox">
            <div class="spinner-border text-danger mb-2"></div>
            <p class="text-danger">Too many attempts</p>
            <h4 class="text-white" id="timer">60</h4>
        </div>

    </div>

</div>

<script src="../assets/js/login.js?v=<?= time() ?>"></script>

</body>
</html>