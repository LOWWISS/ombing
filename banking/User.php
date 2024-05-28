class Account {
    private $conn;
    private $table = 'accounts';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createAccount($accountNumber, $ownerName) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (account_number, owner_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $accountNumber, $ownerName);
        return $stmt->execute();
    }

    public function accountExists($accountNumber) {
        $stmt = $this->conn->prepare("SELECT 1 FROM $this->table WHERE account_number = ?");
        $stmt->bind_param("s", $accountNumber);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function deposit($accountNumber, $amount) {
        if (!$this->accountExists($accountNumber)) {
            return false;
        }
        $stmt = $this->conn->prepare("UPDATE $this->table SET balance = balance + ? WHERE account_number = ?");
        $stmt->bind_param("ds", $amount, $accountNumber);
        return $stmt->execute();
    }

    public function withdraw($accountNumber, $amount) {
        if (!$this->accountExists($accountNumber)) {
            return false;
        }
        $stmt = $this->conn->prepare("UPDATE $this->table SET balance = balance - ? WHERE account_number = ? AND balance >= ?");
        $stmt->bind_param("dsd", $amount, $accountNumber, $amount);
        return $stmt->execute();
    }

    public function getBalance($accountNumber) {
        if (!$this->accountExists($accountNumber)) {
            return false;
        }
        $stmt = $this->conn->prepare("SELECT balance FROM $this->table WHERE account_number = ?");
        $stmt->bind_param("s", $accountNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['balance'];
    }
}
