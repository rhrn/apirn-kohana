<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Pickuppoints extends Controller_Admin_Admin {

  public $template = 'html/admin';

  public function before() {
    parent::before();
  }

	public function action_index() {

    $this->title = 'Admin Pickuppoints';

    $this->template->styles = array(
      array('href' => '/static/css/jquery.autocomplete.css')
    );
    
	}

	public function after() {
		parent::after();
	}

}

