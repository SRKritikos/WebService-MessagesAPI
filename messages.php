<?php

include_once ('DBConnection.php');
include_once ("MessagesDAO.php");
include_once ("MessagesService.php");
include_once ("APIResponse.php");
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
    handlePostRequest($messagesService);
    break;
  case 'PUT':
    handlePutRequest($messagesService);
    break;
  default:
    echo "GET REQUEST";
    break;
}

function handleGetRequest($messagesService) {
  $response;
  if (isset($_GET['id'])) {
    $response = $messagesService->getMessageById($_GET['id']);
  } else if (isset($_GET['fromId']) && isset($_GET['toId'])) {
    echo $messagesService->getMessagesByIdRange($_GET['fromId'], $_GET['toId']);
  } else {
    $response = $messagesService->getAllMessages();
  }
  http_response_code($response->getStatus());
  echo json_encode($response);
}

function handlePutRequest($messagesService) {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $input = urldecode( file_get_contents("php://input") );
    $message = json_decode($input, true);
    $response = $messagesService->updateOrInsertMessage($id, $message['message']);
    header("Location: ".$_SERVER['REQUEST_URI']);
    http_response_code($response->getStatus()); 
  }
}

function handlePostRequest($messagesService) {
    $input = urldecode( file_get_contents("php://input") );
    $message = json_decode($input, true);
    $response = $messagesService->insertMessage($message['message']);
    if ($response->getStatus() == 201) {
      header("Location: ".$_SERVER['REQUEST_URI']."/".$response->getData());
    }
    http_response_code($response->getStatus());
}
