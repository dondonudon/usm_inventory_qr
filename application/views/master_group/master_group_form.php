<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA MASTER_GROUP</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered'>

	    <tr><td width='200'>Nama <?php echo form_error('nama_group') ?></td><td><input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Nama Group" value="<?php echo $nama_group; ?>" /></td></tr>
	    <tr><td width='200'>Gambar <?php echo form_error('gambar') ?></td><td><input type="file" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" /></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Opsi1 <?php echo form_error('opsi1') ?></td><td><input type="text" class="form-control" name="opsi1" id="opsi1" placeholder="Opsi1" value="<?php echo $opsi1; ?>" /></td></tr>
	    <tr><td width='200'>Opsi2 <?php echo form_error('opsi2') ?></td><td><input type="text" class="form-control" name="opsi2" id="opsi2" placeholder="Opsi2" value="<?php echo $opsi2; ?>" /></td></tr>
	    <tr><td width='200'>Opsi3 <?php echo form_error('opsi3') ?></td><td><input type="text" class="form-control" name="opsi3" id="opsi3" placeholder="Opsi3" value="<?php echo $opsi3; ?>" /></td></tr>
	    <tr><td width='200'>Opsi4 <?php echo form_error('opsi4') ?></td><td><input type="text" class="form-control" name="opsi4" id="opsi4" placeholder="Opsi4" value="<?php echo $opsi4; ?>" /></td></tr>
	    <tr><td width='200'>Opsi5 <?php echo form_error('opsi5') ?></td><td><input type="text" class="form-control" name="opsi5" id="opsi5" placeholder="Opsi5" value="<?php echo $opsi5; ?>" /></td></tr> -->
	    <tr><td></td><td><input type="hidden" name="kode_group" value="<?php echo $kode_group; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_group') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>