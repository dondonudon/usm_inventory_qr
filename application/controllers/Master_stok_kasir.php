<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Master_stok_kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Master_stok_kasir_model');
        $this->load->model('Tab_barang_model');
        $this->load->library('form_validation');
        $this->session->set_flashdata('title', 'Barang Keluar | Inventory');
        $this->load->library('datatables');
    }

    // public function index()
    // {
    //     $this->template->load('template', 'master_stok_kasir/master_stok_kasir_list');
    // }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Master_stok_kasir_model->json();
    }

    public function read($nostokkasir)
    {
        $data = array('nostokkasir' => $nostokkasir);
        $this->template->load('template', 'master_stok_kasir/master_stok_kasir_read', $data);
    }

    public function index()
    {
        $this->template->load('template', 'master_stok_kasir/master_stok_kasir_form');
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
            $stok  = $_stok - $stok;
            if ($stok > 0) {
                $data2 = array(
                    'kode_barang' => $this->input->post('kode_barang', true),
                    'stok'        => $stok,
                );
                //END UPDATE STOK BARANG

                $data = array(
                    'kode_m_kasir' => $this->input->post('kode_m_kasir', true),
                    'kode_barang'  => $this->input->post('kode_barang', true),
                    'stok'         => $this->input->post('stok', true),
                    'datetime'     => date('Y-m-d H:i:s'),
                );

                $this->Master_stok_kasir_model->insert($data);
                $this->Tab_barang_model->updateStok($kode_barang, $data2);
                $this->session->set_flashdata('message', 'Create Record Success 2');
                redirect(site_url('master_stok_kasir'));
            } else {
                $this->session->set_flashdata('message', 'Stok tidak cukup');
                redirect(site_url('master_stok_kasir/create'));
            }
        }
    }

    public function update($id)
    {
        $row = $this->Master_stok_kasir_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'       => 'Update',
                'action'       => site_url('master_stok_kasir/update_action'),
                'id_s_kasir'   => set_value('id_s_kasir', $row->id_s_kasir),
                'kode_m_kasir' => set_value('kode_m_kasir', $row->kode_m_kasir),
                'kode_barang'  => set_value('kode_barang', $row->kode_barang),
                'stok'         => set_value('stok', $row->stok),
                'datetime'     => set_value('datetime', $row->datetime),
            );
            $this->template->load('template', 'master_stok_kasir/master_stok_kasir_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_stok_kasir'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id_s_kasir', true));
        } else {
            $data = array(
                'kode_m_kasir' => $this->input->post('kode_m_kasir', true),
                'kode_barang'  => $this->input->post('kode_barang', true),
                'stok'         => $this->input->post('stok', true),
                'datetime'     => $this->input->post('datetime', true),
            );

            $this->Master_stok_kasir_model->update($this->input->post('id_s_kasir', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_stok_kasir'));
        }
    }

    public function delete($id)
    {
        $row = $this->Master_stok_kasir_model->get_by_id($id);

        if ($row) {
            $this->Master_stok_kasir_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_stok_kasir'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_stok_kasir'));
        }
    }

    public function get_stok()
    {
        // $kode_m_kasir = $this->input->post('kode_m_kasir');
        $kode_barang = $this->input->post('kode_barang');
        $data        = $this->Master_stok_kasir_model->get_stok($kode_barang);
        echo json_encode($data);
    }

    public function data_barang()
    {
        $data = $this->Master_stok_kasir_model->barang_list();
        echo json_encode($data);
    }

    public function get_barang()
    {
        $id_s_kasir = $this->input->get('id');
        $data       = $this->Master_stok_kasir_model->get_barang_by_kode($id_s_kasir);
        echo json_encode($data);
    }

    public function simpan_barang()
    {
        $kode_barang = $this->input->post('kode_barang');
        $stok        = $this->input->post('stok');
        $nostokkasir = $this->input->post('nostokkasir');
        $datetime    = date('Y-m-d H:i:s');

        //QR CODE
        $q1 = $this->Tab_barang_model->get_by_id($kode_barang);
        $nama = $nostokkasir . time();
        $isi = "kode barang : $kode_barang 
                \n nama barang : $q1->nama 
                \n stok : $stok 
                \n tanggal : $datetime";
        $image_name = $nama . '.png';
        qrcode($nama, $isi);
        //END QR CODE

        $data        = $this->Master_stok_kasir_model->simpan_barang($kode_barang, $stok, $nostokkasir, $image_name, $datetime);
        echo json_encode($data);
    }

    public function update_barang()
    {
        $id_s_kasir = $this->input->post('id_s_kasir');
        $stok       = $this->input->post('stok');
        $data       = $this->Master_stok_kasir_model->update_barang($stok, $id_s_kasir);
        echo json_encode($data);
    }

    public function hapus_barang()
    {
        $id_s_kasir = $this->input->post('id_s_kasir');
        $data       = $this->Master_stok_kasir_model->hapus_barang($id_s_kasir);
        echo json_encode($data);
    }

    public function insert_trans()
    {
        $id_user  = $this->input->post('id_user');
        $notrans  = $this->input->post('nostokkasir');
        $ket      = $this->input->post('ket');
        $datetime = date('Y-m-d H:i:s');

        //QR CODE
        $nama = $notrans . time();
        $isi = "no transaksi : $notrans 
                \n tanggal : $datetime";
        $image_name = $nama . '.png';
        qrcode($nama, $isi);
        //END QR CODE

        $this->Master_stok_kasir_model->insert_trans($notrans, $ket, $id_user, $image_name, $datetime);
        //   $this->print($notrans);
        //   $this->session->set_flashdata('message', 'Create Record Success 2');
        redirect(base_url('master_stok_kasir'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_m_kasir', 'kode m kasir', 'trim|required');
        $this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
        $this->form_validation->set_rules('stok', 'stok', 'trim|required');
        // $this->form_validation->set_rules('datetime', 'datetime', 'trim|required');

        $this->form_validation->set_rules('id_s_kasir', 'id_s_kasir', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile  = "master_stok_kasir.xls";
        $judul     = "master_stok_kasir";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode M Kasir");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Stok");
        xlsWriteLabel($tablehead, $kolomhead++, "Min Stok");
        xlsWriteLabel($tablehead, $kolomhead++, "Datetime");

        foreach ($this->Master_stok_kasir_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->kode_m_kasir);
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
