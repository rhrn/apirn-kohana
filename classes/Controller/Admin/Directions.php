<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Directions extends Controller_Admin_Admin {

  public $template = 'html/default';

  public function before() {
    parent::before();
  }

	public function action_index() {

	}

	public function after() {

		$this->template->scripts = array(
			array('src' => '/static/js/users.js')
		);
		parent::after();
	}
}

