<div class="content-wrapper">
  <section class="content">
      <div class="row">
          <div class="col-xs-12">
              <div class="box box-warning box-solid">
                <div class="box-header">
                      <h3 class="box-title">ENTRY REKAP</h3>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table" id="mytable">
                      <thead>
                          <tr>
                            <th width="30px">No</th>
                            <th>Nama Barang</th>
                            <th>Saldo Awal</th>
                            <th>Transaksi</th>
                            <th>Sisa</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                          </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    responsive: true,
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },

                    processing: true,
                    serverSide: true,
                    ajax: {"url": "agen/json", "type": "POST"},
                    columns: [
                        {
                            "data": "kode_barang",
                            "orderable": false
                        },{"data": "nama"},{"data": "stok"}
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>
        <script type="text/javascript">
            <?php if ($this->session->flashdata('success')) {?>
                alert("<?php echo $this->session->flashdata('success'); ?>");
            <?php } else if ($this->session->flashdata('error')) {?>
                alert("<?php echo $this->session->flashdata('error'); ?>");
            <?php }?>
        </script>