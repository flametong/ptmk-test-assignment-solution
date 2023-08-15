<?php

namespace App\Models;

use App\Storage\Db;
use mysqli;

class Person
{

    private mysqli $conn;

    public function __construct()
    {
        $this->conn = (Db::getInstance())->getConnection();
    }

    public function createTable(): void
    {
        $sql =
            "CREATE TABLE IF NOT EXISTS people (
                id INT AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(255) NOT NULL,
                birth_date DATE NOT NULL,
                gender VARCHAR(10) NOT NULL
            )";

        if ($this->conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function insertPerson(
        string $fullName,
        string $birthDate,
        string $gender
    ): void 
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO people (full_name, birth_date, gender) 
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param('sss', $fullName, $birthDate, $gender);

        if ($stmt->execute()) {
            echo "Record created successfully";
        } else {
            echo "Error creating record: " . $this->conn->error;
        }

        $stmt->close();
    }

    public function insertMillionRecords(): void
    {
        $genders = ['Male', 'Female'];

        $firstNameInitials = range('A', 'Z');

        $stmt = $this->conn->prepare(
            "INSERT INTO people (full_name, birth_date, gender) 
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param('sss', $fullName, $birthDate, $gender);

        for ($i = 0; $i < 1000000; $i++) {
            $gender    = $genders[array_rand($genders)];

            $initial   = $firstNameInitials[array_rand($firstNameInitials)];
            $fullName  = $initial . "Doe";

            $birthDate = date(
                'Y-m-d',
                mktime(
                    0, 0, 0,
                    mt_rand(1, 12), mt_rand(1, 28), mt_rand(1930, 2005)
                )
            );

            $stmt->execute();
        }

        echo "Million records created successfully\n";

        $stmt->close();
    }

    public function insertHundredRecords(): void
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO people (full_name, birth_date, gender) 
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param('sss', $fullName, $birthDate, $gender);

        for ($i = 0; $i < 100; $i++) {
            $gender    = 'Male';
            $fullName  = 'FredWeasley';
            $birthDate = date(
                'Y-m-d',
                mktime(
                    0, 0, 0,
                    mt_rand(1, 12), mt_rand(1, 28), mt_rand(1930, 2005)
                )
            );

            $stmt->execute();
        }

        echo "A hundred records with Male gender and starting with 'F' created successfully";

        $stmt->close();
    }

    public function readUniquePersons(): void
    {
        $sql =
            "SELECT DISTINCT 
                full_name, 
                birth_date,
                gender, 
                TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age 
             FROM people 
             ORDER BY full_name";

        $result = $this->conn->query($sql);

        if ($result->num_rows === 0) {
            echo "No records found";
            return;
        }

        while ($row = $result->fetch_assoc()) {
            echo
                "Full Name: "
                . $row["full_name"]
                . ", Birth Date: "
                . $row["birth_date"]
                . ", Gender: "
                . $row["gender"]
                . ", Age: "
                . $row["age"]
                . "\n";
        }
    }

    public function readSpecialPersons(): void
    {
        $startTime = microtime(true);

        $sql =
            "SELECT * 
             FROM people 
             WHERE 
                gender = 'Male' 
                AND full_name LIKE 'F%'";

        $result = $this->conn->query($sql);

        $endTime = microtime(true);

        $executionTime = $endTime - $startTime;

        if ($result->num_rows === 0) {
            echo "No records found";
            return;
        }

        while ($row = $result->fetch_assoc()) {
            echo
                "Full Name: "
                . $row["full_name"]
                . ", Birth Date: "
                . $row["birth_date"]
                . ", Gender: "
                . $row["gender"]
                . "\n";
        }

        echo "Execution time: " . $executionTime . " seconds";
    }

    public function createIndex(): void
    {
        $query = 
            "CREATE INDEX idx_full_name_gender 
             ON people(full_name, gender)";

        if ($this->conn->query($query) === TRUE) {
            echo "Composite index created successfully";
        } else {
            echo "Error creating index: " . $this->conn->error;
        }
    }

    public function dropIndex(): void
    {
        $query = 
            "DROP INDEX idx_full_name_gender 
             ON people";
        
        $this->conn->query($query);
    
        echo "Composite index dropped";
    }

}