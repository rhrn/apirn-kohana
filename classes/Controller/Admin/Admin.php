<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Admin_Admin extends Controller_Web {
  public $template = 'html/default';
  public $user;
  public $access = false;

  public function before() {
    parent::before();

    $this->user = $this->user();

    if (! empty($this->user)) {
      if ($this->user->roles->role(Roles::ADMIN)->canDo()) {
        $this->access = true;
      }
    }

    if ($this->access !== true) {
      HTTP::redirect( Route::get('default')->uri( array('action' => 'user') ) );
    }
  }

  public function after() {
    parent::after();
  }

  public function render() {
    $this->template->title  = (string) $this->title;

    if ($this->view !== false) {
      if ($this->view === '') {
        $this->view = $this->request->directory() . DIRECTORY_SEPARATOR . $this->request->controller() . DIRECTORY_SEPARATOR . $this->request->action();
      }

      $this->view = View::factory($this->view, $this->data)->render();
    }

    $this->template->view = (string) $this->view;
  }

  protected function action_templates() {
    $this->auto_render = false;
    echo View::factory($this->request->directory() . DIRECTORY_SEPARATOR . $this->request->controller()  . DIRECTORY_SEPARATOR . $this->request->action())->render();
  }

  private function user() {
    return ORM::factory('V1_UserToken')->getUser(Cookie::get('tk'));
  }
}
