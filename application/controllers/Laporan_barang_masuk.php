<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Laporan_barang_masuk extends CI_Controller
{

 public function __construct()
 {
  parent::__construct();
  $this->load->model('Laporan_barang_masuk_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Laporan Barang Masuk | Inventory');
  $this->load->library('datatables');
  $this->load->library('pdf');
  $this->load->library('pdfgenerator');
 }

 public function index()
 {
  //$this->load->view('kasir/kasir1/trans_list', $data);
  $this->template->load('template', 'laporan_barang_masuk');
 }

 public function ajax_list()
 {
  $list = $this->Laporan_barang_masuk_model->get_datatables();
  $data = array();
  $no   = $_POST['start'];
  $sum  = 0;
  foreach ($list as $customers) {
   $no++;
   $row   = array();
   $row[] = $no;
   //    $row[] = $customers->nostockopname;
   //$row[]  = $customers->nama;
   $row[] = number_format($customers->jumlah);
   $row[] = date_format(date_create($customers->tanggal), 'd/m/Y');
   $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('upload/qr/' . $customers->qrcode) . '" title="Edit" target="_blank">QR</a>';
   $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('laporan_barang_masuk/read/' . $customers->nostockopname) . '" title="Edit" target="_blank">Detail</a>';
   // $row[]  = '<a class="btn btn-sm btn-primary" href="' . base_url('laporan_barang_masuk/print/' . $customers->nostockopname) . '" title="Edit" target="_blank">Print</a>';
   $data[] = $row;

   $sum += $customers->jumlah;
  }

  $output = array(
   "draw"            => $_POST['draw'],
   "recordsTotal"    => $this->Laporan_barang_masuk_model->count_all(),
   "recordsFiltered" => $this->Laporan_barang_masuk_model->count_filtered(),
   "data"            => $data,
   "sum"             => $sum,
  );
  //output to json format
  echo json_encode($output);
 }

 public function read($notrans)
 {
  $data = array('notrans' => $notrans);
  //$this->load->view('kasir/kasir1/trans_read', $data);
  $this->template->load('template', 'barang_masuk_read', $data);
 }

 public function footer()
 {
  $tanggal_a = $_POST['tanggal_a'];
  $tanggal_b = $_POST['tanggal_b'];
 }

 public function pdf()
 {
  $tanggal_a = $_POST['tanggal_a'];
  $tanggal_b = $_POST['tanggal_b'];
  $pdf       = new FPDF('l', 'mm', 'A5');
  // membuat halaman baru
  $pdf->AddPage();
  // setting jenis font yang akan digunakan
  $pdf->SetFont('Arial', 'B', 16);
  // mencetak string
  $pdf->Cell(190, 7, 'PAUD AN-NAHL PRESCHOOL - KAB. SEMARANG', 0, 1, 'C');
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(190, 7, 'LAPORAN BARANG MASUK', 0, 1, 'C');
  // Memberikan space kebawah agar tidak terlalu rapat
  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->SetFont('Arial', 'B', 10);

  $pdf->Cell(10, 6, 'No', 1, 0);
  $pdf->Cell(20, 6, 'Nama Barang', 1, 0);
  $pdf->Cell(20, 6, 'Gambar', 1, 0);
  $pdf->Cell(20, 6, 'Lokasi', 1, 0);
  $pdf->Cell(20, 6, 'Sumber Dana', 1, 0);
  $pdf->Cell(20, 6, 'Tanggal Beli', 1, 0);
  $pdf->Cell(20, 6, 'Nama Toko', 1, 0);
  $pdf->Cell(20, 6, 'Jumlah', 1, 0);
  $pdf->Cell(20, 6, 'Harga', 1, 0);
  $pdf->Cell(20, 6, 'Subtotal', 1, 1);
  $pdf->SetFont('Arial', '', 10);
  $nourut = 1;
  foreach ($this->Laporan_barang_masuk_model->excel($tanggal_a, $tanggal_b) as $data) {
   $image = base_url() . 'upload/image/' . $data->gambar;
   $pdf->Cell(10, 6, $nourut, 1, 0);
   // $pdf->Cell(35, 6, $data->nostockopname, 1, 0);
   $pdf->Cell(20, 6, $data->nama_barang, 1, 0);
   $pdf->Cell(20, 6, $pdf->Image($image), 1, 0);
   $pdf->Cell(20, 6, $data->lokasi, 1, 0);
   $pdf->Cell(20, 6, $data->sumber, 1, 0);
   $pdf->Cell(20, 6, $data->tanggal, 1, 0);
   $pdf->Cell(20, 6, $data->ket, 1, 0);
   $pdf->Cell(20, 6, $data->qty, 1, 0);
   $pdf->Cell(20, 6, $data->harga, 1, 0);
   $pdf->Cell(20, 6, $data->jumlah, 1, 1);
   $nourut++;
  }

  $pdf->Output();
 }

 public function report()
 {
  $tanggal_a = $_POST['tanggal_a'];
  $tanggal_b = $_POST['tanggal_b'];
  $data      = array(
   'tanggal_a' => $tanggal_a,
   'tanggal_b' => $tanggal_b,
  );
  $this->pdfgenerator->setPaper('A4', 'landscape');
  $this->pdfgenerator->filename = "laporan-barang-masuk.pdf";
  $this->pdfgenerator->load_view('laporan_masuk_pdf', $data);
 }

 public function report1()
 {
  $tanggal_a = '';
  $tanggal_b = '';
  if (empty($tanggal_a) || empty($tanggal_b)) {
   $query = $this->db->query("SELECT *, tab_barang.nama as nama_barang, stock_opname_detail.stok as qty
                                        FROM stock_opname
                                        INNER JOIN stock_opname_detail ON stock_opname.nostockopname = stock_opname_detail.nostockopname
                                        INNER JOIN tab_barang ON tab_barang.kode_barang = stock_opname_detail.kode_barang");
  } else {
   $query = $this->db->query("SELECT *, tab_barang.nama as nama_barang, stock_opname_detail.stok as qty
                                        FROM stock_opname
                                        INNER JOIN stock_opname_detail ON stock_opname.nostockopname = stock_opname_detail.nostockopname
                                        INNER JOIN tab_barang ON tab_barang.kode_barang = stock_opname_detail.kode_barang
                                        WHERE stock_opname.tanggal BETWEEN '$tanggal_a' AND '$tanggal_b' ");
  }

  foreach ($query->result_array() as $isi) {
   print_r($isi);
  }

 }

 function print($nostockopname) {
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
                                t.nostockopname = '$nostockopname'");
  $row = $data->row();
  $pdf = new FPDF('l', 'mm', 'A5');
  // membuat halaman baru
  $pdf->AddPage();
  // setting jenis font yang akan digunakan
  $pdf->SetFont('Arial', 'B', 16);
  // mencetak string
  $pdf->Cell(190, 7, 'PAUD AN-NAHL PRESCHOOL - KAB. SEMARANG', 0, 1, 'C');
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(190, 7, 'LAPORAN TRANSAKSI BARANG MASUK', 0, 1, 'C');
  $pdf->Cell(190, 6, $row->nostockopname, 0, 0, 'R');
  // Memberikan space kebawah agar tidak terlalu rapat
  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(40, 6, 'Nama Toko', 0, 0);
  $pdf->Cell(5, 6, ' : ', 0, 0);
  $pdf->Cell(40, 6, $row->ket, 0, 0);
  $pdf->Cell(40, 6, 'Tanggal', 0, 0);
  $pdf->Cell(5, 6, ' : ', 0, 0);
  $pdf->Cell(40, 6, $row->tanggal, 0, 1);
  $pdf->Cell(40, 6, 'Jumlah', 0, 0);
  $pdf->Cell(5, 6, ' : ', 0, 0);
  $pdf->Cell(40, 6, $row->jumlah, 0, 0);
  $pdf->Cell(40, 6, 'Sumber', 0, 0);
  $pdf->Cell(5, 6, ' : ', 0, 0);
  $pdf->Cell(40, 6, $row->sumber, 0, 1);
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->Cell(8, 6, 'No', 1, 0);
  $pdf->Cell(40, 6, 'Nama', 1, 0);
  $pdf->Cell(40, 6, 'Lokasi', 1, 0);
  $pdf->Cell(20, 6, 'QTY', 1, 0);
  $pdf->Cell(40, 6, 'Harga', 1, 0);
  $pdf->Cell(40, 6, 'Subtotal', 1, 1);
  $nourut = 1;
  foreach ($data->result_array() as $isi) {
   $pdf->Cell(8, 6, $nourut, 1, 0);
   $pdf->Cell(40, 6, $isi['nama'], 1, 0);
   $pdf->Cell(40, 6, $isi['lokasi'], 1, 0);
   $pdf->Cell(20, 6, $isi['stok'], 1, 0);
   $pdf->Cell(40, 6, $isi['harga'], 1, 0);
   $pdf->Cell(40, 6, $isi['subtotal'], 1, 1);
   $nourut++;
  }
  $pdf->Output();
 }

 public function excel()
 {
  $tanggal_a = $_POST['tanggal_a'];
  $tanggal_b = $_POST['tanggal_b'];

  $this->load->helper('exportexcel');
  $namaFile  = "Laporan_Barang_Masuk.xls";
  $judul     = "Laporan_Barang_Masuk";
  $tablehead = 0;
  $tablebody = 1;
  $nourut    = 1;
  //penulisan header
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename=" . $namaFile . "");
  header("Content-Transfer-Encoding: binary ");

  xlsBOF();

  $kolomhead = 0;
  xlsWriteLabel($tablehead, $kolomhead++, "No");
  xlsWriteLabel($tablehead, $kolomhead++, "No Transaksi");
  xlsWriteLabel($tablehead, $kolomhead++, "Nama Toko");
  xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
  xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

  foreach ($this->Laporan_barang_masuk_model->excel($tanggal_a, $tanggal_b) as $data) {
   $kolombody = 0;
   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteLabel($tablebody, $kolombody++, $data->nostockopname);
   xlsWriteLabel($tablebody, $kolombody++, $data->ket);
   xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
   xlsWriteLabel($tablebody, $kolombody++, $data->datetime);

   $tablebody++;
   $nourut++;
  }

  xlsEOF();
  exit();
 }
}
