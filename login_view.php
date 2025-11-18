<?php
session_start();

if(isset($_SESSION['username'])){
    header("Location: dashboard.php");
}
if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  
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
    padding: 1em 2em;
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
                <h3 class="text-center mb-4">Login</h3>
            <form method="POST" action="login_proses.php">
                <div class="form-group mb-2">
                <label for="username">Username</label>
                <input type="username" class="form-control mb-1" id="username" name="username">
                </div>
                <div class="form-group mb-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
                </div>
                <button type="submit" class="btn btn-primary mt-2 mb-2" style="width: 370px">Login</button>
                <span>Belum punya akun?</span><a href="register_view.php" class="btn btn-link">Signup</button></a>
    
            </form>
        </div>
        </span>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>