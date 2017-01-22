<?php

include_once ('DBConnection.php');
include_once ("MessagesDAO.php");
include_once ("MessagesService.php");
$server = "localhost";
$username = "root";
$password = "";
$database = "messages";
$dbconnection = new DBConnection($server, $username, $password, $database);
$connection = $dbconnection->getConnection();
$messagesDAO = new MessagesDAO($connection);
$messagesService = new MessagesService($messagesDAO);


switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    handleGetRequest($messagesService);
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

function handleGetRequest($messagesService) {
  if (isset($_GET['id'])) {
    echo $messagesService->getMessageById($_GET['id']);
  } else if (isset($_GET['fromId']) && isset($_GET['toId'])) {
    echo $messagesService->getMessagesByIdRange($_GET['fromId'], $_GET['toId']);
  } else {
    echo $messagesService->getAllMessages();
  }
}

function handlePutRequest($messagesService) {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $input = urldecode( file_get_contents("php://input") );
    $message = json_decode($input, true);
    $serverResponse = $messagesService->updateOrInsertMessage($id, $message['message']);
    if ($serverResponse != 404) {
      echo "status:".$serverResponse." ".$_SERVER['REQUEST_URI'];
    }
  }
}
