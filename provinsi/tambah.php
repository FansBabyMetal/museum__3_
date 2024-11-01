<?php
session_start();
include '../koneksi.php';

// Check if the user is authorized
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'superadmin')) {
    header('Location: ../index.php');
    exit;
}

// Fetch countries for the dropdown
$stmt = $pdo->query("SELECT * FROM negara");
$negaras = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_provinsi = $_POST['id_provinsi'];
    $nama_provinsi = $_POST['nama_provinsi'];
    $id_negara = $_POST['id_negara'];

    // Insert province into database
    $stmt = $pdo->prepare("INSERT INTO provinsi (id_provinsi, nama_provinsi, id_negara) VALUES (?, ?, ?)");
    $stmt->execute([$id_provinsi, $nama_provinsi, $id_negara]);

    $_SESSION['success'] = "Province added successfully!";
    header('Location: index.php'); // Redirect to manage provinces page
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
    <title>Add Province</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Add Province</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_provinsi">Province Id</label>
                <input type="text" class="form-control" id="id_provinsi" name="id_provinsi"  placeholder="id_provinsi" value="P2" required>
                <label for="nama_provinsi">Province Name</label>
                <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" placeholder="nama_provinsi" required>
            </div>
            <div class="form-group">
                <label for="id_negara">Country</label>
                <select class="form-control" id="id_negara" name="id_negara" placeholder="id_negara" required>
                    <option value="">Select Country</option>
                    <?php foreach ($negaras as $negara): ?>
                        <option value="<?= $negara['id_negara'] ?>"><?= htmlspecialchars($negara['nama_negara']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Province</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>