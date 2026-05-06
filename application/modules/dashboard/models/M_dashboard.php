<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {


  
    public function __construct()
    {
        parent::__construct();
           $this->db_simrs = $this->load->database('simrs', TRUE);
}

    
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

    function cek()  {
        return $this->db_simrs->query('SELECT * FROM users');
    }
}