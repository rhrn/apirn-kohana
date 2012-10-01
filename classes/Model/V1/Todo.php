<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_V1_Todo extends Model_V1_Api {

  protected $_table_name = 'todos';

  protected $_has_one = array();
  protected $_belongs_to = array();
  protected $_has_many = array();
  protected $_load_with = array();
  protected $_validation = NULL;

  protected $_created_column = array('column' => 'created', 'format' => 'Y-m-d H:i:s');
  protected $_updated_column = array('column' => 'updated', 'format' => 'Y-m-d H:i:s');


  public function readAll() {
    return $this->find_all_as_array($this->find_all());
  }

  public function read() {

    $this->where('id', '=', $this->data['id']);
    $this->find();

    return $this->as_array();
  }

  public function insert() {

    $this->values($this->data);
    $this->save();

    if ($this->saved()) {
      return $this->as_array();
    }

  }
  
  public function write() {

    $this->where('id', '=', $this->data['id']);
    $this->find();

    $this->values($this->data);
    $this->update();

    if ($this->saved()) {
      return $this->as_array();
    }

  }

  public function erase() {

    $this->where('id', '=', $this->data['id']);
    $this->find();

    $this->delete();
  }


}
