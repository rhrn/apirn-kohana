<?php defined('SYSPATH') or die('No direct script access.');

/*
  Admin panel: Location Editor (Frontend Controller)
	AK, 05-Jul-2012
*/

class Controller_Admin_Locations extends Controller_Admin_Admin {

	//public $template = 'html/default';

	public function before() {
		parent::before();
	}

	public function action_index() {
		$this->title = 'Location Editor';

    $this->template->styles = array();

    $this->template->scripts = array(
      array('src' => '/static/js/admin/locations.js')
    );
	}

	public function action_delivery() {

	}

	public function after() {
		parent::after();
	}
}