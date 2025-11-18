<?php

session_start();

if(isset($_SESSION['username'])){
    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>Document</title>
</head>
<style>
    .back {
        background: #e2e2e2;
        width: 100%;
        position: absolute;
        top: 0;
        bottom: 0;
    }

    .div-center {
        width: 400px;
        height: 400px;
        background-color: #fff;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        max-width: 100%;
        max-height: 100%;
        overflow: auto;
        padding: 1em 2em;
        border-bottom: 2px solid #ccc;
        display: table;
    }

    div.content {
        display: table-cell;
        vertical-align: middle;
    }
</style>

<body>
    <div class="back">
        <div class="div-center">
            <div class="content">
                <h3 class="text-center mb-4">Register</h3>
                <form action="register_proses.php" method="POST">
                    <div class="form-group mb-2">
                        <label for="namaLengkap">Nama Lengkap </label>
                        <input type="text" class="form-control mb-1" id="namaLengkap" name="namaLengkap" required>
                    </div>
                    <div>
                        <label for="username">Username</label>
                        <input type="text" class="form-control mb-1" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-1" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group mb-2">
                        <label for="konfirmasiPassword">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasiPassword">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 mb-2" style="width: 370px">Register</button>
                    <span>Sudah punya akun?</span><a href="login_view.php"><button  type="button" class="btn btn-link">Login</button></a>

                </form>
            </div>
            </span>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
</body>

</html>