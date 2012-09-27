<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Admin_Users extends Controller_Api_Admin_Admin {

  private $users;

  public function before() {
    parent::before();
    $this->users = ORM::factory('V1_User');
  }

  public function GET() {
    $this->data = $this->users->readAll();
  }

  public function POST() {
    $this->users->data($this->data);
    $this->data = $this->users->insert();
  }

  public function PUT() {
    $this->users->data($this->data);
    $this->data = $this->users->write();
  }

  public function DELETE() {
    $this->users->data($this->data);
    $this->data = $this->users->erase();
  }

  public function after() {
    parent::after();
  }
}
