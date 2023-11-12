<?php

require_once 'vendor/autoload.php'; // Assuming you have Faker installed via Composer

$faker = Faker\Factory::create();

// Database connection parameters
$host = 'localhost';
$db = 'recordsapp';
$user = 'root';
$pass = 'root123456789';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert records into the 'employee' table
    $employeeStmt = $pdo->prepare("INSERT INTO employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
    for ($i = 0; $i < 100; $i++) {
        $lastname = $faker->lastName;
        $firstname = $faker->firstName;
        $office_id = $faker->numberBetween(1, 5);
        $address = $faker->address;

        $employeeStmt->execute([$lastname, $firstname, $office_id, $address]);
    }

    // Insert records into the 'office' table
    $officeStmt = $pdo->prepare("INSERT INTO office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
    for ($i = 0; $i < 50; $i++) {
        $name = $faker->company;
        $contactnum = $faker->phoneNumber;
        $email = $faker->email;
        $address = $faker->address;
        $city = $faker->city;
        $country = $faker->country;
        $postal = $faker->postcode;

        $officeStmt->execute([$name, $contactnum, $email, $address, $city, $country, $postal]);
    }

    // Insert records into the 'transaction' table
    $transactionStmt = $pdo->prepare("INSERT INTO transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (?, ?, ?, ?, ?, ?)");
    for ($i = 0; $i < 50; $i++) {
        $employee_id = $faker->numberBetween(1, 100);
        $office_id = $faker->numberBetween(1, 5);
        $datelog = $faker->dateTimeThisMonth->format('Y-m-d H:i:s');
        $action = $faker->randomElement(['IN', 'OUT', 'COMPLETE']);
        $remarks = $faker->realText(50); 
        $documentcode = $faker->ean8;

        $transactionStmt->execute([$employee_id, $office_id, $datelog, $action, $remarks, $documentcode]);
    }

    echo "Records inserted successfully!\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>