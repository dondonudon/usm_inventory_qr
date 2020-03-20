<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Stock_opname extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  is_login();
  $this->load->model('Stock_opname_model');
  $this->load->model('Tab_barang_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Barang Masuk | Inventory');
  $this->load->library('datatables');
 }

 // public function index()
 // {
 //     $this->template->load('template', 'stock_opname/stock_opname_list');
 // }

 public function json()
 {
  header('Content-Type: application/json');
  echo $this->Stock_opname_model->json();
 }

 public function retur($nostockopname)
 {
  $this->Stock_opname_model->retur($nostockopname);
  redirect(site_url('stock_opname'));
 }

 public function read($nostockopname)
 {
  $data = array('nostockopname' => $nostockopname);

  $this->template->load('template', 'stock_opname/stock_opname_read', $data);
 }

 public function index()
 {
  $this->template->load('template', 'stock_opname/stock_opname_form');
 }

 public function create_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->index();
  } else {
   //START UPDATE STOK BARANG
   $kode_barang = $this->input->post('kode_barang', true);
   $stok        = $this->input->post('stok', true);
   $query       = $this->db->query("SELECT
                                        kode_barang, stok
                                    FROM
                                        tab_barang
                                    WHERE
                                        kode_barang = '$kode_barang'");
   $ret   = $query->row();
   $_stok = $ret->stok;
   $stok  = $stok + $_stok;
   $data2 = array(
    'kode_barang' => $this->input->post('kode_barang', true),
    'stok'        => $stok,
   );
   //END UPDATE STOK BARANG

   $data = array(
    'kode_barang' => $this->input->post('kode_barang', true),
    'stok'        => $this->input->post('stok', true),
    'ket'         => $this->input->post('ket', true),
    'datetime'    => date('Y-m-d H:i:s'),
   );
   $this->Tab_barang_model->updateStok($kode_barang, $data2);
   $this->Stock_opname_model->insert($data);
   $this->session->set_flashdata('message', 'Create Record Success 2');
   redirect(site_url('stock_opname'));
  }
 }

 public function update($id)
 {
  $row = $this->Stock_opname_model->get_by_id($id);

  if ($row) {
   $data = array(
    'button'          => 'Update',
    'action'          => site_url('stock_opname/update_action'),
    'id_stock_opname' => set_value('id_stock_opname', $row->id_stock_opname),
    'kode_barang'     => set_value('kode_barang', $row->kode_barang),
    'stok'            => set_value('stok', $row->stok),
    'ket'             => set_value('stok', $row->ket),
   );
   $this->template->load('template', 'stock_opname/stock_opname_form', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('stock_opname'));
  }
 }

 public function update_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->update($this->input->post('id_stock_opname', true));
  } else {
   $data = array(
    'kode_barang' => $this->input->post('kode_barang', true),
    'stok'        => $this->input->post('stok', true),
    'ket'         => $this->input->post('ket', true),
    'datetime'    => date('Y-m-d H:i:s'),
   );

   $this->Stock_opname_model->update($this->input->post('id_stock_opname', true), $data);
   $this->session->set_flashdata('message', 'Update Record Success');
   redirect(site_url('stock_opname'));
  }
 }

 public function delete($id)
 {
  $row = $this->Stock_opname_model->get_by_id($id);

  if ($row) {
   $this->Stock_opname_model->delete($id);
   $this->session->set_flashdata('message', 'Delete Record Success');
   redirect(site_url('stock_opname'));
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('stock_opname'));
  }
 }

 public function data_barang()
 {
  $data = $this->Stock_opname_model->barang_list();
  echo json_encode($data);
 }

 public function get_barang()
 {
  $id_stock_opname = $this->input->get('id');
  $data            = $this->Stock_opname_model->get_barang_by_kode($id_stock_opname);
  echo json_encode($data);
 }

 public function simpan_barang()
 {
  $kode_barang   = $this->input->post('kode_barang');
  $stok          = $this->input->post('stok');
  $harga         = $this->input->post('harga');
  $lokasi        = $this->input->post('lokasi');
  $tanggal       = $this->input->post('tanggal');
//   $nota          = $this->input->post('nota');
  $nostockopname = $this->input->post('nostockopname');
  $datetime      = date('Y-m-d H:i:s');

  //QR CODE
  $q1   = $this->Tab_barang_model->get_by_id($kode_barang);
  $nama = $nostockopname . time();
  $isi  = "Kode Barang      : $q1->kode_barang
        \n Nama Barang      : $q1->nama
        \n Stok             : $stok
        \n Harga            : $harga
        \n Lokasi           : $lokasi
        \n Tanggal Beli     : $tanggal";
  $image_name = $nama . '.png';
  qrcode($nama, $isi);
  //END QR CODE

  $data = $this->Stock_opname_model->simpan_barang($kode_barang, $stok, $harga, $lokasi, $nostockopname, $datetime, $image_name);
  echo json_encode($data);
 }

 public function update_barang()
 {
  $id_stock_opname = $this->input->post('id_stock_opname');
  $stok            = $this->input->post('stok');
  $harga           = $this->input->post('harga');
  $lokasi          = $this->input->post('lokasi');
  $data            = $this->Stock_opname_model->update_barang($stok, $harga, $lokasi, $id_stock_opname);
  echo json_encode($data);
 }

 public function hapus_barang()
 {
  $id_stock_opname = $this->input->post('id_stock_opname');
  $data            = $this->Stock_opname_model->hapus_barang($id_stock_opname);
  echo json_encode($data);
 }

 public function insert_trans()
 {
  $id_user  = $this->input->post('id_user');
  $notrans  = $this->input->post('nostockopname');
  $ket      = $this->input->post('ket');
//   $nota     = $this->input->post('nota');
  $tanggal  = $this->input->post('tanggal');
  $sumber   = $this->input->post('sumber');
  $datetime = date('Y-m-d H:i:s');

  //QR CODE
  $nama = $notrans . time();
  $isi  = "Nama Toko        : $ket
        \n Sumber dana      : $sumber
        \n Tanggal beli     : $tanggal";
  $image_name = $nama . '.png';
  qrcode($nama, $isi);
  //END QR CODE

  $this->Stock_opname_model->insert_trans($notrans, $id_user, $ket, $image_name, $tanggal, $sumber, $datetime);
  //   $this->print($notrans);
  //   $this->session->set_flashdata('message', 'Create Record Success 2');
  redirect(base_url('stock_opname'));
 }

 public function _rules()
 {
  $this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
  $this->form_validation->set_rules('stok', 'stok', 'trim|required');
  //$this->form_validation->set_rules('datetime', 'datetime', 'trim|required');

  $this->form_validation->set_rules('id_stock_opname', 'id_stock_opname', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile  = "stock_opname.xls";
  $judul     = "stock_opname";
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
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
  xlsWriteLabel($tablehead, $kolomhead++, "Stok");
  xlsWriteLabel($tablehead, $kolomhead++, "Datetime");

  foreach ($this->Stock_opname_model->get_all() as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteNumber($tablebody, $kolombody++, $data->kode_barang);
   xlsWriteNumber($tablebody, $kolombody++, $data->stok);
   xlsWriteLabel($tablebody, $kolombody++, $data->datetime);

   $tablebody++;
   $nourut++;
  }

  xlsEOF();
  exit();
 }
}
