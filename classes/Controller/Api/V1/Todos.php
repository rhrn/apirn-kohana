<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_V1_Todos extends Controller_Api_Api {

  private $todo;

  public function before() {
    parent::before();
    $this->todo = ORM::factory('V1_Todo');
  }

  public function GET() {

    $this->data['id'] = $this->request->param('id');

    $this->todo->data($this->data);

    if (empty($this->data['id'])) {
      $this->data = $this->todo->readAll();
    } else {
      $this->data = $this->todo->read();
    }
  }

  public function POST() {
    $this->todo->data($this->data);
    $this->data = $this->todo->insert();
  }

  public function PUT() {
    $this->todo->data($this->data);
    $this->data = $this->todo->write();
  }

  public function DELETE() {
    $this->todo->data(array(
      'id' => $this->request->param('id')
    ));
    $this->data = $this->todo->erase();
  }

  public function after() {
    parent::after();
  }

}
