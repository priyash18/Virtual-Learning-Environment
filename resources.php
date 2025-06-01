<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Resources</title>
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
                    <li><a href="upload.php" class="nav-button">Upload</a></li>
                    <li><a href="resources.php" class="nav-button primary">Resources</a></li>
                    <li><a href="logout.php" class="nav-button">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="content-section">
        <div class="container">
            <div class="resources-card">
                <h2 class="section-title">Downloadable Resources</h2>
                <?php
                $resource_message='';
                $resources_found=false;
                $res=$conn->query("SELECT title, filename FROM resources ORDER BY uploaded_on DESC");
                if($res->num_rows>0)
                {
                    $resources_found=true;
                    echo "<ul class='resource-list'>";
                    while ($row=$res->fetch_assoc())
                    {
                        $safe_filename=urlencode($row['filename']);
                        $display_title=htmlspecialchars($row['title']);
                        echo "<li><a href='uploads/{$safe_filename}'download>{$display_title}</a></li>";
                    }
                    echo "</ul>";
                }
                else
                {
                    $resource_message="<p class='no-resources'>No resources available yet. <a href='upload.php'>Upload One!</a></p>";
                }
                ?>
                <?php echo $resource_message; ?>
                <?php if ($resources_found):?>
                    <div class="resource-actions">
                        <a href="upload.php" class="btn secondary">Upload New Resource</a>
                    </div>
                <?php endif; ?>    
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