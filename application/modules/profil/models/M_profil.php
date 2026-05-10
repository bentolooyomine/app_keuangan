<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profil  extends CI_Model {


  
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

public function get_submenu($menu_id, $role_id)
{
    $this->db->select('sm.*');
    $this->db->from('sub_menu sm');
    $this->db->join('role_sub_menu rsm', 'rsm.sub_menu_id = sm.id');
    $this->db->where('sm.menu_id', $menu_id);
    $this->db->where('rsm.role_id', $role_id);
    $this->db->where('sm.is_active', 1);

    return $this->db->get()->result();
}
    function cek()  {
        return $this->db_simrs->query('SELECT * FROM users');
    }
 public function get_ttbayar($awal, $akhir)
{
    return $this->db_simrs->query("
        SELECT 
            CAST(Tanggal AS DATE) AS tgl,
            COUNT(*) AS jumlah_transaksi,
            SUM(Bayar) AS total_bayar
        FROM TTBayar
        WHERE CAST(Tanggal AS DATE) BETWEEN '$awal' AND '$akhir'
        GROUP BY CAST(Tanggal AS DATE)
        ORDER BY tgl ASC
    ")->result();
}

  

public function get_datatables_batal($tanggal, $start, $length)
{
    $this->db->select('*');
    $this->db->from('TTBayar');

    // FILTER UTAMA
    $this->db->where('StBPD', 1);
    $this->db->where('StBayarBPD', 0);

    // FILTER TANGGAL
    $this->db->where('CAST(Tanggal as date)', $tanggal);

    // SEARCH DATATABLE
    if (!empty($_POST['search']['value'])) {

        $search = $_POST['search']['value'];

        $this->db->group_start();
        $this->db->like('NoKwitansi', $search);
        $this->db->or_like('Petugas', $search);
        $this->db->group_end();
    }

    // ORDER
    $this->db->order_by('Tanggal', 'DESC');

    // LIMIT
    if ($length != -1) {
        $this->db->limit($length, $start);
    }

    return $this->db->get()->result();
}

public function count_filtered_batal($tanggal)
{
    $this->db->from('TTBayar');

    $this->db->where('StBPD', 1);
    $this->db->where('StBayarBPD', 0);

    $this->db->where('CAST(Tanggal as date)', $tanggal);

    if (!empty($_POST['search']['value'])) {

        $search = $_POST['search']['value'];

        $this->db->group_start();
        $this->db->like('NoKwitansi', $search);
        $this->db->or_like('Petugas', $search);
        $this->db->group_end();
    }

    return $this->db->count_all_results();
}


 public function get_setting()
    {
        return $this->db
            ->get('settings')
            ->row();
    }

    public function simpan()
    {
        $id = $this->input->post('id');

        $data = [

            'nama_app'     => $this->input->post('nama_app'),
            'kecamatan'    => $this->input->post('kecamatan'),
            'kabupaten'    => $this->input->post('kabupaten'),
            'provinsi'     => $this->input->post('provinsi'),
            'alamat'       => $this->input->post('alamat'),
            'kode_pos'     => $this->input->post('kode_pos'),
            'telepon'      => $this->input->post('telepon'),
            'email'        => $this->input->post('email'),
            'website'      => $this->input->post('website'),
            'nama_kepala'  => $this->input->post('nama_kepala'),
            'nip_kepala'   => $this->input->post('nip_kepala'),
            'updated_at'   => date('Y-m-d H:i:s')

        ];

        // UPLOAD LOGO
        if(!empty($_FILES['logo']['name'])){

            $config['upload_path']   = './uploads/logo/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('logo')){

                $upload = $this->upload->data();

                $data['logo'] = $upload['file_name'];
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('settings', $data);
    }


}