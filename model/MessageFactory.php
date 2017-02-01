<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('model/Message.php');
/**
 * Description of MessageFactory
 *
 * @author srostantkritikos06
 */
class MessageFactory {
  function create($id, $message) {
    return new Message($id, $message);
  }
}
