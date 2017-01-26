<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of APIResponse
 *
 * @author srostantkritikos06
 */
class APIResponse {

  public $status;
  public $resourceType;
  public $data;

  function __construct($status, $resourceType, $data) {
    $this->status = $status;
    $this->resourceType = $resourceType;
    $this->data = $data;
  }

  function getStatus() {
    return $this->status;
  }

  function setStatus($status) {
    $this->status = $status;
  }

  function getResourceType() {
    return $this->resourceType;
  }

  function setResourceType($resourceType) {
    $this->resourceType = $resourceType;
  }

  function getData() {
    return $this->data;
  }

  function setData($data) {
    $this->data = $data;
  }

}
