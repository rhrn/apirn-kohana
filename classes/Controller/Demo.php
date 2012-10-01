<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Demo extends Controller_Web {

  public $template = 'html/default';

  public function before() {

    parent::before();
  }

  public function action_index() {

    $this->template->scripts = array(
      array('src' => '/static/js/libs/bootstrap-backbone.js'),
      array('src' => '/static/js/demo/index.js')
    );

  }

  public function after() {

    parent::after();
  }

}
