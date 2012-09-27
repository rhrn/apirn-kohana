<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Web extends Controller_Template {

  public $template = 'html/default';
  public $view = '';
  public $title = '';
  public $data = array();
  public $user;

  public function before() {

    parent::before();
    $this->user = $this->user();
  }

  private function user() {
    return ORM::factory('V1_UserToken')->getUser(Cookie::get('tk'));
  }

  public function render() {

    $this->template->title = (string) $this->title;

    if ($this->view !== false) {

      if ($this->view === '') {
        $this->view = $this->request->controller() . DIRECTORY_SEPARATOR . $this->request->action();
      }

      $this->view = View::factory($this->view, $this->data)->render();
    }

    $this->template->view = (string) $this->view;
  }

  public function after() {

    $this->render();
    parent::after();
  }

}
