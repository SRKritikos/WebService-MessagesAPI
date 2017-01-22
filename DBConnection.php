<?php

class DBConnection {

  private $connection;

  function __construct($server, $username, $password, $database) {
    $this->connection = new mysqli($server, $username, $password, $database);
    if ($this->connection->errno) {
      $message = "Failed to connect to database";
      throw new Exception($message);
    }
  }

  function getConnection() {
    return $this->connection;
  }

}
