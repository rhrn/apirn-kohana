<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_V1_Welcome extends Controller_V1_Api {

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
