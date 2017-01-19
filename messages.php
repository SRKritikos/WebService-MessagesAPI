<?php
include_once ('DBConnection.php');
include_once ("MessagesDAO.php");
include_once ("MessagesService.php");
$server="localhost";
$username="root";
$password="mysql";
$database="messages";
$dbconnection = new DBConnection($server, $username, $password, $database);
$connection = $dbconnection->getConnection();
$messagesDAO = new MessagesDAO($connection);
$messagesService = new MessagesService($messagesDAO);


switch($_SERVER['REQUEST_METHOD']) {
    case 'GET': 
        handleGetRequest($messagesDAO);
        break;
    case 'POST':
        echo "POST REQUEST";
        break;
    case 'PUT':
        handlePutRequest($messagesService);
        break;
    default:
        echo "GET REQUEST";
        break;
}

function handleGetRequest($messagesDAO) {
    if (isset($_GET['id'])) {
      echo $messagesDAO->getMessageById($_GET['id']);
    } else if (isset($_GET['fromId']) && isset($_GET['toId'])) {
      echo $messagesDAO->getMessagesByIdRange($_GET['fromId'], $_GET['toId']);
    } else {
      echo $messagesDAO->getAllMessages();
    }
}

function handlePutRequest($messagesService) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $input = file_get_contents("php://input");
        $input = urldecode($input);
        $message = json_decode($input,true);
        if ($messagesService->updateOrInsert($id, $message['message'])) {
            echo $_SERVER['REQUEST_URI'];
        }
    }  
}
