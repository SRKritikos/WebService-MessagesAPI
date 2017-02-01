<?php

include_once ('MessagesDAO.php');
include_once ('model/APIResponseFactory.php');

class MessagesService {

  private $messagesDAO;
  private $ApiResponseFactory;

  function __construct($messagesDAO, $ApiResponseFactory) {
    $this->messagesDAO = $messagesDAO;
    $this->ApiResponseFactory = $ApiResponseFactory;
  }

  function updateOrInsertMessage($id, $message) {
    $existingResourse = $this->messagesDAO->getMessageById($id);
    $status;
    if (is_null($existingResourse)) {
      $this->messagesDAO->insertMessage($id, $message);
      $status = "201";
    } else {
      $this->messagesDAO->updateMessage($id, $message);
      $status = "204";
    }
    return $this->ApiResponseFactory->create($status, "", "");
  }

  function getAllMessages() {
    $status;
    $resourceType;
    $data = $this->messagesDAO->getAllMessages();
    if ($data) {
      $status = "200";
      $resourceType = "collection";
    } else {
      $status = "404";
      $resourceType = "";
    }
    return $this->ApiResponseFactory->create($status, $resourceType, $data);
  }

  function getMessageById($id) {
    $status;
    $resourceType;
    $data = $this->messagesDAO->getMessageById($id);
    if ($data) {
      $status = "200";
      $resourceType = "item";
    } else {
      $status = "404";
      $resourceType = "";
    }
    return $this->ApiResponseFactory->create($status, $resourceType, $data);
  }

  function insertMessage($message) {
    $id = $this->messagesDAO->getMaxId();
    $id++;
    $isInserted = $this->messagesDAO->insertMessage($id, $message);
    $status;
    if ($isInserted) {
      $status = "201";
    } else {
      $status = "409";
    }
    return $this->ApiResponseFactory->create($status, "", $id);
  }

  function deleteMessage($id) {
    $status;
    $isDeleted = $this->messagesDAO->deleteMessageById($id);
    if ($isDeleted) {
      $status = 200;
    } else {
      $status = 404;
    }
    return $this->ApiResponseFactory->create($status, "", "");
  }

}