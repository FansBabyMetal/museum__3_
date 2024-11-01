<?php
session_start();
include '../koneksi.php';

// Check if the user is authorized
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

// Fetch countries from the database
$stmt = $pdo->query("SELECT * FROM negara");
$negaras = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        h1 {
            color: #007bff;
        }
        .table {
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-warning, .btn-danger {
            color: white;
        }
    </style>
    <title>Manage Countries</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Manage Countries</h1>
        <div class="text-right mb-3">
            <a href="tambah.php" class="btn btn-success">Add Country</a>
            <a href="../index.php" class="btn btn-secondary">Back</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($negaras as $negara): ?>
                    <tr>
                        <td><?= $negara['id_negara'] ?></td>
                        <td><?= htmlspecialchars($negara['nama_negara']) ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $negara['id_negara'] ?>" class="btn btn-warning">Edit</a>
                            <a href="hapus.php?id=<?= $negara['id_negara'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this country?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</body>

</html>