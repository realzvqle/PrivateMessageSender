<?php

function CreateDatabaseConnection(){
    $conn = null;
    try {
        $conn = mysqli_connect("localhost", "root", "", "storage");
    } catch(Exception $e){
        $creation = mysqli_connect("localhost", "root", "");
        $creation->query("CREATE DATABASE storage");
        $creation->close();
        $conn = mysqli_connect("localhost", "root", "", "storage");
        
    }
    return $conn;
}

function CreateMessageDatabaseTable($conn){
    $conn->query("CREATE TABLE mail (sender TEXT NOT NULL, message TEXT NOT NULL, reciever TEXT NOT NULL)");
}

function AddDataIntoDatabase($conn, $name, $data, $rec){
    $stmt = mysqli_prepare($conn, "INSERT INTO mail (sender, message, reciever) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $data, $rec);
    $stmt->execute();
}

function ReadMessages($conn, $name) {
    $messages = [];
    $data = null;
    $stmt = mysqli_prepare($conn, "SELECT sender, message FROM mail WHERE reciever = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->bind_result($name, $data);
    while($stmt->fetch()){
        $messages[] = "$name - $data";
    }
    if(!empty($messages)){
        $result = implode("<br><br>", $messages);
        return $result;
    } else return "Couldn't Find Anything";
}

?>