<?php
include 'db.php';
$registration_message='';
if (isset($_POST['register']))
{
    $u=$_POST['username'];
    $e=$_POST['email'];
    $p=$_POST['password'];
    $confirm_p=$_POST['confirmPassword'];
    if (empty($u) || empty($e) || empty($p) || empty($confirm_p))
    {
        $registration_message="<p style='color:red;'>All fiels are required!</p>";
    }
    elseif ($p!==$confirm_p)
    {
        $registration_message="<p style='color:red;'>Passwords do not match!</p>";
    }
    else
    {
        $hashed_password=password_hash($p, PASSWORD_BCRYPT);
        $stmt_check=$conn->prepare("SELECT COUNT(*) FROM users WHERE username=? OR email=?");
        $stmt_check->bind_param("ss",$u,$e);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();
        if($count>0)
        {
            $registration_message="<p style='color:red;'>Username or email already registered.</p>";
        }
        else
        {
            $stmt=$conn->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
            $stmt->bind_param("sss",$u,$e,$hashed_password);
            if ($stmt->execute())
            {
                $registration_message="<p style='color:green;'>User registered successfully!</p>";
            }
            else
            {
                $registration_message="<p style='color:red;'>Error registering user:".$stmt->error."</p>";
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educonnect - Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 class="site-title">EduConnect</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="login.php" class="nav-button">Login</a></li>
                    <li><a href="register.php" class="nav-button primary">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="form-section">
        <div class="container">
            <div class="form-card">
                <h2 class="form-title">Create Your EduConnect Account</h2>
                <?php echo $registration_message;?>
                <form method="POST" onsubmit="return validateRegisterForm()">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" type="text" id="username" placeholder="Username" required value="<?php echo isset($u)?htmlspecialchars($u):'';?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" id="email" placeholder="Email" required value="<?php echo isset($e)?htmlspecialchars($e):'';?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input name="confirmPassword" type="password" id="confirmPassword" placeholder="Confirm Password" required>
                    </div>
                    <button name="register" type="submit" class="btn primary">Register</button>
                    <button type="button" id="togglePwdBtn" onclick="togglePassword('password','confirmPassword','togglePwdBtn')" class="btn secondary" style="width:auto; margin-top:10px">Show Passwords</button>
                </form>
                <p class="form-footer-text">Already have an account?<a href="login.php">Log In here</a></p>
            </div>
        </div>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 EduConnect</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>