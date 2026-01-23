
<?php
session_start();
include 'koneksi.php';

$error = "";

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if ($row = mysqli_fetch_assoc($result)) {
        if ($password == $row['password']) {
           $_SESSION['user'] = [
    'id'    => $row['id'],
    'name'  => $row['name'],
    'email' => $row['email'],
    'role'  => $row['role']
];


            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }
        .login-card {
            width: 350px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-reset {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h2>POLGAN MART</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn">Login</button>
            <button type="reset" class="btn-reset">Batal</button>
        </form>

        <div class="footer">
            <p>© 2026 POLGAN MART</p>
        </div>
    </div>
</body>
</html>
