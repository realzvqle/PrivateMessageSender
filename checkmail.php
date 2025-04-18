<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <title>Private Mailer</title>
</head>
<body>
    <div class="container">
    <div class="centered-element">
    <h1>Mail Sent to you</h1>
    <?php

        include_once "server/db.php";
        include_once "server/text.php";

        $conn = CreateDatabaseConnection();

        if(!isset($_GET['name'])){
            PrintText("Please enter a name");
            die();
        }

        $name = $_GET['name'];

        PrintText(ReadMessages($conn, $name));



        $conn->close();



    ?>
    <a href="index.php">Go Back</a>
    </div>
    </div>
</body>
</html>


