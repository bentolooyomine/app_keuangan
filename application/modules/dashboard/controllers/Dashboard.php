<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');
       if (!$this->session->userdata('logged_in')) {
    redirect('auth');
}
    }

    public function index()
    {

     $role_id = $this->session->userdata('role_id');

    $menu = $this->M_dashboard->get_menu($role_id);

    foreach ($menu as $m) {
        $m->submenu = $this->M_dashboard->get_submenu($m->id);
    }


        $data = array(
            'title' => 'Dashboard Desa Pintar',
            'nama_app' => 'App Keuangan',
            'user'  => $this->session->userdata('username'),
             'menu'  => $menu,
             'versi' => '0.0.1'
        );

        // Load template
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }

    function cek_db()  {
        $data = $this->M_dashboard->cek()->result();
        print_r($data);
    }
}