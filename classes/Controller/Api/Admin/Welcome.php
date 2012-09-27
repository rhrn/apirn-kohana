<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Admin_Welcome extends Controller_Api_Admin_Admin {

  public function before() {
    parent::before();
  }

  public function action_index() {
    $this->data = 'welcome';
  }

  public function GET() {

  }

  public function POST() {

  }

  public function PUT() {

  }

  public function DELETE() {

  }

  public function after() {
    parent::after();
  }

}
