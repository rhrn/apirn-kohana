<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_V1_UserResource extends Model_V1_Api {

  protected $_table_name = 'user_resources';
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

  public function erase() {

    return $this->delete();
  }
}
