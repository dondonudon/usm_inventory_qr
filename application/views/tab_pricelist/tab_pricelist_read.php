<div class="content-wrapper">

<section class="content">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Tab_pricelist Read</h3>
        </div>

		<form action="<?php echo $action; ?>" method="post">
<table class='table table-bordered>'>
<?php

$query       = $this->db->query("SELECT nama FROM tab_barang WHERE kode_barang= '$kode_barang'")->row();
$nama_barang = $query->nama;
?>
	    <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
		<?php
$query = $this->db->query("SELECT tab_pricelist.id_pricelist, tab_pricelist.kode_barang, tab_pricelist.kode_kasir, tab_pricelist.harga, tab_kasir.nama FROM tab_pricelist INNER JOIN tab_kasir ON tab_pricelist.kode_kasir = tab_kasir.kode_kasir WHERE tab_pricelist.kode_barang = '$kode_barang' ORDER BY tab_kasir.kode_kasir")->result_array();

foreach ($query as $key) {
 echo "<tr><td width='200'><input type=\"hidden\" name=\"kode_kasir[]\" id=\"kode_kasir[]\" value=" . $key['kode_kasir'] . " readonly><input type=\"hidden\" name=\"id_pricelist[]\" id=\"id_pricelist[]\" value=" . $key['id_pricelist'] . " readonly>";
 echo $key['nama'] . "</td>";
 echo "<td><input type=\"text\" class=\"form-control\" name=\"harga[]\" id=\"harga[]\" placeholder=\"Harga\" value=" . $key['harga'] . "></td></tr>";
 //  echo $key['kode_kasir'];
 //  echo $key['nama'];
}
?>
	    <!-- <tr><td>Harga</td><td><input type="text" id="harga" name="harga" value="<?php echo $harga; ?>"></td></tr> -->
		<input type="hidden" id="kode_barang" name="kode_barang" value= <?php echo $kode_barang; ?>>
	    <tr><td></td><td><button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button><a href="<?php echo site_url('tab_pricelist') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
	</form>
</div>
</div>
</div>