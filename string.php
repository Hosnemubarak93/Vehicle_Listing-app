<?php
// Given array of strings
$strings = ["Bangladesh", "Laravel", "PHP", "Assignment"];

// Function to count consonants
function countConsonants($str) {
    $str = strtolower($str);
    $count = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $ch = $str[$i];
        if (ctype_alpha($ch) && !in_array($ch, ['a', 'e', 'i', 'o', 'u'])) {
            $count++;
        }
    }
    return $count;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>String Processing</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 60%; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>String Processing Result</h2>
    <table>
        <tr>
            <th>Original String</th>
            <th>Consonant Count</th>
            <th>Uppercase String</th>
        </tr>
        <?php foreach ($strings as $str): ?>
            <tr>
                <td><?php echo $str; ?></td>
                <td><?php echo countConsonants($str); ?></td>
                <td><?php echo strtoupper($str); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
