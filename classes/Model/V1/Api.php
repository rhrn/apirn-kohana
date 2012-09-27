<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Model_V1_Api extends ORM {

  public $data = array();

  public function data($data) {
    $this->data = $data;
    return $this;
  }

  public function first() {
    $this->find();
    return $this;
  }

  public function find_all_as_array($find_all = null) {

    if ($find_all === null) {
      $find_all = $this->find_all();
    }

    $data = array();
    foreach ($find_all as $find) {
      $data[] = $find->as_array();
    }
    return $data;
  }

  public function load($id) {
    $this->where($this->_object_name.'.'.$this->_primary_key, '=', $id)
      ->find();
    return $this;
  }

  public function readAll() {

  }

  public function read() {

  }

  public function insert() {

  }

  public function write() {

  }

  public function erase() {

  }

}
