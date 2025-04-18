
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="centered-element">
    <h1> Send Private Mail </h1>
    <form method="POST" action="index.php">
        <h4>Name</h4>
        <input type="text" name="name">
        <br>
        <br>
        <h4>Message</h4>
        <input type="text" name="message">
        <br>
        <br>
        <h4>Who you're going to send the message to</h4>
        <input type="text" name="towho">
        <br>
        <br>
        <button type="submit" name="send">send</button>
    </form>
    <br>
    <br>
    <h1>Check Private Mail</h1>
    <form method="POST" action="index.php">
        <h4>your name</h4>
        <input type="text" name="checkname">
        <br>
        <br>
        <button type="submit" name="checksend">Check Mail</button>
    </form>
    </div>
    </div>
</body>
</html>


<?php
    include_once "server/db.php";
    include_once "server/text.php";
    $conn = CreateDatabaseConnection();

    $result = $conn->query("SHOW TABLES LIKE 'mail'");
    if($result->num_rows <= 0){
        CreateMessageDatabaseTable($conn);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['send'])){
            if(!isset($_POST['name']) || !isset($_POST['message']) || !isset($_POST['towho'])){
                $conn->close();
                die();
            }
            $name = $_POST['name'];
            $message = $_POST['message'];
            $towho = $_POST['towho'];
            AddDataIntoDatabase($conn, $name, $message, $towho);
            header("Location: index.php");
        } else if(isset($_POST['checksend'])){
            if(!isset($_POST['checkname'])){
                die();
            }
            $name = $_POST['checkname'];
            header("Location: checkmail.php?name=$name");
        }
            
    }

    $conn->close();
    
?>