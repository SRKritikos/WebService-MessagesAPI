<?php

class MessagesDAO {

  private $connection;

  function __construct($connection) {
    $this->connection = $connection;
  }

  function getMessageById($id) {
    $result;
    $stmt = $this->connection->prepare("SELECT messageData FROM messages WHERE messageId=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();
    return json_encode($result);
  }

  function getAllMessages() {
    $rows = array();
    $result = $this->connection->query("SELECT messageData FROM messages");
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row["messageData"];
    }
    return json_encode($rows);
  }

  function getMessagesByIdRange($from, $to) {
    $rows = array();
    $stmt = $this->connection->prepare("SELECT messageData FROM messages WHERE messageId BETWEEN ? AND ?");
    $stmt->bind_param("ss", $from, $to);
    $stmt->execute();
    $stmt->bind_result($result);
    while ($stmt->fetch()) {
      $rows[] = $result;
    }
    $stmt->close();
    return json_encode($rows);
  }

  function updateMessage($id, $message) {
    $stmt = $this->connection->prepare("UPDATE messages SET messageData=? WHERE messageId=?");
    $stmt->bind_param("ss", $message, $id);
    $stmt->execute();
    $success = $stmt->affected_rows;
    $stmt->close();
    return $success > 0;
  }

  function insertMessage($id, $message) {
    $stmt = $this->connection->prepare("INSERT INTO messages (messageId, messageData) VALUES (?, ?)");
    $stmt->bind_param("ss", $id, $message);
    $stmt->execute();
    $sucess = $stmt->affected_rows;
    $stmt->close();
    return $sucess > 0;
  }

}
