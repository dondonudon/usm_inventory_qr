<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA DROPPING</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>

	    <tr><td width='200'>Kode M Kasir <?php echo form_error('kode_m_kasir') ?></td><td><input type="text" class="form-control" name="kode_m_kasir" id="kode_m_kasir" placeholder="Kode M Kasir" value="<?php echo $kode_m_kasir; ?>" /></td></tr>
	    <tr><td width='200'>Kode Barang <?php echo form_error('kode_barang') ?></td><td><input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" /></td></tr>
	    <tr><td width='200'>Stok <?php echo form_error('stok') ?></td><td><input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" /></td></tr>
	    <tr><td width='200'>Datetime <?php echo form_error('datetime') ?></td><td><input type="text" class="form-control" name="datetime" id="datetime" placeholder="Datetime" value="<?php echo $datetime; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_dropping" value="<?php echo $id_dropping; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('dropping') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>