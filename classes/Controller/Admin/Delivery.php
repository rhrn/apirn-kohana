<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Delivery extends Controller_Admin_Admin {

  public $template = 'html/admin';

  public function before() {
    parent::before();
  }

	public function action_index() {

    $this->title = 'Admin Delivery';

	}

	public function after() {
		parent::after();
	}

}
