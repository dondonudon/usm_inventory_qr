<div class="content-wrapper">
    
<section class="content">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Master_group Read</h3>
        </div>
        
        
<table class='table table-bordered>'>
	    <tr><td>Nama</td><td><?php echo $nama_group; ?></td></tr>
	    <tr><td>Gambar</td><td><img src="<?php echo base_url().'/upload/image/'.$gambar; ?>"></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <!-- <tr><td>Opsi1</td><td><?php echo $opsi1; ?></td></tr>
	    <tr><td>Opsi2</td><td><?php echo $opsi2; ?></td></tr>
	    <tr><td>Opsi3</td><td><?php echo $opsi3; ?></td></tr>
	    <tr><td>Opsi4</td><td><?php echo $opsi4; ?></td></tr>
	    <tr><td>Opsi5</td><td><?php echo $opsi5; ?></td></tr> -->
	    <tr><td></td><td><a href="<?php echo site_url('master_group') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>

</div>
</div>
</div>