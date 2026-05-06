<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->library('form_validation');
       if (!$this->session->userdata('logged_in')) {
    redirect('auth');
}
    }

   public function index()
{
    $role_id = $this->session->userdata('role_id');

    $menu = $this->M_user->get_menu($role_id);
    foreach ($menu as $m) {
        $m->submenu = $this->M_user->get_submenu($m->id);
    }

    // 🔥 ambil data users
    $users = $this->M_user->get_users();

    $data = array(
        'title' => 'Modul User',
        'nama_desa' => 'Desa Kalangan',
        'user'  => $this->session->userdata('username'),
        'menu'  => $menu,
        'versi' => '0.0.1',
        'users' => $users // ✅ kirim ke view
    );

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar', $data);
    $this->load->view('index', $data);
    $this->load->view('template/footer');
}


public function add()
{
    $role_id = $this->session->userdata('role_id');

    $menu = $this->M_user->get_menu($role_id);
    foreach ($menu as $m) {
        $m->submenu = $this->M_user->get_submenu($m->id);
    }

    // ambil role untuk dropdown
    $roles = $this->M_user->get_roles();

    $data = [
        'title' => 'Tambah User',
        'nama_desa' => 'Desa Kalangan',
        'user'  => $this->session->userdata('username'),
        'menu'  => $menu,
        'versi' => '0.0.1',
        'roles' => $roles
    ];

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar', $data);
    $this->load->view('user/add', $data);
    $this->load->view('template/footer');
}

public function store()
{
    // 🔥 RULE VALIDASI
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    
    $this->form_validation->set_rules(
        'username',
        'Username',
        'required|is_unique[users.username]',
        [
            'is_unique' => 'Username sudah digunakan!'
        ]
    );

    $this->form_validation->set_rules(
        'email',
        'Email',
        'required|valid_email|is_unique[users.email]',
        [
            'valid_email' => 'Format email tidak valid!',
            'is_unique'   => 'Email sudah digunakan!'
        ]
    );

    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

    // ❌ kalau gagal
    if ($this->form_validation->run() == FALSE) {

        // balik ke form + error
        $this->add();
        return;
    }

    // ✅ kalau lolos
    $data = [
        'nama'       => $this->input->post('nama'),
        'username'   => $this->input->post('username'),
        'email'      => $this->input->post('email'),
        'no_hp'      => $this->input->post('no_hp'),
        'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'role_id'    => $this->input->post('role_id'),
        'is_active'  => $this->input->post('is_active'),
        'created_at' => date('Y-m-d H:i:s')
    ];

    $this->M_user->insert($data);

    $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
    redirect('user');
}

public function edit($id)
{
    $role_id = $this->session->userdata('role_id');

    $menu = $this->M_user->get_menu($role_id);
    foreach ($menu as $m) {
        $m->submenu = $this->M_user->get_submenu($m->id);
    }

    $data = [
        'title' => 'Edit User',
        'user'  => $this->session->userdata('username'),
        'menu'  => $menu,
        'data_user' => $this->M_user->get_by_id($id),
        'roles' => $this->M_user->get_roles(),
        'nama_desa' => 'Desa Kalangan',
        'versi' => '0.0.1',
        
        ];

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar', $data);
    $this->load->view('edit', $data);
    $this->load->view('template/footer');
}

public function update()
{
    $this->load->library('form_validation');

    $id = $this->input->post('id');

    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if ($this->form_validation->run() == FALSE) {
        $this->edit($id);
    } else {

        $data = [
            'nama'      => $this->input->post('nama'),
            'username'  => $this->input->post('username'),
            'email'     => $this->input->post('email'),
            'no_hp'     => $this->input->post('no_hp'),
            'role_id'   => $this->input->post('role_id'),
            'is_active' => $this->input->post('is_active'),
            'updated_at'=> date('Y-m-d H:i:s')
        ];

        // 🔐 kalau password diisi baru update
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->M_user->update($id, $data);

        $this->session->set_flashdata('user_success', 'User berhasil diupdate!');
        redirect('user');
    }
}

public function delete($id)
{
    $login_id = $this->session->userdata('user_id');

    // 🚫 proteksi hapus diri sendiri
    if ($id == $login_id) {
        $this->session->set_flashdata('user_error', 'Tidak bisa menghapus akun sendiri!');
        redirect('user');
    }

    // cek data ada
    $user = $this->M_user->get_by_id($id);
    if (!$user) {
        $this->session->set_flashdata('user_error', 'User tidak ditemukan!');
        redirect('user');
    }

    // proses hapus
    $this->M_user->delete($id);

    $this->session->set_flashdata('user_success', 'User berhasil dihapus!');
    redirect('user');
}


}