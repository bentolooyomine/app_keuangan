<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwitansi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kwitansi');
         $this->db_simrs = $this->load->database('simrs', TRUE);
       if (!$this->session->userdata('logged_in')) {
    redirect('auth');
}
    }

     public function index()
    {
        $role_id = $this->session->userdata('role_id');

        $menu = $this->M_kwitansi->get_menu($role_id);

        foreach ($menu as $m) {
            $m->submenu = $this->M_kwitansi->get_submenu($m->id);
        }

        $data = array(
            'title' => 'Aplikasi Keuangan RSPA',
            'nama_app' => 'Kwitansi',
            'user'  => $this->session->userdata('username'),
            'menu'  => $menu,
            'versi' => '0.0.1'
        );

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);

        // 🔥 VIEW UTAMA DATATABLE
        $this->load->view('dashboard', $data);

        $this->load->view('template/footer_batal');
    }

    // =========================
    // AJAX DATATABLE
    // =========================
    public function ajax_list()
{
    $mode = $this->input->post('mode');

    $tanggal = $this->input->post('tanggal');
    if (!$tanggal) {
        $tanggal = date('Y-m-d');
    }

    $no_kwitansi = $this->input->post('no_kwitansi');

    $start  = $this->input->post('start');
    $length = $this->input->post('length');
    $draw   = $this->input->post('draw');

    // 🔥 FIX: kirim sesuai model baru
    $list = $this->M_kwitansi->get_datatables(
        $mode,
        $tanggal,
        $no_kwitansi,
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

    // 🔥 KOLOM TOOLS
    '
    <button class="btn btn-sm btn-success" onclick="detail(\''.$row->Kode.'\')">
       <i class="bi bi-eye"></i>  Detail
    </button>

    <button class="btn btn-sm btn-danger" onclick="ajukanHapus(\''.$row->Kode.'\')">
      <i class="bi bi-trash"></i>  Ajukan Penghapusan
    </button>
    '
];
    }

    $output = [
        "draw" => intval($draw),
        "recordsTotal" => $this->M_kwitansi->count_all(),
        "recordsFiltered" => $this->M_kwitansi->count_filtered($mode, $tanggal, $no_kwitansi),
        "data" => $data,
    ];

    echo json_encode($output);
}

    function cek_db()  {
        $data = $this->M_kwitansi->cek()->result();
        print_r($data);
    }


    //get_detail
public function detail()
{
    $kode = $this->input->post('kode');

    $data = $this->M_kwitansi->get_detail($kode);

    echo json_encode($data);
}


public function ajukan_penghapusan()
{
    $kode = $this->input->post('kode');
    $alasan = $this->input->post('alasan');

    // ambil detail kwitansi
    $data = $this->M_kwitansi->get_detail($kode);

    $insert = [
        'kode_kwitansi'     => $data->Kode,
        'kode_ttbayar'      => $data->Kode,
        'no_kwitansi'       => $data->NoKwitansi,
        'tanggal_kwitansi'  => $data->Tanggal,
        'total_bayar'       => $data->Bayar,
        'id_petugas'        => $data->IdPetugas,
        'KodeKunjungan'     => $data->KodeKunjungan,
        'alasan'            => $alasan,
        'status_pengajuan'  => 'pengajuan',
        'tanggal_pengajuan' => date('Y-m-d H:i:s')
    ];

    $this->M_kwitansi->simpan_pengajuan($insert);

    echo json_encode(['status' => true]);
}



public function permohonan()
{
    $role_id = $this->session->userdata('role_id');

    $menu = $this->M_kwitansi->get_menu($role_id);

    foreach ($menu as $m) {
        $m->submenu = $this->M_kwitansi->get_submenu($m->id);
    }

    $data = [
        'title' => 'Permohonan Penghapusan',
        'nama_app' => 'Kwitansi',
        'user'  => $this->session->userdata('username'),
        'menu'  => $menu,
        'versi' => '0.0.1'
    ];

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar', $data);
    $this->load->view('permohonan', $data);
    $this->load->view('template/footer');
}


public function ajax_permohonan()
{
    $tanggal = $this->input->post('tanggal');

    if (!$tanggal) {
        $tanggal = date('Y-m-d');
    }

    $list = $this->M_kwitansi->get_permohonan($tanggal);

    $data = [];
    $no = 1;

    foreach ($list as $r) {

        // =========================
        // STATUS BADGE
        // =========================
        if ($r->status_pengajuan == 'pengajuan') {
            $status = '<span class="badge bg-warning">Pengajuan</span>';
        } elseif ($r->status_pengajuan == 'proses') {
            $status = '<span class="badge bg-info">Proses</span>';
        } else {
            $status = '<span class="badge bg-success">Selesai</span>';
        }

        // =========================
        // TOOLS DINAMIS
        // =========================
        $tools = '';

        if ($r->status_pengajuan == 'pengajuan') {

            $tools = '
                <button class="btn btn-sm btn-primary" onclick="tindakLanjut('.$r->id.')">
                   <i class="bi bi-arrow-bar-left"></i>  Tindak Lanjut
                </button>
            ';

        } elseif ($r->status_pengajuan == 'proses') {

            $tools = '
                
                <button class="btn btn-sm btn-danger" onclick="sinkronisasi('.$r->id.')">
                   <i class="bi bi-cloud-download"></i>   Sinkronisasi
                </button>
            ';

      } else {

    $status = '<span class="badge bg-success">Selesai</span>';

    $tools = '
        <button class="btn btn-info btn-sm" onclick="detailSinkron('.$r->id.')">
             <i class="bi bi-eye"></i>  Detail Transaksi
        </button>

         <button class="btn btn-secondary btn-sm" onclick="beritaacara('.$r->id.')">
             <i class="bi bi-stack"></i>  Berita Acara
        </button>
    ';
}

        // =========================
        // OUTPUT DATA
        // =========================
        $data[] = [
            $no++,
            $r->no_kwitansi,
            number_format($r->total_bayar,0,',','.'),
            $r->alasan,
            date('d-m-Y H:i', strtotime($r->tanggal_pengajuan)),
            $status,
            $tools
        ];
    }

    echo json_encode(['data' => $data]);
}



