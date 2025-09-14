<?php
$file = 'vehicles.json';
$vehicles = json_decode(file_get_contents($file), true);

$id = $_GET['id'];
if (!isset($vehicles[$id])) {
    die("Vehicle not found!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicles[$id] = [
        'name' => $_POST['name'],
        'brand' => $_POST['brand'],
        'year' => $_POST['year'],
        'price' => $_POST['price']
    ];
    file_put_contents($file, json_encode($vehicles, JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit;
}

$vehicle = $vehicles[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2>Edit Vehicle</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Vehicle Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($vehicle['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" value="<?= htmlspecialchars($vehicle['brand']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="<?= htmlspecialchars($vehicle['year']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price ($)</label>
            <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($vehicle['price']) ?>" required>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
