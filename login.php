<?php
include('header.php');
include('condb.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['droit'];
        header('Location: index.php');
    } else {
        echo "<p style='color:red;'>Invalid login credentials!</p>";
    }
}
?>

<!-- Adding custom styles to improve visibility in dark mode -->
<style>
    .login-page {
        background-color: #343a40; /* Dark background for login page */
        color: #fff; /* White text for better contrast */
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-box {
        width: 360px;
    }
    .login-card-body {
        background-color: #1e1e1e; /* Dark background for login form */
        border-radius: 10px;
        padding: 20px;
    }
    .form-control {
        background-color: #2c2c2c; /* Dark background for input fields */
        border: 1px solid #555;
        color: #fff;
    }
    .form-control::placeholder {
        color: #bbb; /* Light placeholder text */
    }
    .input-group-text {
        background-color: #2c2c2c; /* Dark input addon background */
        border: 1px solid #555;
    }
    .btn-primary {
        background-color: #007bff; /* Button color */
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3; /* Darker on hover */
        border-color: #004085;
    }
</style>

<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Task</b>Manager</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>