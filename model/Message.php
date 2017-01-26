<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Message {
  public $id;
  public $message;
  
  function __construct($id, $message) {
    $this->id = $id;
    $this->message = $message;
  }
  
  function getId() {
    return $this->id;
  }
  
  function setId($id) {
    $this->id = $id;
  }
  
  function getMessage() {
    return $this->$message;
  }
  
  function setMessage($message) {
    $this->message = $message;
  }
}