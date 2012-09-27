<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Api extends Controller_Api {

  public $assoc = true;

  public $debug = false;

  public $data = array();
  public $body = array();
  public $user = array();

  public function before() {

    parent::before();

    $tk = $this->request->query('tk');

    if (!empty($tk)) {
      $this->user = ORM::factory('V1_UserToken')->getUser($tk);
    }

    $this->data = json_decode($this->request->body(), $this->assoc);
  }

  public function action_rest() {
    $this->{$this->request->method()}();
  }

  public function errors() {
    if (isset($this->data['errors'])) {
      $this->data['error'] = 1;
      $this->response->status(303);
    }
  }

  public function response() {
    echo json_encode($this->data);
  }

  public function after() {

    if ($this->debug) {
      $this->data['debug']['method']    = $this->request->method();
      $this->data['debug']['param']     = $this->request->param();
      $this->data['debug']['post']      = $this->request->post();
      $this->data['debug']['get']       = $this->request->query();
      $this->data['debug']['body']      = $this->request->body();
      $this->data['debug']['headers']   = $this->request->headers();
    }

    $this->errors();

    echo $this->response();

    parent::after();
  }

}
