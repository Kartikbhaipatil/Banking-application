<?php
class BankDetails {
    private $accno;
    private $name;
    private $acc_type;
    private $balance;

    //method to open new account
    public function openAccount() {
        $sc = fopen("php://stdin", "r");
        echo "Enter Account No: ";
        $this->accno = trim(fgets($sc));
        echo "Enter Account type: ";
        $this->acc_type = trim(fgets($sc));
        echo "Enter Name: ";
        $this->name = trim(fgets($sc));
        echo "Enter Balance: ";
        $this->balance = (int)trim(fgets($sc));
        fclose($sc);
    }

    //method to display account details
    public function showAccount() {
        echo "Name of account holder: " . $this->name . "\n";
        echo "Account no.: " . $this->accno . "\n";
        echo "Account type: " . $this->acc_type . "\n";
        echo "Balance: " . $this->balance . "\n";
    }

    //method to deposit money
    public function deposit() {
        $sc = fopen("php://stdin", "r");
        echo "Enter the amount you want to deposit: ";
        $amt = (int)trim(fgets($sc));
        $this->balance += $amt;
        fclose($sc);
    }

    //method to withdraw money
    public function withdrawal() {
        $sc = fopen("php://stdin", "r");
        echo "Enter the amount you want to withdraw: ";
        $amt = (int)trim(fgets($sc));
        if ($this->balance >= $amt) {
            $this->balance -= $amt;
            echo "Balance after withdrawal: " . $this->balance . "\n";
        } else {
            echo "Your balance is less than " . $amt . "\tTransaction failed...!!\n";
        }
        fclose($sc);
    }

    //method to search an account number
    public function search($ac_no) {
        if ($this->accno === $ac_no) {
            $this->showAccount();
            return true;
        }
        return false;
    }
}

class BankingApp {
    public static function main() {
        $sc = fopen("php://stdin", "r");
        //create initial accounts
        echo "How many number of customers do you want to input? ";
        $n = (int)trim(fgets($sc));
        $C = array();
        for ($i = 0; $i < $n; $i++) {
            $C[$i] = new BankDetails();
            $C[$i]->openAccount();
        }

        // loop runs until number 5 is not pressed to exit
        $ch;
        do {
            echo "\n ***Banking System Application***\n";
            echo "1. Display all account details \n 2. Search by Account number\n 3. Deposit the amount \n 4. Withdraw the amount \n 5.Exit \n";
            echo "Enter your choice: ";
            $ch = (int)trim(fgets($sc));
            switch ($ch) {
                case 1:
                    for ($i = 0; $i < count($C); $i++) {
                        $C[$i]->showAccount();
                    }
                    break;
                case 2:
                    echo "Enter account no. you want to search: ";
                    $ac_no = trim(fgets($sc));
                    $found = false;
                    for ($i = 0; $i < count($C); $i++) {
                        $found = $C[$i]->search($ac_no);
                        if ($found) {
                            break;
                        }
                    }
                    if (!$found) {
                        echo "Search failed! Account doesn't exist..!!\n";
                    }
                    break;
                case 3:
                    echo "Enter Account no. : ";
                    $ac_no = trim(fgets($sc));
                    $found = false;
                    for ($i = 0; $i < count($C); $i++) {
                        // Additional code for deposit would go here
                    }
                    break;
            }
        } while ($ch != 5);
        fclose($sc);
    }
}

BankingApp::main();
?>

