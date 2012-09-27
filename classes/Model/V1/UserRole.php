<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_V1_UserRole extends Model_V1_Api {

  protected $_table_name = 'user_roles';

  protected $_has_one = array(
  );

  protected $_belongs_to = array(
    'user' => array(
      'model' => 'V1_User'
    ),
    'role' => array(
      'model' => 'V1_Role'
    )
  );

  protected $_has_many = array();
  protected $_load_with = array();
  protected $_validation = NULL;

  protected $_created_column = array('column' => 'created', 'format' => 'Y-m-d H:i:s');
  protected $_updated_column = array('column' => 'updated', 'format' => 'Y-m-d H:i:s');


  public function role($role_id = null) {
    if ($role_id) {
      $this
        ->where('role_id', '=', $role_id)
        ->find();
    }
    return $this;
  }

  public function canDo() {
    if (!empty($this->id)) {
      return true;
    }
    return false;
  }

}
