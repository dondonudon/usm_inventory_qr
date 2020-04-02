<?php

if (empty($tanggal_a) || empty($tanggal_b)) {
 $query = $this->db->query("SELECT * ,master_stok_kasir_detail.stok as qty
                                FROM master_stok_kasir
                                INNER JOIN master_stok_kasir_detail ON master_stok_kasir.nostokkasir = master_stok_kasir_detail.nostokkasir
                                INNER JOIN tab_barang ON tab_barang.kode_barang = master_stok_kasir_detail.kode_barang");
} else {
 $query = $this->db->query("SELECT * ,master_stok_kasir_detail.stok as qty
                                FROM master_stok_kasir
                                INNER JOIN master_stok_kasir_detail ON master_stok_kasir.nostokkasir = master_stok_kasir_detail.nostokkasir
                                INNER JOIN tab_barang ON tab_barang.kode_barang = master_stok_kasir_detail.kode_barang
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
<center><h2>PAUD AN-NAHL PRESCHOOL - KAB. SEMARANG</h2>
<h3>LAPORAN BARANG KELUAR</h3></center>

<div class="box-body">
    <div style="padding-bottom: 10px;">
    <table class='table table-bordered' width="100%" >
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
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