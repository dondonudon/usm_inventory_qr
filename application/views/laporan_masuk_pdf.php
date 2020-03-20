<?php

if (empty($tanggal_a) || empty($tanggal_b)) {
    $query = $this->db->query("SELECT *, tab_barang.nama as nama_barang, stock_opname_detail.stok as qty
                                FROM stock_opname 
                                INNER JOIN stock_opname_detail ON stock_opname.nostockopname = stock_opname_detail.nostockopname
                                INNER JOIN tab_barang ON tab_barang.kode_barang = stock_opname_detail.kode_barang");
} else {
    $query = $this->db->query("SELECT *, tab_barang.nama as nama_barang, stock_opname_detail.stok as qty 
                                FROM stock_opname 
                                INNER JOIN stock_opname_detail ON stock_opname.nostockopname = stock_opname_detail.nostockopname 
                                INNER JOIN tab_barang ON tab_barang.kode_barang = stock_opname_detail.kode_barang
                                WHERE stock_opname.tanggal BETWEEN '$tanggal_a' AND '$tanggal_b' ");
}


?>
<html>
<style>
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
<body>
<center><h2>PAUD AN-NAHL PRESCHOOL - KAB. SEMARANG</h2>
<h3>LAPORAN BARANG MASUK</h3></center>

<div class="box-body">
    <div style="padding-bottom: 10px;">
    <table class='table table-bordered' width="100%" >
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
            <td>Gambar</td>
            <td>Lokasi</td>
            <td>Sumber Dana</td>
            <td>Tanggal Beli</td>
            <td>Nama Toko</td>
            <td>Jumlah</td>
            <td>Harga</td>
            <td>Subtotal</td>
        </tr>
        <?php
        $no = 1;
        foreach ($query->result_array() as $data) {
        ?>
        <tr>
            <td> <?php echo $no; ?></td>
            <td> <?php echo $data['nama']; ?></td>
            <td> <img src="<?php echo base_url() . 'upload/image/' . $data['gambar']; ?>" alt="<?php echo $data['nama']; ?>" width="100"></td>
            <td> <?php echo $data['lokasi']; ?></td>
            <td> <?php echo $data['sumber']; ?></td>
            <td> <?php echo $data['tanggal']; ?></td>
            <td> <?php echo $data['ket']; ?></td>   
            <td> <?php echo $data['qty']; ?></td>
            <td> <?php echo $data['harga']; ?></td>
            <td> <?php echo $data['jumlah']; ?></td>
        </tr>
        <?php $no++ ?>
        <?php } ?>
</table>
</div>
</div>
<div class="footer">
  <p>Dicetak tanggal <?php echo date('Y-m-d H:i:s'); ?></p>
</div>
</body>
</html>