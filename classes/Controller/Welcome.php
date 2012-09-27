<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Web {

  public $template = 'html/welcome';

  public function before() {

    parent::before();
  }

  public function action_index() {

    $this->template->styles = array(
      array('src' => '/static/css/apps/welcome.css')
    );

    $this->template->scripts = array(
      array('src' => '/static/js/apps/welcome.js')
    );

  }

  public function after() {

    parent::after();
  }

}
