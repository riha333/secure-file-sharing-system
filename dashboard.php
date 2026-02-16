<?php
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
if(isset($_GET['delete'])) {

    $file_id = $_GET['delete'];

    $result = $conn->query("SELECT * FROM files WHERE id='$file_id' AND user_id='$user_id'");
    $file = $result->fetch_assoc();

    if($file) {
        unlink($file['file_path']);
        $conn->query("DELETE FROM files WHERE id='$file_id'");
        header("Location: dashboard.php");
    }
}

if(isset($_POST['upload'])) {

    $file = $_FILES['file'];
    $fileName = time() . "_" . $file['name'];
    $target = "uploads/" . $fileName;

    $user_id = $_SESSION['user_id'];

    // Generate token
    $token = bin2hex(random_bytes(16));

    // Handle share password
    $sharePassword = $_POST['share_password'];

    if(!empty($sharePassword)) {
        $sharePassword = password_hash($sharePassword, PASSWORD_DEFAULT);
    } else {
        $sharePassword = NULL;
    }
    if(move_uploaded_file($file['tmp_name'], $target)) {

        $token = bin2hex(random_bytes(16));

        $sql = "INSERT INTO files
        (user_id, file_name, file_path, share_token, password_protected) 
        VALUES 
        ('$user_id', '$fileName', '$target', '$token', '$sharePassword')";

        $conn->query($sql);

        echo "File Uploaded Successfully!<br><br>";
    } else {
        echo "Upload Failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f8f9fc;
}
.card {
    border-radius: 15px;
}
</style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Secure File Sharing</span>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow p-4 mb-4">
        <h4>Welcome, <?php echo $_SESSION['user_name']; ?> 👋</h4>
    </div>

    <div class="card shadow p-4 mb-4">
        <h5>Upload File</h5>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" class="form-control mb-3" required>
            <input type="password" name="share_password" class="form-control mb-3" placeholder="Optional Share Password">
            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <div class="card shadow p-4">
        <h5>Your Files</h5>
        <hr>

        <?php
        $result = $conn->query("SELECT * FROM files WHERE user_id = '$user_id'");
        while($row = $result->fetch_assoc()) {
            echo "<div class='mb-3'>";
            echo "<strong>".$row['file_name']."</strong><br>";
            echo "<a href='".$row['file_path']."' class='btn btn-sm btn-success me-2' download>Download</a>";
            echo "<a href='?delete=".$row['id']."' class='btn btn-sm btn-danger me-2'>Delete</a>";
            echo "<br><small>Share Link:</small><br>";
            if(!empty($row['share_token'])){
                echo "<input type='text' class='form-control mt-1' value='http://localhost/secure-file-sharing/share.php?token=".$row['share_token']."' readonly>";

            }
            echo "</div><hr>";
        }
        ?>
    </div>

</div>

</body>
</html>


<?php
$sharePassword = $_POST['share_password'] ?? '';

if(!empty($sharePassword)) {
    $sharePassword = password_hash($sharePassword, PASSWORD_DEFAULT);
} else {
    $sharePassword = NULL;
}

