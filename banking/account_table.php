<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Account Details</title>
</head>
<body>
<div class="container">
    <h3>Account Details</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Account Number</th>
                <th>Owner Name</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
