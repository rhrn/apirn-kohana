<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_V1_Users extends Model_V1_Api {

  protected $_table_name = 'users';

  protected $_has_one = array(
  );

  protected $_belongs_to = array();

  protected $_has_many = array(
    'tokens' => array(
      'model' => 'V1_UserToken',
      'foreign_key' => 'user_id'
    ),
    'roles' => array(
      'model' => 'V1_UserRole',
      'foreign_key' => 'user_id'
    ),
    'resources' => array(
      'model' => 'V1_Resource',
      'foreign_key' => 'user_id',
      'far_key' => 'resource_id',
      'through' => 'user_resources'
    )
  );

  protected $_load_with = array();
  protected $_validation = NULL;

  protected $_created_column = array('column' => 'created', 'format' => 'Y-m-d H:i:s');
  protected $_updated_column = array('column' => 'updated', 'format' => 'Y-m-d H:i:s');

  public $data = array();

  public function readAll() {
    return $this->find_all_as_array($this->find_all());
  }

  public $rules = array(
    'email' => array(
      array('not_empty'),
      array('email'),
    ),
    'username' => array(
      array('not_empty'),
      array('min_length', array(':value', 4)),
      array('max_length', array(':value', 15)),
      array('regex', array(':value', '/[a-z0-9]+/'))
    ),
    'password' => array(
      array('not_empty'),
      array('min_length', array(':value', 6)),
      array('max_length', array(':value', 127))
    ),
    'password_confirm' => array(
      array('matches', array(':validation', ':field', 'password'))
    )
  );

  public function valid_unique_email() {

    if (is_string($this->data)) {
      $this->data = array('email' => $data);
    }

    return Validation::factory($this->data)
      ->rule('email', array($this, 'is_unique_email'), array(':value'));
  }

  public function valid_add() {

    return Validation::factory($this->data)
      ->rules('email', $this->rules['email'])
      ->rules('password', $this->rules['password'])
      ->rule('email', array($this, 'is_unique_email'), array(':value'));
  }

  public function valid_auth() {

    return Validation::factory($this->data)
      ->rules('email', $this->rules['email'])
      ->rules('password', $this->rules['password'])
      ->rule('password', array($this, 'is_auth_data'), $this->data);
  }

  public function is_unique_email($email) {

    return !$this->where('email', '=', $email)->count_all();
  }

  public function is_auth_data($email, $password) {

    $this
      ->where('email', '=', $email)
      ->where('password', '=', self::password($password))
      ->find();

    if ($this->id) {
      return $this->id;
    }

    return false;
  }

  public function insert() {

    $user = $this->data;
    $user['password'] = self::password($user['password']);
    $this->values($user);
    $this->save();

    if ($this->saved()) {
      return $this;
    }

    return false;
  }

  public function write() {

    $this->where('id', '=', $this->data['id']);
    $this->find();

    $this->values($this->data);
    $this->update();

    if ($this->saved()) {
      return $this->as_array();
    }

    return false;
  }

  public function auth() {

    return array(
      'name' => $this->email,
      'email' => $this->email,
      'token' => $this->tokens->createToken()
    );
  }

  public static function password($password) {

    $auth = Kohana::$config->load('auth')->auth;
    return hash($auth['algo'], $password . $auth['salt']);
  }

  public function fullName() {

    return explode('@', $this->email)[0];
  }

}
