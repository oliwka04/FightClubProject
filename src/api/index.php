<?php

include("db_login_data.php");

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}

function test()
{
    $api = new stdClass();
    $api->info = "API works fine!";
    echo json_encode($api);
}

function getUsers()
{
    $api = new stdClass();
    $api->users = getFromDB("SELECT * FROM `users`");
    echo json_encode($api);
}

function getFromDB($sql)
{
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $dbname = $_SESSION['DBname'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $obj = $conn->query($sql);

    $rows = array();

    if ($obj->num_rows > 0) {
        while ($row = $obj->fetch_assoc()) {
            array_push($rows, $row);
        }
    }

    return $rows;

    $conn->close();
}

function commands()
{
    if (isset($_GET['getUsers'])) {
        getUsers();
    } else {
        test();
    }
}

commands();

?>