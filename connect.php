<?php
    // Retrieve form data from POST request
    $nom_prenom = isset($_POST['nom_prenom']) ? $_POST['nom_prenom'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Check if any required field is empty
    if (empty($nom_prenom) || empty($tel) || empty($email) || empty($message)) {
        echo "Please fill in all fields.";
    } else {
        // Establish a connection to the MySQL database
        $conn = new mysqli('localhost', 'root', '', 'clients');

        // Check if the connection was successful
        if ($conn->connect_error) {
            // If there's a connection error, stop the script and display the error
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            // Prepare an SQL statement to insert data into the client table
            $stmt = $conn->prepare("INSERT INTO client (C_Nom_Prenom, C_tele, C_email) VALUES (?, ?, ?)");

            // Check if statement preparation was successful
            if ($stmt === false) {
                die('Prepare failed: ' . $conn->error);
            }

            // Bind the form data to the SQL statement parameters
            $stmt->bind_param("sss", $nom_prenom, $tel, $email);

            // Execute the SQL statement
            $stmt->execute();

            // Get the last inserted id from the client table
            $client_id = $conn->insert_id;

            // Prepare an SQL statement to insert data into the message table
            $stmt1 = $conn->prepare("INSERT INTO message (C_Num, Message) VALUES (?, ?)");

            // Check if statement preparation was successful
            if ($stmt1 === false) {
                die('Prepare failed: ' . $conn->error);
            }

            // Bind the client_id and message data to the SQL statement parameters
            $stmt1->bind_param("is", $client_id, $message);

            // Execute the SQL statement
            $stmt1->execute();

            // Display a success message
            echo "Success";

            // Close the prepared statements and the database connection
            $stmt->close();
            $stmt1->close();
            $conn->close();
        }
    }
?>
