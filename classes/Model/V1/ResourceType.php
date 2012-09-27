<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_V1_ResourceType extends Model_V1_Api {

  protected $_table_name = 'resource_type';

  protected $_has_one = array(
  );

  protected $_belongs_to = array(
  );

  protected $_has_many = array(
  );

  protected $_load_with = array();
  protected $_validation = NULL;

  public $rules = array(
  );

  public function read() {
  }

  public function upsert() {
  }

  public function write() {
  }

  public function erase() {
    return $this->delete();
  }

  public function valid_add() {
  }

}
