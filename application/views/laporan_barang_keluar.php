<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">LAPORAN BARANG KELUAR</h3>
                    </div>

                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <div id="form-filter" class="form-horizontal">
                                <!-- <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Kasir</label>
                            <div class="col-sm-4">
                                <input type="date" class="input-tanggal" id="tgl_b">
                            </div>
                        </div> -->
                                <div class="form-group">
                                    <label for="FirstName" class="col-sm-2 control-label">Tanggal Awal</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="input-tanggal" id="tgl_a">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="FirstName" class="col-sm-2 control-label">Tanggal Akhir</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="input-tanggal" id="tgl_b">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="LastName" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                                        <!-- <button type="button" id="btn-reset" class="btn btn-default">Reset</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="<?php base_url();?>laporan_barang_keluar/report" method="post">
                            <input type="hidden" name="tanggal_a" id="tanggal_a">
                            <input type="hidden" name="tanggal_b" id="tanggal_b">
                            <button type="submit" class="btn btn-success">Print</button>
                        </form><br>
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nota</th>
                                    <!-- <th>Kasir</th> -->
                                    <!-- <th>Jumlah</th> -->
                                    <th>Tanggal</th>
                                    <th>QR</th>
                                    <th>View</th>
                                    <!-- <th>Print</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tfoot>
                        </table>
                        <!-- <table id="footer"  class="table table-striped table-bordered" cellspacing="0" s>
            <tr>
                <td width="150"></td>
                <td width="200"></td>
                <td width="220">9,999,999,999</td>
                <td width="200">9,999,999,999</td>
                <td></td>
                <td></td>
            </tr>
        </table> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</font>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({
            "footerCallback": function(row, data, start, end, data) {
                var numFormat = $.fn.dataTable.render.number('\,', '.', 0).display;
                var api = this.api(),
                    data;

                // converting to interger to find total
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/Rp |,/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

            },

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "paging": true, //disable paging

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('laporan_barang_keluar/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_a = $('#tgl_a').val();
                    data.tgl_b = $('#tgl_b').val();
                    // alert($('#tgl_a').val());
                    $("#tanggal_a").val($('#tgl_a').val());
                    $("#tanggal_b").val($('#tgl_b').val());


                    //console.log(tgl_a);
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
        // $('#btn-reset').click(function(){ //button reset event click
        //     $('#form-filter')[0].reset();
        //     table.ajax.reload();  //just reload table
        // });

    });
</script>
<script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->