<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_negara = $_POST['id_negara'];
    $nama_negara = $_POST['nama_negara'];

    $stmt = $pdo->prepare("INSERT INTO negara (id_negara, nama_negara) VALUES (?, ?)");
    $stmt->execute([$id_negara, $nama_negara]);

    header('Location: index.php');
    exit;
}
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
    <title>Add Country</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Add Country</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_negara">Country Id</label>
                <input type="text" class="form-control" id="id_negara" name="id_negara" placeholder="id_negara" value="N3" required>
                <label for="nama_negara">Country Name</label>
                <input type="text" class="form-control" id="nama_negara" name="nama_negara"  placeholder="nama_negara" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Country</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
