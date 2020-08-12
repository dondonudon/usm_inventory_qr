<?php

if (empty($tanggal_a) || empty($tanggal_b)) {
 $query = $this->db->query("SELECT * ,master_stok_kasir_detail.stok as qty, s.datetime as tanggal_beli
                                FROM master_stok_kasir
                                INNER JOIN master_stok_kasir_detail ON master_stok_kasir.nostokkasir = master_stok_kasir_detail.nostokkasir
                                INNER JOIN tab_barang ON tab_barang.kode_barang = master_stok_kasir_detail.kode_barang
                                INNER JOIN stock_opname_detail s ON s.kode_barang =  master_stok_kasir_detail.kode_barang");
} else {
 $query = $this->db->query("SELECT * ,master_stok_kasir_detail.stok as qty, s.datetime as tanggal_beli
                                FROM master_stok_kasir
                                INNER JOIN master_stok_kasir_detail ON master_stok_kasir.nostokkasir = master_stok_kasir_detail.nostokkasir
                                INNER JOIN tab_barang ON tab_barang.kode_barang = master_stok_kasir_detail.kode_barang
                                INNER JOIN stock_opname_detail s ON s.kode_barang =  master_stok_kasir_detail.kode_barang
                                WHERE tanggal BETWEEN '$tanggal_a' AND '$tanggal_a' ");
}

?>
<html>
<style>
.body {
  font-family: "Times New Roman", Times, serif;
}
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: grey;
  color: white;
  text-align: center;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
<body class="body">
<table width="100%">
  <tr>
    <td align="center" width="150px" rowspan="5"><img src="<?php echo base_url(); ?>assets/image/logo.png" width="100"></td>
    <td align="center"><font color="black"> <strong style="font-size: 18px;"> KELOMPOK BERMAIN, TAMAN KANAK-KANAK, TPA, DAN LAYANAN KHUSUS</font> </td>
    <td align="center" width="150px" rowspan="5"><img src="<?php echo base_url(); ?>assets/image/logo2.png" width="100"></td>
  </tr>
  <tr><td align="center"><font color="blue"> <strong style="font-size: 30px;"> PAUD AN-NAHL PRESCHOOL - KAB. SEMARANG</font> </td></tr>
  <tr><td align="center">Jl. Jalak No. 42 RT.12 RW.01 Kel. Ungaran, Kec. Ungaran Barat, Kab. Semarang</td></tr>
  <tr><td align="center">Telp. / Fax. (024) 76910840, email : annahlpreschoolung@gmail.com<</strong></td></tr>
  <tr><td align="center">mobile : 0811-2888-700</td></tr>
</table>
<hr size="30">
<center><h3>LAPORAN BARANG KELUAR</h3></center>
<div class="box-body">
    <div style="padding-bottom: 10px;">
    <table class='table table-bordered' width="100%" >
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
            <td>Tanggal Beli</td>
            <td>Merk</td>
            <td>Gambar</td>
            <td>Alasan</td>
            <td>Tanggal Keluar</td>
            <td>Nama Toko</td>
            <td>Jumlah</td>
        </tr>
        <?php
$no = 1;
foreach ($query->result_array() as $data) {
 ?>
        <tr>
            <td> <?php echo $no; ?></td>
            <td> <?php echo $data['nama']; ?></td>
            <td> <?php echo date_format(date_create($data['tanggal_beli']), 'd/m/Y'); ?></td>
            <td> <?php echo $data['merk']; ?></td>
            <td> <img src="<?php echo base_url() . 'upload/image/' . $data['gambar']; ?>" alt="<?php echo $data['nama']; ?>" width="100"></td>
            <td> <?php echo $data['alasan']; ?></td>
            <td> <?php echo date_format(date_create($data['tanggal']), 'd/m/Y'); ?></td>
            <td> <?php echo $data['ket']; ?></td>
            <td> <?php echo $data['qty']; ?></td>
        </tr>
        <?php $no++?>
        <?php }?>
        </table>
</div>
</div><br>
<div class="pull-right">Ungaran Barat, <?php echo date('d F Y'); ?><br>
Kepala Sekolah <br><br><br><br>
<strong>Yulia Risanti, S.Psi </strong><br>
</div>
<div class="footer">
  <p>Dicetak tanggal <?php echo date('Y-m-d H:i:s'); ?></p>
</div>
</body>
</html>