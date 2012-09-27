<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Admin_Usertokens extends Controller_Api_Admin_Admin {

  private $tokens;

  public function before() {
    parent::before();
    $this->user_id = (int) $this->request->query('user_id');
    $this->tokens = ORM::factory('V1_UserToken');
  }

  public function GET() {
    $this->tokens->data($this->data);
    $this->data = $this->tokens->readAll();
  }

  public function POST() {
    $this->tokens->data($this->data);
    $this->data = $this->tokens->insert();
  }

  public function PUT() {
    $this->tokens->data($this->data);
    $this->data = $this->tokens->write();
  }

  public function DELETE() {
    $this->data['id'] = $this->request->param('id');
    $this->tokens->data($this->data);
    $this->data = $this->tokens->erase();
  }

  public function after() {
    parent::after();
  }
}
