<?php

include "connection.php";

$query = "CREATE TABLE contact_us (
    sn INT PRIMARY KEY AUTO_INCREMENT,
    user_sn INT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_sn) REFERENCES user(sn)
);";

if ($conn->query($query) === TRUE) {
    echo "Table 'contact_us' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>