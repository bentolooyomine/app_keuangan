<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    
    public function get_menu($role_id)
    {
        $this->db->select('m.*');
        $this->db->from('menus m');
        $this->db->join('role_menu rm', 'rm.menu_id = m.id');
        $this->db->where('rm.role_id', $role_id);
        $this->db->where('m.is_active', 1);
        $this->db->order_by('m.urutan', 'ASC');

        return $this->db->get()->result();
    }

    public function get_submenu($menu_id)
    {
        $this->db->where('menu_id', $menu_id);
        $this->db->where('is_active', 1);
        return $this->db->get('sub_menu')->result();
    }


    public function get_users()
{
    return $this->db->get('users')->result();
}

public function get_roles()
{
    return $this->db->get('roles')->result();
}

public function insert($data)
{
    return $this->db->insert('users', $data);
}

public function get_by_id($id)
{
    return $this->db->get_where('users', ['id' => $id])->row();
}

public function update($id, $data)
{
    $this->db->where('id', $id);
    $this->db->update('users', $data);
}

public function delete($id)
{
    $this->db->where('id', $id);
    $this->db->delete('users');
}


}