<?php
$file = 'vehicles.json';
$vehicles = json_decode(file_get_contents($file), true);

$id = $_GET['id'];
if (isset($vehicles[$id])) {
    unset($vehicles[$id]);
    $vehicles = array_values($vehicles); // reindex
    file_put_contents($file, json_encode($vehicles, JSON_PRETTY_PRINT));
}
header("Location: index.php");
exit;
?>
