<?php
session_start();

class Movie {
    private $title;
    private $availableCopies;

    public function __construct($title, $availableCopies) {
        $this->title = $title;
        $this->availableCopies = $availableCopies;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAvailableCopies() {
        return $this->availableCopies;
    }

    public function rentMovie() {
        if ($this->availableCopies > 0) {
            $this->availableCopies--;
        }
    }

    public function returnMovie() {
        $this->availableCopies++;
    }
}

class Customer {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function rentMovie(Movie $movie) {
        $movie->rentMovie();
    }

    public function returnMovie(Movie $movie) {
        $movie->returnMovie();
    }
}

// Initialize movies in session if not already done
if (!isset($_SESSION['movies'])) {
    $_SESSION['movies'] = [
        'Inception' => new Movie("Inception", 4),
        'Interstellar' => new Movie("Interstellar", 2),
    ];
}

// Customers (fixed for this example)
$customers = [
    'Shobuj' => new Customer("Shobuj"),
    'kamal'   => new Customer("kamal")
];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customer'];
    $movieTitle = $_POST['movie'];
    $action = $_POST['action'];

    if (isset($customers[$customerName]) && isset($_SESSION['movies'][$movieTitle])) {
        $customer = $customers[$customerName];
        $movie = $_SESSION['movies'][$movieTitle];

        if ($action == "rent") {
            $customer->rentMovie($movie);
        } elseif ($action == "return") {
            $customer->returnMovie($movie);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Rental System</title>
</head>
<body>
    <h2>Movie Rental System</h2>

    <form method="post">
        <label for="customer">Select Customer:</label>
        <select name="customer" id="customer" required>
            <option value="Shobuj">Shobuj</option>
            <option value="kamal">kamal</option>
        </select>
        <br><br>

        <label for="movie">Select Movie:</label>
        <select name="movie" id="movie" required>
            <?php foreach ($_SESSION['movies'] as $title => $movie): ?>
                <option value="<?php echo $title; ?>"><?php echo $title; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="submit" name="action" value="rent">Rent Movie</button>
        <button type="submit" name="action" value="return">Return Movie</button>
    </form>

    <h3>Available Copies:</h3>
    <ul>
        <?php foreach ($_SESSION['movies'] as $title => $movie): ?>
            <li><?php echo $title . ": " . $movie->getAvailableCopies(); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
