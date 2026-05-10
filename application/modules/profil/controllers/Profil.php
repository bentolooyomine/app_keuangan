<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_profil');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $role_id = $this->session->userdata('role_id');

        // MENU + SUBMENU
        $menu = $this->M_profil->get_menu($role_id);

        foreach ($menu as $m) {
            $m->submenu = $this->M_profil->get_submenu($m->id, $role_id);
        }

        // =========================
        // FILTER TANGGAL (DEFAULT)
        // =========================
     

        // =========================
        // DATA CHART TTBayar
        // =========================
      
        // =========================
        // DATA KE VIEW
        // =========================
        $data = array(
            'title'      => 'Dashboard RSPA',
            'nama_app'   => 'App Keuangan',
            'user'       => $this->session->userdata('username'),
            'menu'       => $menu,
            'versi'      => '0.0.1',
            'setting'   => $this->M_profil->get_setting(),

            
           
        );

        // TEMPLATE
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }

    function cek_db()
    {
        $data = $this->M_profil->cek()->result();
        print_r($data);
    }

      public function simpan()
    {
        $this->M_profil->simpan();

        $this->session->set_flashdata(
            'success',
            'Profil berhasil diperbarui'
        );

        redirect('profil');
    }
}