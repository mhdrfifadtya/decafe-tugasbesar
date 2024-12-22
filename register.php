<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DeCafe - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate action="proses/proses_register.php" method="POST">
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <label for="floatingNama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="floatingNama" name="nama" required>
                                    <div class="invalid-feedback">Masukkan nama Anda.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <label for="floatingUsername" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="floatingUsername" name="username" required>
                                    <div class="invalid-feedback">Masukkan email Anda.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <label for="floatingPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="floatingPassword" name="password" required>
                                    <div class="invalid-feedback">Masukkan password.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <label for="floatingNoHandphone" class="form-label">No Handphone</label>
                                    <input type="text" class="form-control" id="floatingNoHandphone" name="no_handphone" required>
                                    <div class="invalid-feedback">Masukkan nomor handphone.</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" name="level" required>
                                        <option selected hidden value="">Pilih Level User</option>
                                        <option value="1">Owner/Admin</option>
                                        <option value="2">Kasir</option>
                                        <option value="3">Pelayan</option>
                                        <option value="4">Dapur</option>
                                    </select>
                                    <label for="floatingLevel" class="form-label">Level User</label>
                                    <div class="invalid-feedback">
                                        Please choose your level.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="" style="height:100px" name="alamat" required></textarea>
                                    <label for="floatingInput">Alamat</label>
                                    <div class="invalid-feedback">
                                        Please enter your alamat.
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100" name="submitRegister">Register</button>
                                </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Already have an account ?<a href="login.php"> Sign in here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        (() => {
            const forms = document.querySelectorAll('.needs-validation');
            forms.forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });
        })();
    </script>
</body>

</html>