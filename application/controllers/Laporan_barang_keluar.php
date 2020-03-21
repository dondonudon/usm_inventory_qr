<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Laporan_barang_keluar extends CI_Controller
{

 public function __construct()
 {
  parent::__construct();
  $this->load->model('Laporan_barang_keluar_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Laporan Barang Keluar | Inventory');
  $this->load->library('datatables');
  $this->load->library('pdf');
  $this->load->library('pdfgenerator');
 }

 public function index()
 {
  //$this->load->view('kasir/kasir1/trans_list', $data);
  $this->template->load('template', 'laporan_barang_keluar');
 }

 public function ajax_list()
 {
  $list = $this->Laporan_barang_keluar_model->get_datatables();
  $data = array();
  $no   = $_POST['start'];
  $sum  = 0;
  foreach ($list as $customers) {
   $no++;
   $row   = array();
   $row[] = $no;
   $row[] = $customers->ket;
   //$row[]  = $customers->nama;
   // $row[]  = number_format($customers->jumlah);
   $row[]  = $customers->tanggal;
   $row[]  = '<a class="btn btn-sm btn-primary" href="' . base_url('upload/qr/' . $customers->qrcode) . '" title="Edit" target="_blank">QR</a>';
   $row[]  = '<a class="btn btn-sm btn-primary" href="' . base_url('laporan_barang_keluar/read/' . $customers->nostokkasir) . '" title="Edit" target="_blank">Detail</a>';
//    $row[]  = '<a class="btn btn-sm btn-primary" href="' . base_url('laporan_barang_keluar/print/' . $customers->nostokkasir) . '" title="Edit" target="_blank">Print</a>';
   $data[] = $row;

   // $sum += $customers->jumlah;
  }

  $output = array(
   "draw"            => $_POST['draw'],
   "recordsTotal"    => $this->Laporan_barang_keluar_model->count_all(),
   "recordsFiltered" => $this->Laporan_barang_keluar_model->count_filtered(),
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
  $this->template->load('template', 'barang_keluar_read', $data);
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
  $pdf->Cell(190, 7, 'LAPORAN BARANG KELUAR', 0, 1, 'C');
  // Memberikan space kebawah agar tidak terlalu rapat
  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(10, 6, 'No', 1, 0);
  $pdf->Cell(35, 6, 'No Transaksi', 1, 0);
  $pdf->Cell(60, 6, 'Nama Toko', 1, 0);
  $pdf->Cell(40, 6, 'Tanggal', 1, 1);
  $pdf->SetFont('Arial', '', 10);
  $nourut = 1;
  foreach ($this->Laporan_barang_keluar_model->excel($tanggal_a, $tanggal_b) as $data) {
   $pdf->Cell(10, 6, $nourut, 1, 0);
   $pdf->Cell(35, 6, $data->nota, 1, 0);
   $pdf->Cell(60, 6, $data->ket, 1, 0);
   $pdf->Cell(40, 6, $data->tanggal, 1, 1);
   $nourut++;
  }
  $pdf->Output();
 }

 public function print($nostokkasir)
 {
    $data = $this->db->query("SELECT
                                t.id_s_kasir,
                                t.nostokkasir,
                                t.ket,
                                t.tanggal,
                                t.nota,
                                td.stok,
                                td.alasan,
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
                                t.nostokkasir = '$nostokkasir'");
  $row = $data->row();
  $pdf       = new FPDF('l', 'mm', 'A5');
  // membuat halaman baru
  $pdf->AddPage();
  // setting jenis font yang akan digunakan
  $pdf->SetFont('Arial', 'B', 16);
  // mencetak string
  $pdf->Cell(190, 7, 'PAUD AN-NAHL PRESCHOOL - KAB. SEMARANG', 0, 1, 'C');
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(190, 7, 'LAPORAN TRANSAKSI BARANG KELUAR', 0, 1, 'C');
  $pdf->Cell(190, 6, $row->nostokkasir, 0, 0,'R');
  // Memberikan space kebawah agar tidak terlalu rapat
  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(40, 6, 'Nama Toko', 0, 0);
  $pdf->Cell(5, 6, ' : ', 0, 0);
  $pdf->Cell(40, 6, $row->ket, 0, 0);
  $pdf->Cell(40, 6, 'Tanggal', 0, 0);
  $pdf->Cell(5, 6, ' : ', 0, 0);
  $pdf->Cell(40, 6, $row->tanggal, 0, 1);
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->Cell(8, 6, 'No', 1, 0);
  $pdf->Cell(60, 6, 'Nama', 1, 0);
  $pdf->Cell(40, 6, 'QTY', 1, 0);
  $pdf->Cell(40, 6, 'Alasan', 1, 1);
  $nourut = 1;
  foreach ($data->result_array() as $isi) {
    $pdf->Cell(8, 6, $nourut, 1, 0);
    $pdf->Cell(60, 6, $isi['nama'], 1, 0);
    $pdf->Cell(40, 6, $isi['stok'], 1, 0);
    $pdf->Cell(40, 6, $isi['alasan'], 1, 0);
    $nourut++;
  }
  $pdf->Output();
 }

 public function report(){
    $tanggal_a = $_POST['tanggal_a'];
    $tanggal_b = $_POST['tanggal_b'];
    $data = array(
        'tanggal_a' =>$tanggal_a,
        'tanggal_b' =>$tanggal_b,
    );
    $this->pdfgenerator->setPaper('A4', 'landscape');
    $this->pdfgenerator->filename = "laporan-barang-keluar.pdf";
    $this->pdfgenerator->load_view('laporan_keluar_pdf', $data);
}

 public function excel()
 {
  $tanggal_a = $_POST['tanggal_a'];
  $tanggal_b = $_POST['tanggal_b'];

  $this->load->helper('exportexcel');
  $namaFile  = "Laporan_Barang_Keluar.xls";
  $judul     = "Laporan_Barang_Keluar";
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
  xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

  foreach ($this->Laporan_barang_keluar_model->excel($tanggal_a, $tanggal_b) as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteLabel($tablebody, $kolombody++, $data->nostokkasir);
   xlsWriteLabel($tablebody, $kolombody++, $data->ket);
   xlsWriteLabel($tablebody, $kolombody++, $data->datetime);

   $tablebody++;
   $nourut++;
  }

  xlsEOF();
  exit();
 }
}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-13 05:14:02 */
/* http://harviacode.com */
