<!DOCTYPE html>
<html>
<head>
    <title>Berita Acara Pembatalan Pembayaran BPD</title>

    <style>

        body{
            font-family: "Times New Roman", serif;
            font-size: 14px;
            margin: 35px;
            color:#000;
        }

        .kop{
            width:100%;
            border-bottom:3px solid #000;
            padding-bottom:10px;
            margin-bottom:25px;
        }

        .kop td{
            vertical-align:top;
        }

        .logo{
            width:90px;
        }

        .judul-instansi{
            text-align:center;
            line-height:1.5;
        }

        .judul-instansi .kab{
            font-size:18px;
            font-weight:bold;
        }

        .judul-instansi .nama{
            font-size:24px;
            font-weight:bold;
            text-transform:uppercase;
        }

        .judul-instansi .alamat{
            font-size:13px;
        }

        .judul{
            text-align:center;
            margin-top:30px;
            margin-bottom:30px;
        }

        .judul .utama{
            font-size:20px;
            font-weight:bold;
            text-decoration:underline;
        }

        .judul .nomor{
            margin-top:5px;
        }

        .isi{
            text-align:justify;
            line-height:1.8;
        }

        table.rincian{
            width:100%;
            margin-top:20px;
            border-collapse:collapse;
        }

        table.rincian td{
            padding:6px;
            vertical-align:top;
        }

        .footer{
            margin-top:40px;
            width:100%;
        }

        .ttd{
            width:320px;
            float:right;
            text-align:center;
            line-height:1.8;
        }

        .nama-ttd{
            margin-top:80px;
            font-weight:bold;
            text-decoration:underline;
        }

    </style>

</head>

<body onload="window.print()">

<!-- KOP SURAT -->
<table class="kop">

    <tr>

        <td width="100">
            <img src="<?= base_url('assets/logo.png') ?>" class="logo">
        </td>

        <td class="judul-instansi">

            <div class="kab">
                PEMERINTAH <?= strtoupper($setting->kabupaten) ?>
            </div>

            <div class="nama">
                <?= strtoupper($setting->nama_app) ?>
            </div>

            <div>
                <!-- Kecamatan <?= $setting->kecamatan ?> -->
            </div>

            <div class="alamat">
                <?= $setting->alamat ?> <br>
                <?= $setting->kabupaten ?> - <?= $setting->provinsi ?>
            </div>

        </td>

    </tr>

</table>

<!-- JUDUL -->
<div class="judul">

    <div class="utama">
        BERITA ACARA PEMBATALAN PEMBAYARAN BPD
    </div>

    <div class="nomor">
        Nomor : <?= $row->no_kwitansi ?>
    </div>

</div>

<!-- ISI -->
<div class="isi">

    <p>
        Pada hari ini <b><?= date('d F Y', strtotime($row->tanggal_pengajuan)) ?></b>,
        telah dilakukan <b> penghapusan Kwitansi</b> dengan rincian sebagai berikut :
    </p>

</div>

<table class="rincian">

    <tr>
        <td width="220">No Kwitansi</td>
        <td width="20">:</td>
        <td><?= $row->no_kwitansi ?></td>
    </tr>
     <tr>
        <td width="220">Kode Kwitansi</td>
        <td width="20">:</td>
        <td><?= $row->kode_kwitansi ?></td>
    </tr>
 <tr>
        <td width="220">Kode Bayar</td>
        <td width="20">:</td>
        <td><?= $row->kode_ttbayar ?></td>
    </tr>
    <tr>
        <td width="220">Tanggal Kwitansi</td>
        <td width="20">:</td>
        <td><?= $row->tanggal_kwitansi ?></td>
    </tr>
    <tr>
        <td>Tanggal Pengajuan</td>
        <td>:</td>
        <td><?= date('d-m-Y H:i:s', strtotime($row->tanggal_pengajuan)) ?></td>
    </tr>

    <tr>
        <td>Alasan Pembatalan</td>
        <td>:</td>
        <td><?= $row->alasan ?></td>
    </tr>

    <tr>
        <td>Petugas Penginput</td>
        <td>:</td>
        <td><?= $row->id_petugas ?></td>
    </tr>

</table>

<div class="isi">

    <p style="margin-top:30px">
        Demikian berita acara ini dibuat dengan sebenarnya untuk dapat
        dipergunakan sebagaimana mestinya.
    </p>

</div>

<!-- TTD -->
<div class="footer">

    <div class="ttd">

        Boyolali, <?= date('d F Y') ?>
        <br>

        Mengetahui,
        <br>

        Kepala <?= $setting->nama_app ?>

        <div class="nama-ttd">
            <?= strtoupper($setting->nama_kepala) ?>
        </div>

        NIP. <?= $setting->nip_kepala ?>

    </div>

</div>

</body>
</html>