<?php

    $nom_prenom = isset($_POST['nom_prenom']) ? $_POST['nom_prenom'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    var_dump($_POST);
    die();
    // Check if any required field is empty
    if (empty($nom_prenom) || empty($tel) || empty($email) || empty($message)) {
        echo "Please fill in all fields.";
    } else {
        // Establish a connection to the MySQL database
        $conn = new mysqli('localhost', 'root', '1234', 'univers_db');

        // Check if the connection was successful
        if ($conn->connect_error) {
            // If there's a connection error, stop the script and display the error
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            // Construct the SQL query to insert data into the client table
            $client_query = "INSERT INTO clients (nom_prenom,tele,email) VALUES ('$nom_prenom', '$tel', '$email')";

            // Execute the client query
            if ($conn->query($client_query) === false) {
                die('Query failed: ' . $conn->error);
            }

            // Get the last inserted id from the client table
            $client_id = $conn->insert_id;

            // Construct the SQL query to insert data into the message table
            $message_query = "INSERT INTO message (client_id, message) VALUES ($client_id, '$message')";

            // Execute the message query
            if ($conn->query($message_query) === false) {
                die('Query failed: ' . $conn->error);
            }

            // Display a success message
            echo "Success";

            // Close the database connection
            $conn->close();
        }
    }
?>