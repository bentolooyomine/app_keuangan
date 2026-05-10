<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kwitansi extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_simrs = $this->load->database('simrs', TRUE);
    }

    // =========================
    // MENU
    // =========================
    public function get_menu($role_id)
    {
        return $this->db->select('m.*')
            ->from('menus m')
            ->join('role_menu rm', 'rm.menu_id = m.id')
            ->where('rm.role_id', $role_id)
            ->where('m.is_active', 1)
            ->order_by('m.urutan', 'ASC')
            ->get()->result();
    }

    public function get_submenu($menu_id)
    {
        return $this->db
            ->where('menu_id', $menu_id)
            ->where('is_active', 1)
            ->get('sub_menu')
            ->result();
    }

    // =========================
    // QUERY UTAMA (FIXED)
    // =========================
    private function _get_query($mode, $tanggal, $no_kwitansi, $start, $length)
    {
        $where = "";

        // 🔥 FILTER TANGGAL
        if ($mode == 'tanggal' && $tanggal) {
            $where .= " AND CONVERT(date, TTBayar.Tanggal) = '$tanggal'";
        }

        // 🔥 SEARCH KWITANSI (FULL PRIORITY)
        if ($mode == 'kwitansi' && $no_kwitansi) {
            $kw = strtoupper(trim($no_kwitansi));
            $where .= " AND UPPER(LTRIM(RTRIM(TTBayar.NoKwitansi))) LIKE '%$kw%'";
        }

        // 🔥 ORDER WAJIB UNIK (ANTI HILANG DATA)
        $order = "ORDER BY TTBayar.Tanggal DESC, TTBayar.Kode DESC";

        // 🔥 PAGINATION RULE
        $limit = "";
        if ($mode != 'kwitansi') {
            $limit = "OFFSET $start ROWS FETCH NEXT $length ROWS ONLY";
        }

        $sql = "
            SELECT 
                TTBayar.Kode,
                TTBayar.NoKwitansi,
                TTBayar.Tanggal,
                TTBayar.Bayar,
                TMPetugas.Nama AS Petugas
            FROM TTBayar
            LEFT JOIN TMPetugas ON TMPetugas.Kode = TTBayar.IdPetugas
            WHERE 1=1 $where
            $order
            $limit
        ";

        return $sql;
    }

    // =========================
    // GET DATA
    // =========================
    public function get_datatables($mode, $tanggal, $no_kwitansi, $start, $length)
    {
        $sql = $this->_get_query($mode, $tanggal, $no_kwitansi, $start, $length);
        return $this->db_simrs->query($sql)->result();
    }

    // =========================
    // COUNT FILTERED
    // =========================
    public function count_filtered($mode, $tanggal, $no_kwitansi)
    {
        $where = "";

        if ($mode == 'tanggal' && $tanggal) {
            $where .= " AND CONVERT(date, TTBayar.Tanggal) = '$tanggal'";
        }

        if ($mode == 'kwitansi' && $no_kwitansi) {
            $kw = strtoupper(trim($no_kwitansi));
            $where .= " AND UPPER(LTRIM(RTRIM(TTBayar.NoKwitansi))) LIKE '%$kw%'";
        }

        $sql = "
            SELECT COUNT(*) AS total
            FROM TTBayar
            WHERE 1=1 $where
        ";

        return $this->db_simrs->query($sql)->row()->total;
    }

    // =========================
    // COUNT ALL
    // =========================
    public function count_all()
    {
        $sql = "SELECT COUNT(*) AS total FROM TTBayar";
        return $this->db_simrs->query($sql)->row()->total;
    }

    function cek()  {
        return $this->db_simrs->query("SELECT * FROM syslog WHERE syslog.Nomor LIKE '247053382602001%'");
    }


public function get_detail($kode)
{
    $sql = "
        SELECT TOP 1
            TTBayar.*,
            TMPetugas.Nama AS NamaPetugas
        FROM TTBayar
        LEFT JOIN TMPetugas 
            ON TMPetugas.Kode = TTBayar.IdPetugas
        WHERE TTBayar.Kode = '$kode'
    ";

    return $this->db_simrs->query($sql)->row();
}


