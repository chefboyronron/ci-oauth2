<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Oauth');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login()
	{
		$oauth = new Oauth;
		$request = new OAuth2\Request;
		$response = $oauth->server->handleTokenRequest($request::createFromGlobals());
		$code = $response->getStatusCode();
		$body = $response->getResponseBody();
		var_dump(
			json_decode($body),
			$code
		);
	}

	public function validate_token()
	{
		$oauth = new Oauth;

		if (!$oauth->server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
			$oauth->server->getResponse()->send();
			die;
		}
		echo json_encode(array('success' => true, 'message' => 'You accessed my APIs!'));
	}
}
