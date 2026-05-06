<?php
class Setting_model extends CI_Model {

    public function get_setting()
    {
        return $this->db->get('settings')->row();
    }
}