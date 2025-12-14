<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD User Management</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">User CRUD App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="insert.php" class="btn btn-primary shadow-sm rounded-pill px-4">
                            + Add User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/Shayan-Codes-dev/CRUD-Management-App" class="btn btn-outline-seecondary shadow-sm rounded-pill px-4">
                            Github
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>