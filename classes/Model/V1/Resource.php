<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_V1_Resource extends Model_V1_Api {

  protected $_table_name = 'resources';

  protected $_has_one = array(
  );

  protected $_belongs_to = array(
    'resourcetype' => array(
      'model' => 'V1_ResourceType',
      'foreign_key' => 'type_id'
    ),
  );

  protected $_has_many = array(
  );

  protected $_load_with = array();
  protected $_validation = NULL;

  public $rules = array(

  );

  public function valid_add() {

  }

  public function read() {

  }

  public function insert() {

    $this->values($this->data);
    $this->create();

    if ($this->saved()) {
      return $this;
    }

  }

  public function generate($type_id) {
    
    $this->data = array(
      'type_id'=> $type_id,
      'key' => hash('sha1', md5(rand(00000, 99999) . microtime(true) . date("Y-m-d H:i:s")))
    );

    return $this->insert();
  }

  public function upsert() {
  }

  public function write() {
  }

  public function erase() {
  }

}