public function proses_pengajuan()
{
    $id = $this->input->post('id');

    $this->db->where('id', $id);
    $this->db->update('permohonan_penghapusan', [
        'status_pengajuan' => 'proses'
    ]);

    echo json_encode(['status' => true]);
}

public function detail_permohonan()
{
    $id = $this->input->post('id');

    $data = $this->db->get_where('permohonan_penghapusan', [
        'id' => $id
    ])->row();

    echo json_encode($data);
}

public function sinkronisasi()
{
    $id = $this->input->post('id');

    // 🔥 ambil data permohonan
    $data = $this->db->get_where('permohonan_penghapusan', [
        'id' => $id
    ])->row();

    if (!$data) {
        echo json_encode(['status' => false, 'msg' => 'Data tidak ditemukan']);
        return;
    }

    // 🔥 ambil kode kunjungan (INI KUNCI UTAMA)
    $kode_kunjungan = $data->KodeKunjungan; // atau kode_kwitansi jika itu isinya
    // $kode_kunjungan = trim($data->kode_kunjungan ?? $data->KodeKunjungan ?? '');

    if (!$kode_kunjungan) {
        echo json_encode(['status' => false, 'msg' => 'Kode kunjungan kosong']);
        return;
    }

    // 🔥 QUERY KE SQL SERVER (ODBC SAFE)
    $sql = "
        SELECT *
        FROM syslog
        WHERE Nomor LIKE '".$kode_kunjungan."%'
    ";

    $query = $this->db_simrs->query($sql);
    $logs = $query->result();

    if (!$logs) {
        echo json_encode([
            'status' => false,
            'msg' => 'Data syslog tidak ditemukan'
        ]);
        return;
    }

    // 🔥 INSERT KE MYSQL syslog_sinkron
    foreach ($logs as $log) {

        $this->db->insert('syslog_sinkron', [
            'kode' => $log->Kode,
            'tanggal' => $log->Tanggal,
            'aplikasi' => $log->Aplikasi,
            'kegiatan' => $log->Kegiatan,
            'nomor' => $log->Nomor,
            'petugas' => $log->Petugas,
            'transaksi' => $log->Transaksi,
            'id_permohonan_penghapusan' => $id
        ]);

    }

    // 🔥 UPDATE STATUS PERMOHONAN
    $this->db->where('id', $id);
    $this->db->update('permohonan_penghapusan', [
        'status_pengajuan' => 'selesai'
    ]);

    echo json_encode([
        'status' => true,
        'msg' => 'Sinkronisasi berhasil',
        'total_log' => count($logs)
    ]);
}


public function detail_sinkron()
{
    $id = $this->input->post('id');

    $data = $this->db->get_where('syslog_sinkron', [
        'id_permohonan_penghapusan' => $id
    ])->result();

    echo json_encode([
        'status' => true,
        'data' => $data
    ]);
}


 public function batalbpd()
    {
        $role_id = $this->session->userdata('role_id');

        $menu = $this->M_kwitansi->get_menu($role_id);

        foreach ($menu as $m) {
            $m->submenu = $this->M_kwitansi->get_submenu($m->id);
        }

        $data = array(
            'title' => 'Aplikasi Keuangan RSPA',
            'nama_app' => 'Batal Bayar Kwitansi',
            'user'  => $this->session->userdata('username'),
            'menu'  => $menu,
            'versi' => '0.0.1'
        );

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);

        // 🔥 VIEW UTAMA DATATABLE
        $this->load->view('dashboard_batal', $data);

        $this->load->view('template/footer');
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
            <button class="btn btn-sm btn-success" onclick="detail(\''.$row->Kode.'\')">
               <i class="bi bi-eye"></i> Detail
            </button>

            <button class="btn btn-sm btn-danger" onclick="batalBpd(\''.$row->Kode.'\')">
               <i class="bi bi-shield-fill-x"></i> Batal BPD
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


public function proses_batal_bpd()
{
    $kode = $this->input->post('kode');

    $update = $this->M_kwitansi->proses_batal_bpd($kode);

    if($update){

        echo json_encode([
            'status' => true
        ]);

    } else {

        echo json_encode([
            'status' => false,
            'message' => 'Gagal update data'
        ]);
    }
}

public function beritaacara($id)
{
    $data['row'] = $this->M_kwitansi->get_beritaacara($id);
$data['setting'] = $this->db->get('settings')->row();
    $this->load->view(
        'berita_acara_view',
        $data
    );
}


}