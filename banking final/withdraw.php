 	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Withdraw Money</title>
</head>
<body>
    <div class="container">
    <h2>Transfer Money</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Go back to home</a>
    <!-- Rest of your code -->
</div>
<div class="container">
    <h2>Withdraw Money</h2>
    <form action="withdraw.php" method="post">
        <div class="form-group">
            <label for="accountNumber">Account Number:</label>
            <input type="text" class="form-control" id="accountNumber" name="accountNumber" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
        </div>
        <button type="submit" class="btn btn-primary">Withdraw</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';
    include 'Account.php';
    $account = new Account($conn);
    $accountNumber = $_POST['accountNumber'];
    $amount = $_POST['amount'];

    if ($account->withdraw($accountNumber, $amount)) {
        echo "<div class='alert alert-success'>Money withdrawn successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error withdrawing money or insufficient funds!</div>";
    }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
;