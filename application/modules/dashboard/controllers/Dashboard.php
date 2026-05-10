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

        // MENU + SUBMENU
        $menu = $this->M_dashboard->get_menu($role_id);

        foreach ($menu as $m) {
            $m->submenu = $this->M_dashboard->get_submenu($m->id, $role_id);
        }

        // =========================
        // FILTER TANGGAL (DEFAULT)
        // =========================
        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');

        if (!$tgl_awal)  $tgl_awal = date('Y-m-01');
        if (!$tgl_akhir) $tgl_akhir = date('Y-m-d');

        // =========================
        // DATA CHART TTBayar
        // =========================
        $chart_ttbayar = $this->M_dashboard->get_ttbayar($tgl_awal, $tgl_akhir);

        // =========================
        // DATA KE VIEW
        // =========================
        $data = array(
            'title'      => 'Dashboard RSPA',
            'nama_app'   => 'App Keuangan',
            'user'       => $this->session->userdata('username'),
            'menu'       => $menu,
            'versi'      => '0.0.1',

            // tambahan dashboard
            'tgl_awal'   => $tgl_awal,
            'tgl_akhir'  => $tgl_akhir,
            'chart_ttbayar' => $chart_ttbayar
        );

        // TEMPLATE
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }

    function cek_db()
    {
        $data = $this->M_dashboard->cek()->result();
        print_r($data);
    }

    public function ajax_list_batal()
{
    $tanggal = $this->input->post('tanggal');

    if (!$tanggal) {
        $tanggal = date('Y-m-d');
    }

    $start  = $this->input->post('start');
    $length = $this->input->post('length');
    $draw   = $this->input->post('draw');

    $list = $this->M_kwitansi->get_datatables_batal(
        $tanggal,
        $start,
        $length
    );

    $data = [];
    $no = $start;

    foreach ($list as $row) {

        $no++;

        $data[] = [
            $no,
            $row->NoKwitansi,
            date('d-m-Y H:i', strtotime($row->Tanggal)),
            number_format($row->Bayar, 0, ',', '.'),
            $row->Petugas,

            '
            <button class="btn btn-sm btn-info" onclick="detail(\''.$row->Kode.'\')">
               <i class="bi bi-eye"></i> Detail
            </button>

            <button class="btn btn-sm btn-danger" onclick="ajukanHapus(\''.$row->Kode.'\')">
               <i class="bi bi-trash"></i> Ajukan Penghapusan
            </button>
            '
        ];
    }

    $output = [
        "draw" => intval($draw),
        "recordsTotal" => $this->M_kwitansi->count_all_batal(),
        "recordsFiltered" => $this->M_kwitansi->count_filtered_batal($tanggal),
        "data" => $data,
    ];

    echo json_encode($output);
}

}