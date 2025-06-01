<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Live Class</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap">
    <style>
        .live-class-section
        {
            padding: 40px 0;
            background-color:#f8f8f8;
            min-height:calc(100vh-140px);
            display:flex;
            justify-content:center;
            align-items:flex-start;
        }
        .live-class-container
        {
            background-color:#ffffff;
            padding: 30px;
            border-radius:12px;
            box-shadow:0 6px 20px rgba(0,0,0,0.1);
            max-width: 1200px;
            width:100%;
            box-sizing:border-box;
            text-align:center;
            animation:fadeIn 0.8s ease-out;
        }
        .live-class-container h2
        {
            font-size:2.2rem;
            color:#2c3e50;
            margin-bottom:25px;
        }
        .jitsi-iframe
        {
            width: 100%;
            height: 70vh;
            border:none;
            border-radius:8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        @media(max-width:767px)
        {
            .jitsi-iframe
            {
                height:60vh;
            }
            .live-class-container
            {
                padding:20px;
            }
            .live-class-container h2
            {
                font-size:1.8rem;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 class="site-title">EduConnect</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="dashboard.php" class="nav-button">Dashboard</a></li>
                    <li><a href="upload.php" class="nav-button">Upload</a></li>
                    <li><a href="resources.php" class="nav-button">Resources</a></li>
                    <li><a href="live.php" class="nav-button primary">Live Class</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="live-class-section">
        <div class="container">
            <div class="live-class-container">
                <h2>Welcome, <?=htmlspecialchars($_SESSION['user'])?>, you're now joining the live class</h2>
                <iframe class="jitsi-iframe" src="https://meet.jit.si/EduConnectLiveRoom" allow="camera; microphone; fullscreen; display-capture"></iframe>
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