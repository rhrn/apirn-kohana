<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Api_Admin_Admin extends Controller_Api_Api {

  public $user;

  private $access = false;

  public function before() {

    parent::before();

    $this->user = $this->user();

    if (!empty($this->user)) {
      if ($this->user->roles->role(Roles::ADMIN)->canDo()) {
        $this->access = true;
      }
    }

    if ($this->access !== true) {
      $this->data['access'] = 'fail';
      parent::after();
      exit();
    }

  }

  public function after() {
    parent::after();
  }

  private function user() {
    return ORM::factory('V1_UserToken')->getUser(Cookie::get('tk'));
  }

}
