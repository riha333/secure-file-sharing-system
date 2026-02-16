<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure File Sharing System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            scroll-behavior: smooth;
        }
        .hero {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            color: white;
            padding: 100px 0;
        }
        .feature-icon {
            font-size: 40px;
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Secure File Sharing</a>
        <div>
            <a href="login.php" class="btn btn-outline-light me-2">Login</a>
            <a href="register.php" class="btn btn-success">Register</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Secure & Reliable File Sharing</h1>
        <p class="lead mt-3">
            A web-based system that allows users to upload, manage, and securely share files 
            with password-protected and token-based access.
        </p>
        <a href="register.php" class="btn btn-light btn-lg mt-4">Get Started</a>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="mb-5">Key Features</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="feature-icon">🔐</div>
                <h5 class="mt-3">User Authentication</h5>
                <p>Secure login and registration system with hashed passwords and session management.</p>
            </div>

            <div class="col-md-4">
                <div class="feature-icon">📂</div>
                <h5 class="mt-3">File Management</h5>
                <p>Upload, download, and delete files securely with user-specific access control.</p>
            </div>

            <div class="col-md-4">
                <div class="feature-icon">🔗</div>
                <h5 class="mt-3">Secure Sharing</h5>
                <p>Generate unique shareable links with optional password protection for enhanced security.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <p class="mb-0">
            © <?php echo date("Y"); ?> Secure File Sharing System | Developed using PHP & MySQL
        </p>
    </div>
</footer>

</body>
</html>
