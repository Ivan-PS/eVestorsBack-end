<?php
class Fruit {
  public $response;
  public $status;

  function __construct($response, $status) {
    $this->response = $response;
    $this->$status = $status;
  }

  function returnResponse(){
    $data = [];
    $data["response"] = $this->response;
    $data["status"] = $this->status;
    return $data;
  }

}