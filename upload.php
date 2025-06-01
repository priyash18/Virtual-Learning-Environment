<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}
$upload_message = '';
if(isset($_POST['upload']))
{
    $title = $_POST['title'];
    $file_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $upload_dir = "uploads/";
    if(!is_dir($upload_dir))
    {
        mkdir($upload_dir, 0777, true);
    }
    if($file_error === UPLOAD_ERR_OK)
    {
        $clean_file_name = basename($file_name);
        $extension = pathinfo($clean_file_name, PATHINFO_EXTENSION);
        $base_name = pathinfo($clean_file_name, PATHINFO_FILENAME);
        $unique_file_name = uniqid().'_'.preg_replace("/[^a-zA-Z0-9_\-.]/", "", $base_name).'.'.$extension;
        $target_file = $upload_dir.$unique_file_name;
        if (move_uploaded_file($tmp_name, $target_file))
        {
            $stmt = $conn->prepare("INSERT INTO resources (title, filename, uploaded_on) VALUES (?, ?, NOW())");
            if($stmt)
            {
                $stmt->bind_param("ss", $title, $unique_file_name);
                if($stmt->execute())
                {
                    $upload_message = "<p style='color:green;'>File uploaded successfully!</p>";
                }
                else
                {
                    unlink($target_file);
                    $upload_message = "<p style='color:red;'>Error saving file info to database: ".$stmt->error."</p>";
                }
                $stmt->close();
            }
            else
            {
                unlink($target_file);
                $upload_message = "<p style='color:red;'>Database preparation error: ".$conn->error."</p>";
            }
        }    
        else
        {   
            $upload_message = "<p style='color:red;'>Error uploading file to server.</p>";
        }
    }
    else
    {
        $upload_message = "<p style='color:red;'>File upload error: ".$file_error."</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Upload Resources</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 class="site-title">EduConnect</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="dashboard.php" class="nav-button">Dashboard</a></li>
                    <li><a href="upload.php" class="nav-button primary">Upload</a></li>
                    <li><a href="resources.php" class="nav-button">Resources</a></li>
                    <li><a href="logout.php" class="nav-button">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="form-section">
        <div class="container">
            <div class="form-card">
                <h2 class="form-title">Upload a New Resource</h2>
                <?php echo $upload_message; ?>
                <form method="POST" enctype="multipart/form-data" onsubmit="return confirmUpload()">
                    <div class="form-group">
                        <label for="title">Resource Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g.,Lecture Notes - Module 1" required>
                    </div>
                    <div class="form-group">
                        <label for="file">Select File</label>
                        <input type="file" id="file" name="file" required>
                    </div>
                    <button name="upload" type="submit" class="btn primary">Upload Resource</button>
                </form>
                <p class="form-footer-text">View existing resources <a href="resources.php">here</a></p>
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