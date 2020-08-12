<div class="content-wrapper">

	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">INPUT DATA BARANG</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

				<table class='table table-bordered'>

					<?php
					if (empty($kode_group)) { ?>
						<tr>
							<td width='200'>Kode Group <?php echo form_error('kode_group') ?></td>
							<td>
								<?php echo select2_dinamis('kode_group', 'master_group', 'nama_group', 'kode_group', 'Nama Group') ?>
							</td>
						</tr>
					<?php }
					//echo $kode_group;
					?>
					<!-- <tr>
						<td width='200'>Kode Barang <?php echo form_error('kode_manual') ?></td>
						<td><input type="text" class="form-control" name="kode_manual" id="kode_manual" placeholder="Kode Barang" value="<?php echo $kode_manual; ?>" /></td>
					</tr> -->
					<tr>
						<td width='200'>Nama <?php echo form_error('nama') ?></td>
						<td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td>
					</tr>
					<?php if ($gambar == "") { ?>
						<tr>
							<td width='200'>Gambar <?php echo form_error('gambar') ?></td>
							<td><input type="file" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" /></td>
						</tr>
					<?php } else { ?>
						<tr>
							<td width='200'>Gambar <?php echo form_error('gambar') ?></td>
							<td><img width="170" height="170" src="<?php echo base_url() . '/upload/image/' . $gambar; ?>"><input type="file" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" /></td>
						</tr>

					<?php } ?>
					<tr>
						<td width='200'>Spesifikasi <?php echo form_error('spesifikasi') ?></td>
						<td><input type="text" class="form-control" name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi" value="<?php echo $spesifikasi; ?>" /></td>
					</tr>
					<tr>
						<td width='200'>Merk <?php echo form_error('merk') ?></td>
						<td><input type="text" class="form-control" name="merk" id="merk" placeholder="Merk" value="<?php echo $merk; ?>" /></td>
					</tr>
					<tr>
						<td width='200'>Keterangan <?php echo form_error('keterangan') ?></td>
						<td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="hidden" name="kode_barang" value="<?php echo $kode_barang; ?>" />
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
							<a href="<?php echo site_url('tab_barang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td>
					</tr>
				</table>
			</form>
		</div>
</div>
</div>