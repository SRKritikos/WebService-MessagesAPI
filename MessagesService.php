<?php

include_once ('MessagesDAO.php');
include_once ('APIResponse.php');

class MessagesService {

  private $messagesDAO;

  function __construct($messagesDAO) {
    $this->messagesDAO = $messagesDAO;
  }

  function updateOrInsertMessage($id, $message) {
    $isUpdated = $this->messagesDAO->updateMessage($id, $message);
    $status;
    if ($isUpdated) {
      echo "hi";
      $status = 204;
    } else {
      echo "no";
      $this->messagesDAO->insertMessage($id, $message);
      $status = 201;
    }
    return new APIResponse($status, "", "");
  }

  function getAllMessages() {
    $status;
    $resourceType;
    $data = $this->messagesDAO->getAllMessages();
    if ($data) {
        $status = 200;
        $resourceType = "collection";
    } else {
        $status = 404;
        $resourceType = "";
    }
    return new APIResponse($status, $resourceType, $data);
  }
  
  function getMessageById($id) {
    $status;
    $resourceType;
    $data = $this->messagesDAO->getMessageById($id);
    if ($data) {
        $status = 200;
        $resourceType = "item";
    } else {
        $status = 404;
        $resourceType = "";
    }
    return new APIResponse($status, $resourceType, $data);
  }
  
  function insertMessage($message) {
    $id = $this->messagesDAO->getMaxId();
    $id++;
    $isInserted = $this->messagesDAO->insertMessage($id, $message);
    $status;
    if ($isInserted) {
      $status = 201;
    } else {
      $status = 409;
    }
    return new APIResponse($status, "", $id);
  }
}
