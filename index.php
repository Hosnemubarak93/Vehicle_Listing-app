<?php
// Load vehicles from JSON
$file = 'vehicles.json';
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}
$vehicles = json_decode(file_get_contents($file), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vehicle Listing App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg_body">
<div class="container py-5">
    <h1 class="mb-4"> Vehicle Listing</h1>
    <a href="add.php" class="btn btn-primary mb-3">+ Add Vehicle</a>
    <div class="row">
        <?php if (empty($vehicles)) : ?>
            <p>No vehicles found.</p>
        <?php else : ?>
            <?php foreach ($vehicles as $id => $vehicle): ?>
                <div class="col-md-4">
                    <div class="card mb-4 bg_card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($vehicle['name']) ?></h5>
                            <p class="card-text">
                                <strong>Brand:</strong> <?= htmlspecialchars($vehicle['brand']) ?><br>
                                <strong>Year:</strong> <?= htmlspecialchars($vehicle['year']) ?><br>
                                <strong>Price:</strong> $<?= htmlspecialchars($vehicle['price']) ?>
                            </p>
                            <a href="edit.php?id=<?= $id ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
