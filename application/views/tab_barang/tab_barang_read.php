<div class="content-wrapper">

<section class="content">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Data barang Read</h3>
        </div>


<table class='table table-bordered>'>
	    <tr><td>Kode Barang</td><td><?php echo $kode_barang; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Gambar</td><td><img src="<?php echo base_url() . '/upload/image/' . $gambar; ?>" width="200px"></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $stok; ?></td></tr>
		<tr><td>Merk</td><td><?php echo $merk; ?></td></tr>
		<tr><td>Spesifikasi</td><td><?php echo $spesifikasi; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>QR</td><td><img src="<?php echo base_url() . '/upload/qr/' . $kode_manual; ?>" width="200px"></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tab_barang') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>

</div>
</div>
</div>