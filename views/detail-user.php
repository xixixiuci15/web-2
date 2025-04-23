<?php
require_once __DIR__ . '/../models/user.php';

use models\user;

if (!isset($_GET['id'])) {
    header("Location: list-user.php");
    exit;
}

$user = User::find($_GET['id']);

if (!$user) {
    header("Location: list-user.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Praktikum 06</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- navbar -->
    <?php include_once "navbar.php" ?>
    <!-- end navbar -->
    <div id="layoutSidenav">
        <!-- sidebar -->
        <?php include_once "sidebar.php" ?>
        <!-- end sidebar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add User</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-user.php">User</a></li>
                        <li class="breadcrumb-item active">Detail User</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Add User
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>First Name</th>
                                    <td><?= $user['firstname'] ?></td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td><?= $user['lastname'] ?></td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td><?= $user['gender'] ?></td>
                                </tr>
                                <tr>
                                    <th>Age</th>
                                    <td><?= $user['age'] ?></td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td><?= $user['weight'] ?></td>
                                </tr>
                            </table>

                            <div class="mt-3">
                                <a href="list-user.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                <a href="edit-user.php?id=<?= $user['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete-user.php?id=<?= $user['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
            </main>
            <!-- footer -->
            <?php include_once "footer.php" ?>
            <!-- end footer -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/datatables-simple-demo.js"></script>
</body>

</html>