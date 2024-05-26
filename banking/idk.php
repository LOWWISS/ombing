
        <?php
        include 'db.php';

        $sql = "SELECT account_number, owner_name, balance FROM accounts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $formatted_balance = number_format($row['balance'], 2, '.', ',');
                echo "<tr>
                        <td>{$row['account_number']}</td>
                        <td>{$row['owner_name']}</td>
                        <td>{$formatted_balance}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No accounts found</td></tr>";
        }

        $conn->close();
        ?>
    

    <?php
include 'Database.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account_number = $_POST['account_number'];
    $owner_name = $_POST['owner_name'];
    $initial_balance = $_POST['initial_balance'];
    $message = $db->createAccount($account_number, $owner_name, $initial_balance);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Account</title>
</head>
<body>
<div class="container">
    <h2>Create Account</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Go back to home</a>

    <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>

    <form method="post" action="create_account.php">
        <div class="form-group">
            <label for="account_number">Account Number:</label>
            <input type="number" class="form-control" id="account_number" name="account_number" required>
        </div>
        <div class="form-group">
            <label for="owner_name">Owner Name:</label>
            <input type="text" class="form-control" id="owner_name" name="owner_name" required>
        </div>
        <div class="form-group">
            <label for="initial_balance">Initial Balance:</label>
            <input type="number" class="form-control" id="initial_balance" name="initial_balance" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
