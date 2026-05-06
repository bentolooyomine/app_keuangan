<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
    }

    // 🔐 Halaman login
    public function index()
    {
        // kalau sudah login, redirect
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // ambil setting desa
        $this->load->model('Setting_model');
        $data['setting'] = $this->Setting_model->get_setting();

        $this->load->view('login', $data);
    }

    // 🔑 Proses login
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->get_user($username);

        if ($user) {
            if (password_verify($password, $user->password)) {

                // set session
                $data_session = [
                    'user_id'   => $user->id,
                    'username'  => $user->username,
                    'nama'      => $user->nama,
                    'role_id'   => $user->role_id,
                    'logged_in' => TRUE
                ];

                $this->session->set_userdata($data_session);

                // update last login
                $this->Auth_model->update_last_login($user->id);

                redirect('dashboard');

            } else {
                $this->session->set_flashdata('auth_error', 'Password salah!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('auth_error', 'Username tidak ditemukan!');
            redirect('auth');
        }
    }

    // 🚪 Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    function pass() {
       echo password_hash('admin', PASSWORD_DEFAULT); 
    }
}