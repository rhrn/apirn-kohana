<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @property $id int
 */
class Model_V1_User extends Model_V1_Api {

  protected $_table_name = 'users';

  protected $_has_one = array(
    'sender' => array(
      'model' => 'V1_Sender2',
      'foreign_key' => 'user_id'
    )
  );

  protected $_belongs_to = array();

  protected $_has_many = array(
    'tokens' => array(
      'model' => 'V1_UserToken',
      'foreign_key' => 'user_id'
    ),
    'resourceroles' => array(
      'model' => 'V1_UserResourceRole',
      'foreign_key' => 'user_id'
    ),
    'roles' => array(
      'model' => 'V1_UserRole',
      'foreign_key' => 'user_id'
    ),
    'resources' => array(
      'model'       => 'V1_Resource',
      'foreign_key' => 'user_id',
      'far_key'     => 'resource_id',
      'through'     => 'user_resources'
    )
  );

  protected $_load_with = array();
  protected $_validation = NULL;

  protected $_created_column = array('column' => 'created', 'format' => 'c');
  protected $_updated_column = array('column' => 'updated', 'format' => 'c');

  public $data = array();

  private $resource;

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

  public function readAll() {
    return $this->find_all_as_array($this->find_all());
  }

  public function valid_unique_email() {
    if(is_string($this->data)) {
      $this->data = array('email' => $this->data);
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

    if($this->id) {
      return $this->id;
    } else {
      return false;
    }

  }

  public function insert() {
    $user = $this->data;
    $user['password']       = self::password($user['password']);
    $user['activate_code']  = sha1(microtime().md5(rand(00000, 99999)));
    $this->values($user);
    $this->save();

    if ($this->saved()) {
      return $this;
    }
  }

  public function write() {
    $this->where('id', '=', $this->data['id']);
    $this->find();

    $this->data['active'] *= 1;

    $this->values($this->data);
    $this->update();

    if ($this->saved()) {
      return $this->as_array();
    }
  }

  public function auth() {
    return array(
      'name'            => $this->fullName(),
      'email'           => $this->email,
      'token'           => $this->tokens->createToken()
    );
  }

  public function fullName() {
    return explode('@', $this->email)[0];
  }

  public function firstResource($resources_type) {

    if ($this->loaded()) {

      $this->resource = $this->resources->find();

      if (empty($this->resource->id)) {

        $this->resource = $this->resources->generate($resources_type);
        $this->add('resources', $this->resource->id); 

      }
      return $this->resource;
    }
  }

  public function emailActivate() {

    if (!empty($this->data['id']) && !empty($this->data['activate_code'])) {

      $this->where('id', '=', $this->data['id']);
      $this->where('activate_code', '=', $this->data['activate_code']);
      $this->find();

      if ($this->loaded()) {

        if ($this->is_active_email == 0) {
          $this->is_active_email = 1;
          $this->save();
          Email_Notify::adminNewUser($this);
        }

        return array(
          'email' => $this->email,
          'is_active_email' => $this->is_active_email
        );
      }

    }

  }

  public static function password($password) {
    $auth = Kohana::$config->load('auth')->auth;
    return hash($auth['algo'], $password . $auth['salt']);
  }

  /**
   * Generate a random password
   *
   * @return string
   */
  public function generatePassword()
  {
    return substr(md5(uniqid()), 0, 7);
  }

  /**
   * Invite a user to store management
   *
   * @param $resource_id
   * @return bool
   */
  public function invite($resource_id)
  {
    $userResource = ORM::factory('V1_UserResource')
      ->where('user_id', '=', $this->id)->where('resource_id', '=', $resource_id)->find();

    if ($userResource->id)
      return false;

    $userResource->user_id = $this->id;
    $userResource->resource_id = $resource_id;
    $userResource->is_invited = 1;
    $userResource->insert();

    Email_Notify::userInvite($this);

    return true;
  }

}
