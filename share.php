<?php
include 'config.php';

if(isset($_GET['token'])) {

    $token = $_GET['token'];

    $result = $conn->query("SELECT * FROM files WHERE share_token='$token'");
    $file = $result->fetch_assoc();

    if(!$file) {
        die("Invalid link.");
    }

    // If file has password
    if(!empty($file['password_protected'])) {

        if(!isset($_POST['password'])) {
            ?>
            <form method="POST">
                Enter Password:
                <input type="password" name="password" required>
                <button type="submit">Access File</button>
            </form>
            <?php
            exit();
        }

        if(!password_verify($_POST['password'], $file['password_protected'])) {
            die("Wrong Password!");
        }
    }

    header("Content-Disposition: attachment; filename=" . basename($file['file_name']));
    readfile($file['file_path']);
    exit();
}
?>
