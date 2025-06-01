<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap">
    <style>
        .container
        {
            color:black;
        }
        .dashboard-banner
        {
            padding: 80px 20px;
            text-align: center;
            color: white;
        }
        .dashboard-banner h2
        {
            font-size:2.8rem;
            margin-bottom:1rem;
            font-weight:700;
        }
        .dashboard-banner p
        {
            font-size:1.2rem;
            opacity:0.9;
        }
        .features-grid
        {
            display: flex;
            justify-content:center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top:0px;
        }
        .feature-box
        {
            background-color: #fff;
            padding: 30px 25px;
            border-radius: 12px;
            width: 280px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.8);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .feature-box:hover
        {
            transform: translateY(-5px);
        }
        .feature-box img
        {
            width: 60px;
        }
        .feature-box h3
        {
            margin-bottom: 10px;
            color:#007bff;
            font-size:1.4rem;
        }
        .feature-box p
        {
            font-size:0.95rem;
            color: #666;
        }
        .dashboard-actions 
        {
            margin-top:50px;
            display:flex;
            justify-content: center;
            flex-wrap: wrap;
            gap:25px;
        }
        .dashboard-actions .btn
        {
            min-width:220px;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 class="site-title">EduConnect</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="dashboard.php" class="nav-button primary">Dashboard</a></li>
                    <li><a href="upload.php" class="nav-button">Upload</a></li>
                    <li><a href="resources.php" class="nav-button">Resources</a></li>
                    <li><a href="live.php" class="nav-button">Live Class</a></li>
                    <li><a href="logout.php" class="nav-button">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="dashboard-banner">
        <div class="container">
            <h2>Welcome, <?=htmlspecialchars($_SESSION['user'])?>!</h2>
            <p>Access live sessions, share files, and collaborate in real time.</p>
        </div>
    </section>
    <main class="content-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" alt="Upload">
                    <h3>Upload Files</h3>
                    <p>Share notes, assignments, or study material with the class.</p>
                    <a href="upload.php" class="btn primary">Upload Now</a>
                </div>
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/3022/3022258.png" alt="Resources">
                    <h3>View Resources</h3>
                    <p>Download shared files and materials anytime, anywhere.</p>
                    <a href="resources.php" class="btn secondary">Browse Files</a>
                </div>
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/2939/2939566.png" alt="Live">
                    <h3>Live class</h3>
                    <p>Join the live video session with your instructor and classmates.</p>
                    <a href="live.php" class="btn primary">Join Class</a>
                </div>
            </div>
        </div>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 EduConnect.</p>
        </div>
    </footer>
</body>
</html>