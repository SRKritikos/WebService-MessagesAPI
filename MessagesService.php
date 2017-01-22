<?php

include_once ('MessagesDAO.php');

class MessagesService {

  private $messagesDAO;

  function __construct($messagesDAO) {
    $this->messagesDAO = $messagesDAO;
  }

  function updateOrInsertMessage($id, $message) {
    $isUpdated = $this->messagesDAO->updateMessage($id, $message);
    if ($isUpdated) {
      return 200;
    } else {
      $this->messagesDAO->insertMessage($id, $message);
      return 201;
    }
  }

  function getAllMessages() {
    return $this->messagesDAO->getAllMessages();
  }
  
  function getMessageById($id) {
    return $this->messagesDAO->getMessageById($id);
  }
}
