<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TAB_PRICELIST</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

<table class='table table-bordered'>

		<tr><td width='200'>Barang <?php echo form_error('kode_barang') ?></td>
		<td>
			<?php echo select2_dinamis('kode_barang', 'tab_barang', 'nama', 'kode_barang', 'Nama Barang') ?>
		</td></tr>
		<?php
$query = $this->db->query("SELECT * FROM tab_kasir ORDER BY kode_kasir ASC")->result_array();
foreach ($query as $key) {
 echo "<input type=\"hidden\" name=\"kode_kasir[]\" id=\"kode_kasir[]\" value=" . $key['kode_kasir'] . ">";
 echo "<tr><td width='200'>" . $key['nama'] . "</td><td><input type=\"text\" class=\"form-control\" name=\"harga[]\" id=\"harga[]\" placeholder=\"Harga\"></td></tr>";
 //  echo $key['kode_kasir'];
 //  echo $key['nama'];
}
?>
	    <tr><td></td><td><input type="hidden" name="id_pricelist" value="<?php echo $id_pricelist; ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
	    <a href="<?php echo site_url('tab_pricelist') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>