public function simpan_pengajuan($data)
{
    return $this->db->insert('permohonan_penghapusan', $data);
}


public function get_permohonan($tanggal)
{
    $where = "";

    if ($tanggal) {
        $where = " AND DATE(tanggal_pengajuan) = '$tanggal'";
    }

    $sql = "
        SELECT *
        FROM permohonan_penghapusan
        WHERE 1=1 $where
        ORDER BY tanggal_pengajuan DESC
    ";

    return $this->db->query($sql)->result();
}

public function get_detail_permohonan($id)
{
    return $this->db->get_where('permohonan_penghapusan', ['id' => $id])->row();
}


private function _get_query_batal($tanggal, $start, $length)
{
    $where = "";

    // FILTER TANGGAL
    if ($tanggal) {

        $where .= "
            AND CONVERT(date, TTBayar.Tanggal) = '$tanggal'
        ";
    }

    // FILTER BPD
    $where .= "
        AND TTBayar.StBPD = 1
        AND TTBayar.StBayarBPD = 0
    ";

    // SEARCH DATATABLE
    if (!empty($_POST['search']['value'])) {

        $search = strtoupper(trim($_POST['search']['value']));

        $where .= "
            AND (
                UPPER(LTRIM(RTRIM(TTBayar.NoKwitansi))) LIKE '%$search%'
                OR UPPER(LTRIM(RTRIM(TMPetugas.Nama))) LIKE '%$search%'
            )
        ";
    }

    // ORDER
    $order = "
        ORDER BY 
            TTBayar.Tanggal DESC,
            TTBayar.Kode DESC
    ";

    // PAGINATION SQL SERVER
    $limit = "";

    if ($length != -1) {

        $limit = "
            OFFSET $start ROWS
            FETCH NEXT $length ROWS ONLY
        ";
    }

    $sql = "
        SELECT 
            TTBayar.Kode,
            TTBayar.NoKwitansi,
            TTBayar.Tanggal,
            TTBayar.Bayar,
            TMPetugas.Nama AS Petugas

        FROM TTBayar

        LEFT JOIN TMPetugas 
            ON TMPetugas.Kode = TTBayar.IdPetugas

        WHERE 1=1 
            $where

        $order

        $limit
    ";

    return $sql;
}


public function get_datatables_batal($tanggal, $start, $length)
{
    $sql = $this->_get_query_batal(
        $tanggal,
        $start,
        $length
    );

    return $this->db_simrs->query($sql)->result();
}

public function count_all_batal()
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM TTBayar
        WHERE 
            StBPD = 1
            AND StBayarBPD = 0
    ";

    return $this->db_simrs->query($sql)->row()->total;
}

public function count_filtered_batal($tanggal)
{
    $where = "";

    if ($tanggal) {

        $where .= "
            AND CONVERT(date, TTBayar.Tanggal) = '$tanggal'
        ";
    }

    $where .= "
        AND TTBayar.StBPD = 1
        AND TTBayar.StBayarBPD = 0
    ";

    // SEARCH DATATABLE
    if (!empty($_POST['search']['value'])) {

        $search = strtoupper(trim($_POST['search']['value']));

        $where .= "
            AND (
                UPPER(LTRIM(RTRIM(TTBayar.NoKwitansi))) LIKE '%$search%'
                OR UPPER(LTRIM(RTRIM(TMPetugas.Nama))) LIKE '%$search%'
            )
        ";
    }

    $sql = "
        SELECT COUNT(*) AS total

        FROM TTBayar

        LEFT JOIN TMPetugas 
            ON TMPetugas.Kode = TTBayar.IdPetugas

        WHERE 1=1
            $where
    ";

    return $this->db_simrs->query($sql)->row()->total;
}


public function proses_batal_bpd($kode)
{
    $sql = "
        UPDATE TTBayar
        SET StBPD = 0
        WHERE Kode = '$kode'
    ";

    return $this->db_simrs->query($sql);
}

public function get_beritaacara($id)
{
    return $this->db
        ->where('id', $id)
        ->get('permohonan_penghapusan')
        ->row();
}

}