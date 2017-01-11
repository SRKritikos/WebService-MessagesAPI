<?php
include_once ('DBConnection.php');
include_once ("MessagesDAO.php");
$server="localhost";
$username="root";
$password="a";
$database="messages";
$dbconnection = new DBConnection($server, $username, $password, $database);
$connection = $dbconnection->getConnection();
$messagesDAO = new MessagesDAO($connection);


switch($_SERVER['REQUEST_METHOD']) {
    case 'GET': 
        echo "GET REQUEST";
        break;
    case 'POST':
        echo "POST REQUEST";
        break;
    case 'PUT':
        echo "PUT REQUEST";
        break;
    default:
        echo "GET REQUEST";
        break;
}


if (!isset($_GET['id'])) {
    echo $messagesDAO->getAllMessages();
} else {
    echo $messagesDAO->getMessageById($_GET['id']);
}
