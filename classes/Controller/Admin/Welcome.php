<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Welcome extends Controller_Admin_Admin {

	public $template = 'html/admin';

	public function action_index() {

		$this->title = 'Admin';

	}

}