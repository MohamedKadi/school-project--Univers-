<?php

$nom_prenom = isset($_POST['nom_prenom']) ? $_POST['nom_prenom'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Check if any required field is empty
if (empty($nom_prenom) || empty($tel) || empty($email) || empty($message)) {
    echo "Please fill in all fields.";
} else {

    // Establish a connection to the MySQL database
    $conn = new mysqli('localhost:3306', 'root', '1234', 'univers_db');
    
    // Check if the connection was successful
    if ($conn->connect_error) {
        // If there's a connection error, stop the script and display the error
        die('Connection Failed: ' . $conn->connect_error);
    } else {

        // Prepare and bind
        $stmt = $conn->prepare("SELECT client_id FROM clients WHERE email = ? OR tele = ?");
        $stmt->bind_param("ss", $email, $tel);

        // Execute the query
        $stmt->execute();

        // Store the result
        $stmt->store_result();

        // Check if any record exists
        if ($stmt->num_rows > 0) {
            // Bind the result to a variable
            $stmt->bind_result($client_id);
            $stmt->fetch();
            
            // Insert just the message linked to the existing client_id
            $message_query = "INSERT INTO messages (client_id, message) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($message_query);
            $insert_stmt->bind_param("is", $client_id, $message);

            if ($insert_stmt->execute()) {
                echo "Message added successfully for the existing client.";
            } else {
                echo "Error: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        } else {
            // Construct the SQL query to insert data into the client table
            $client_query = "INSERT INTO clients (nom_prenom, tele, email) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($client_query);
            $insert_stmt->bind_param("sss", $nom_prenom, $tel, $email);

            if ($insert_stmt->execute()) {
                // Get the last inserted id from the client table
                $client_id = $conn->insert_id;

                // Insert the message linked to the new client_id
                $message_query = "INSERT INTO messages (client_id, message) VALUES (?, ?)";
                $message_stmt = $conn->prepare($message_query);
                $message_stmt->bind_param("is", $client_id, $message);

                if ($message_stmt->execute()) {
                    echo "New client and message added successfully.";
                } else {
                    echo "Error: " . $message_stmt->error;
                }

                $message_stmt->close();
            } else {
                echo "Error: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>
