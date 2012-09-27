<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_V1_UserToken extends Model_V1_Api {

  protected $_table_name = 'user_tokens';

  protected $_has_one = array();

  protected $_belongs_to = array(
    'user' => array(
      'model' => 'V1_User',
    )
  );

  protected $_has_many = array();
  protected $_load_with = array();
  protected $_validation = NULL;

  protected $_created_column = array('column' => 'created', 'format' => 'Y-m-d H:i:s');
  protected $_updated_column = array('column' => 'updated', 'format' => 'Y-m-d H:i:s');

  const SEPARATOR = '.';

  public function createToken() {

    $this->user_id = $this->_db_pending[0]['args'][2]; # dirty hack
    $this->token  = $this->genToken();
    $this->expire = 0;
    $this->ip = Request::$client_ip;
    $this->save();


    if ($this->saved()) {
      Cookie::set('tk', $this->token);
      return $this->token;
    }
  }

  public function getTokens() {
      return $this->find_all();
  }

  public function checkToken($token = null) {
    if (!empty($token)) {
      return $this
        ->where('token', '=', $token)
        ->find()
        ->user_id;
    }
  }

  public function getUser($token = null) {
    if (!empty($token)) {
      return $this
        ->with('user')
        ->where('token', '=', $token)
        ->find()->user;
    }
  }

  public function genToken() {
    $tail = base64_encode(hash('sha256', date('c').microtime()));
    return $this->user_id . self::SEPARATOR . $tail;
  }

  public function readAll() {
    return $this->find_all_as_array($this->find_all());
  }

  public function erase() {
    $this->where('id', '=', $this->data['id'])->find();
    if ($this->loaded()) {
      $this->delete();
    }
  }
}
