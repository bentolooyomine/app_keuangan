<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {
	public function index()
	{
		$this->load->view('template');
	}
}
