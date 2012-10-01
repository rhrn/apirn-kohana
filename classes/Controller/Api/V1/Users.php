<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_V1_Users extends Controller_Api_Api {

  public function before() {
    parent::before();
  }

  public function GET() {

  }

  public function POST() {

  }

  public function PUT() {

  }

  public function DELETE() {

  }

  public function action_auth() {
    
    $token    = $this->request->query('token');
    $user = ORM::factory('V1_UserToken')->getUser($token);

    $this->data['enabled'] = 0;
    if ($user->id) {
      $this->data['enabled'] = 1;
      $this->data['is_active_email'] = $user->is_active_email;
    }

  }

  public function action_join() {

    $user = ORM::factory('V1_User');

    $user->data = $this->data;

    $valid = $user->valid_unique_email();

    $is_new = 0;
    if ($valid->check()) {
      $is_new = 1;
      $valid = $user->valid_add();
    } else {
      $valid = $user->valid_auth();
    }

    $this->data['action'] = '(function() {}())';

    if ($valid->check()) {

      if ($is_new) {

        $password = $this->data['password'];

        $user->insert();

        $this->data['is_new'] = 1;
      }

      $this->data['auth'] = $user->auth();

    } else {
      $this->data['errors'] = $valid->errors('join');
    }

  }

  public function after() {
    parent::after();
  }

}
