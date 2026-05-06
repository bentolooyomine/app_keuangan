<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    // ambil user berdasarkan username
    public function get_user($username)
    {
        return $this->db->get_where('users', [
            'username' => $username,
            'is_active' => 1
        ])->row();
    }

    // update last login
    public function update_last_login($id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', [
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }
}