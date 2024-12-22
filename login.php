<?php
if (!empty($_SESSION["username_decafe"])) {
    header('location:home');
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login to DeCafe - Restaurant Reservation">
    <meta name="author" content="DeCafe Team">
    <title>DeCafe - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <main class="form-signin text-center">
        <form class="needs-validation" novalidate action="proses/proses_login.php" method="post">
            <i class="bi bi-cup-hot fs-1 text-primary mb-3"></i>
            <h1 class="h4 mb-3 fw-bold">Welcome to DeCafe</h1>
            <p class="text-muted">Login to reserve your table and enjoy the best dining experience.</p>

            <div class="form-floating mb-3">
                <input name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">Please enter your password.</div>
            </div>

            <div class="form-check text-start mb-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2 mb-3" type="submit" name="submitLogin" value="111">Login</button>

            <div class="divider text-muted mb-3">OR</div>

            <p class="mt-3 mb-0">Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>