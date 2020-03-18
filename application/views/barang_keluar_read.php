<?php

$data = $this->db->query("SELECT
                                t.id_s_kasir,
                                t.nostokkasir,
                                t.ket,
                                td.stok,
                                
                                t.datetime,
                                td.qrcode,
                                td.kode_barang,
                                tb.nama
                                
                                
                            FROM
                                master_stok_kasir t
                            INNER JOIN master_stok_kasir_detail td ON
                                t.nostokkasir = td.nostokkasir
                            INNER JOIN tab_barang tb on
                                td.kode_barang = tb.kode_barang
                            WHERE
                                t.nostokkasir = '$notrans'");

?>
<font size="4">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning box-solid">

                        <div class="box-header">
                            <h3 class="box-title">LAPORAN TRANSAKSI</h3>
                        </div>

                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                <table width="100%">
                                    <tr>
                                        <?php $row = $data->row(); ?>
                                        <td>No Transaksi</td>
                                        <td>:</td>
                                        <td><?php echo $row->nostokkasir; ?></td>
                                        <td>Tgl Transaksi</td>
                                        <td>:</td>
                                        <td><?php echo $row->datetime; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Toko</td>
                                        <td>:</td>
                                        <td><?php echo $row->ket; ?></td>
                                        <!-- <td>Jumlah</td>
                                        <td>:</td>
                                        <td><?php echo rupiah($row->jumlah); ?></td> -->
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
                                                <td>Nama Barang</td>
                                                <td>QTY</td>
                                                <!-- <td>Harga</td>
                                                <td>Subtotal</td> -->
                                                <td>QR</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($data->result_array() as $isi) {

                                            ?>
                                                <tr>
                                                    <td><?php echo $isi['nama']; ?></td>
                                                    <td><?php echo $isi['stok']; ?></td>
                                                    <td><a class="btn btn-sm btn-primary" href="<?php echo base_url() . '/upload/qr/' . $isi['qrcode']; ?>" title="Edit" target="_blank">QR</a></td>
                                                    <!-- <td> <img src="<?php echo base_url() . '/upload/qr/' . $isi['qrcode']; ?>" height="150" width="150"> </td> -->
                                                </tr>
                                            <?php }; ?>
                                        </tbody>

                                        <!-- <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    Jumlah
                                                </td>

                                                <td></td>
                                                <td><?php echo rupiah($row->jumlah); ?></td>
                                            </tr>

                                        </tfoot> -->
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