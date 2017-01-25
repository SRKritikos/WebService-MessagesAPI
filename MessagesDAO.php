<?php

class MessagesDAO {

  private $connection;

  function __construct($connection) {
    $this->connection = $connection;
  }

  function getMessageById($id) {
    $message;
    $stmt = $this->connection->prepare("SELECT messageData FROM messages WHERE messageId=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($message);
    $stmt->fetch();
    $stmt->close();
    return json_encode($message);
  }

  function getAllMessages() {
    $messages = array();
    $result = $this->connection->query("SELECT messageData FROM messages");
    while ($row = $result->fetch_assoc()) {
      $messages[] = $row["messageData"];
    }
    return json_encode($messages);
  }

  function getMessagesByIdRange($from, $to) {
    $messages = array();
    $stmt = $this->connection->prepare("SELECT messageData FROM messages WHERE messageId BETWEEN ? AND ?");
    $stmt->bind_param("ss", $from, $to);
    $stmt->execute();
    $stmt->bind_result($result);
    while ($stmt->fetch()) {
      $messages[] = $result;
    }
    $stmt->close();
    return json_encode($messages);
  }

  function updateMessage($id, $message) {
    $stmt = $this->connection->prepare("UPDATE messages SET messageData=? WHERE messageId=?");
    $stmt->bind_param("ss", $message, $id);
    $stmt->execute();
    $totalAffected = $stmt->affected_rows;
    $stmt->close();
    return $totalAffected > -1;
  }

  function insertMessage($id, $message) {
    $stmt = $this->connection->prepare("INSERT INTO messages (messageId, messageData) VALUES (?, ?)");
    $stmt->bind_param("ss", $id, $message);
    $stmt->execute();
    $totalAffected = $stmt->affected_rows;
    $stmt->close();
    return $totalAffected > 0;
  }

  function getMaxId() {
    $result = $this->connection->query("SELECT MAX(messageId) as 'maxid' FROM messages");
    $row = $result->fetch_assoc();
    return $row["maxid"];
  }
}
