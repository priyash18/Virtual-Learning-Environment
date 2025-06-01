<?php
session_start();
include 'db.php';
$login_message='';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $e=$_POST['email'];
    $p=$_POST['password'];
    if (empty($e) || empty($p))
    {
        $login_message="<p style='color:red;'>Email and password are required!</p>";
    }
    else
    {
        $stmt=$conn->prepare("SELECT username, password FROM users WHERE email=?");
        $stmt->bind_param("s",$e);
        $stmt->execute();
        $res=$stmt->get_result();
        $row=$res->fetch_assoc();
        if($row)
        {
            if(password_verify($p,$row['password']))
            {
                $_SESSION['user']=$row['username'];
                $_SESSION['logged_in']=true;
                header("Location:dashboard.php");
                exit();
            }
            else
            {
                $login_message="<p style='color:red;'>Invalid credentials.</p>";
            }
        }
        else
        {
            $login_message="<p style='color:red;'>Invalid credentials.</p>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 class="site-title">EduConnect</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="login.php" class="nav-button primary">Login</a></li>
                    <li><a href="register.php" class="nav-button">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="form-section">
        <div class="container">
            <div class="form-card">
                <h2 class="form-title">Log In to Your Account</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" id="email" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" id="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn primary">Login</button>
                </form>
                <p class="form-footer-text">Don't have an account? <a href="register.php">Register here</a></p>
                <p class="form-footer-text"><a href="#">Forgot Password?</a></p>
            </div>
        </div>
    </main>
</body>
</html>