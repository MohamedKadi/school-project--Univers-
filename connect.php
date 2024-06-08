<?php
    // Output POST data for debugging
    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";*/

    $nom_prenom = null;
    $tel = null;
    $email = null;
    $message = null;

    // Retrieve form data from POST request and trim whitespace
    $nom_prenom = isset($_POST['nom_prenom']) ? trim($_POST['nom_prenom']) : '';
    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    


    // Check if any required field is empty
    if (empty($nom_prenom) || empty($tel) || empty($email) || empty($message)) {
        if(empty(trim($nom_prenom))){
            echo $nom_prenom_error = "le nom et le prenom est vide!!\r\n";
        }else{
            if(empty(trim($tel))){
                echo $tel_error = "le numero de telephone est vide!!\r\n";
            }else{
                if(empty(trim($email))){
                    echo $email_error = "email champ est vide!!\r\n";
                }else{
                    if(empty(trim($message))){
                        echo $message_error = "message champ est vide!!\r\n";
                    }
                }
            }
        }
        echo "Veuillez remplir tous les champs.";
    } else {
        // Establish a connection to the MySQL database
        $conn = new mysqli('localhost', 'root', '', 'clients');

        // Check if the connection was successful
        if ($conn->connect_error) {
            // If there's a connection error, stop the script and display the error
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            // Check if the email and phone number already exist in the client table
            $stmt = $conn->prepare("SELECT C_Num FROM client WHERE C_email = ? AND C_tele = ?");
            $stmt->bind_param("ss", $email, $tel);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // If the client exists, get the client ID
                $stmt->bind_result($client_id);
                $stmt->fetch();
            } else {
                // If the client does not exist, insert new client data
                $stmt = $conn->prepare("INSERT INTO client (C_Nom_Prenom, C_tele, C_email) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nom_prenom, $tel, $email);
                $stmt->execute();
                $client_id = $conn->insert_id;
            }

            // Insert the message into the message table
            $stmt1 = $conn->prepare("INSERT INTO message (C_Num, Message) VALUES (?, ?)");
            $stmt1->bind_param("is", $client_id, $message);
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
