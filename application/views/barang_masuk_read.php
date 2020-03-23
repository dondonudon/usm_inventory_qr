<?php

$data = $this->db->query("SELECT
                                t.id_stock_opname,
                                t.nostockopname,
                                t.nota,
                                t.ket,
                                td.stok,
                                t.jumlah,
                                t.datetime,
                                t.tanggal,
                                t.sumber,
                                td.qrcode,
                                td.kode_barang,
                                tb.nama,
                                tb.gambar,
                                td.harga,
                                td.lokasi,
                                td.jumlah as subtotal
                            FROM
                                stock_opname t
                            INNER JOIN stock_opname_detail td ON
                                t.nostockopname = td.nostockopname
                            INNER JOIN tab_barang tb on
                                td.kode_barang = tb.kode_barang
                            WHERE
                                t.nostockopname = '$notrans'");

?>
<font size="4">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning box-solid">

                        <div class="box-header">
                            <h3 class="box-title">LAPORAN BARANG MASUK</h3>
                        </div>

                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                <table width="100%">
                                    <tr>
                                        <?php $row = $data->row();?>
                                        <td>Tgl Pembelian</td>
                                        <td>:</td>
                                        <td><?php echo $row->tanggal; ?></td>
                                        <td>Sumber Dana</td>
                                        <td>:</td>
                                        <td><?php echo $row->sumber; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Toko</td>
                                        <td>:</td>
                                        <td><?php echo $row->ket; ?></td>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td><?php echo rupiah($row->jumlah); ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <hr>
                                <p>
                                    <table class='table table-bordered'>
                                        <thead>
                                            <tr>
                                                <td>Kode Barang</td>
                                                <td>Nama Barang</td>
                                                <td>Lokasi</td>
                                                <td>QTY</td>
                                                <td>Harga</td>
                                                <td>Subtotal</td>
                                                <td>Gambar</td>
                                                <td>QR</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($data->result_array() as $isi) {

 ?>
                                                <tr>
                                                    <td><?php echo $isi['kode_barang']; ?></td>
                                                    <td><?php echo $isi['nama']; ?></td>
                                                    <td><?php echo $isi['lokasi']; ?></td>
                                                    <td><?php echo $isi['stok']; ?></td>
                                                    <td><?php echo rupiah($isi['harga']); ?></td>
                                                    <td><?php echo rupiah($isi['subtotal']); ?></td>
                                                    <td><img src="<?php echo base_url() . 'upload/image/' . $isi['gambar']; ?>" alt="<?php echo $isi['nama']; ?>" width="150"></td>
                                                    <td><a class="btn btn-sm btn-primary" href="<?php echo base_url() . '/upload/qr/' . $isi['qrcode']; ?>" title="Edit" target="_blank">QR</a></td>
                                                    <!-- <td> <img src="<?php echo base_url() . '/upload/qr/' . $isi['qrcode']; ?>" height="150" width="150"> </td> -->
                                                </tr>
                                            <?php }
;?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="3">
                                                    Jumlah
                                                </td>

                                                <td></td>
                                                <td><?php echo rupiah($row->jumlah); ?></td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</font>