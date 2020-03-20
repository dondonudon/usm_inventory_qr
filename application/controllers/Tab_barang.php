<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tab_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tab_barang_model');
        $this->load->library('form_validation');
        $this->session->set_flashdata('title', 'Data Barang | Inventory');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'tab_barang/tab_barang_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tab_barang_model->json();
    }

    public function read($id)
    {
        $row = $this->Tab_barang_model->get_by_id($id);
        if ($row) {
            $data = array(
                'kode_barang' => $row->kode_barang,
                // 'kode_manual' => $row->kode_manual,
                'merk'        => $row->merk,
                'spesifikasi' => $row->spesifikasi,
                'kode_group'  => $row->kode_group,
                'nama'        => $row->nama,
                'gambar'      => $row->gambar,
                'stok'        => $row->stok,
                'keterangan'  => $row->keterangan,
            );
            $this->template->load('template', 'tab_barang/tab_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tab_barang'));
        }
    }

    public function create()
    {
        $data = array(
            'button'      => 'Create',
            'action'      => site_url('tab_barang/create_action'),
            'kode_barang' => set_value('kode_barang'),
            // 'kode_manual' => set_value('kode_manual'),
            'spesifikasi' => set_value('spesifikasi'),
            'merk'        => set_value('merk'),
            'kode_group'  => set_value('kode_group'),
            'nama'        => set_value('nama'),
            'gambar'      => set_value('gambar'),
            'stok'        => set_value('stok'),
            'keterangan'  => set_value('keterangan'),
        );
        $this->template->load('template', 'tab_barang/tab_barang_form', $data);
    }

    public function create_action()
    {
        //get extension
        $name = $_FILES["gambar"]["name"];
        $tmp  = explode(".", $name);
        $ext  = end($tmp); # extra () to prevent notice

        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'kode_group'  => $this->input->post('kode_group', true),
                'nama'        => $this->input->post('nama', true),
                // 'kode_manual' => $this->input->post('kode_manual', true),
                'spesifikasi' => $this->input->post('spesifikasi', true),
                'merk'        => $this->input->post('merk', true),
                'gambar'      => 'b_' . time() . '.' . $ext,
                'keterangan'  => $this->input->post('keterangan', true),
                'datetime'    => date('Y-m-d H:i:s'),
            );

            //UPLOAD GAMBAR
            $config['upload_path']   = './upload/image';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['remove_space']  = true;
            $config['file_name']     = 'b_' . time() . '.' . $ext;
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            $this->upload->do_upload('gambar'); // Lakukan upload dan Cek jika proses upload berhasil

            $this->Tab_barang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tab_barang'));
        }
    }

    public function update($id)
    {
        $row = $this->Tab_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'      => 'Update',
                'action'      => site_url('tab_barang/update_action'),
                'kode_barang' => set_value('kode_barang', $row->kode_barang),
                'kode_group'  => set_value('kode_group', $row->kode_group),
                'nama'        => set_value('nama', $row->nama),
                // 'kode_manual' => set_value('kode_manual', $row->kode_manual),
                'spesifikasi' => set_value('spesifikasi', $row->spesifikasi),
                'merk'        => set_value('merk', $row->merk),
                'gambar'      => set_value('gambar', $row->gambar),
                'stok'        => set_value('stok', $row->stok),
                'keterangan'  => set_value('keterangan', $row->keterangan),
            );
            $this->template->load('template', 'tab_barang/tab_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tab_barang'));
        }
    }

    public function update_action()
    {
        $this->_rules();
        //get extension
        $name = $_FILES["gambar"]["name"];
        $tmp  = explode(".", $name);
        $ext  = end($tmp); # extra () to prevent notice

        if ($name != "") {
            $data = array(
                //'kode_group'  => $this->input->post('kode_group', true),
                'nama'       => $this->input->post('nama', true),
                // 'kode_manual' => $this->input->post('kode_manual', true),
                'merk'       => $this->input->post('merk', true),
                'spesifikasi' => $this->input->post('spesifikasi', true),
                'gambar'     => 'b_' . time() . '.' . $ext,
                'keterangan' => $this->input->post('keterangan', true),
                'datetime'   => date('Y-m-d H:i:s'),
            );
            $this->Tab_barang_model->update($this->input->post('kode_barang', true), $data);
            //UPLOAD GAMBAR
            $config['upload_path']   = './upload/image';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['remove_space']  = true;
            $config['file_name']     = 'b_' . time() . '.' . $ext;
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            $this->upload->do_upload('gambar');
        } else {
            $data = array(
                // 'kode_group'  => $this->input->post('kode_group', true),
                'nama'        => $this->input->post('nama', true),
                // 'kode_manual' => $this->input->post('kode_manual', true),
                'spesifikasi' => $this->input->post('spesifikasi', true),
                'merk'        => $this->input->post('merk', true),
                'keterangan'  => $this->input->post('keterangan', true),
                'datetime'    => date('Y-m-d H:i:s'),
            );
        }

        $this->Tab_barang_model->update($this->input->post('kode_barang', true), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('tab_barang'));
    }

    public function delete($id)
    {
        $row = $this->Tab_barang_model->get_by_id($id);

        if ($row) {
            $query = $this->db->query("SELECT stok FROM tab_barang WHERE kode_barang = '$id'")->row();
            if (is_null($query->stok) || $query->stok == 0) {
                $this->Tab_barang_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('tab_barang'));
            } else {
                $this->session->set_flashdata('error', 'Data tidak bisa dihapus karena masih ada stok');
                redirect(site_url('tab_barang'));
            }
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tab_barang'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_group', 'kode group', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        // $this->form_validation->set_rules('kode_manual', 'kode_manual', 'trim|required');
        $this->form_validation->set_rules('spesifikasi', 'spesifikasi', 'trim|required');
        $this->form_validation->set_rules('merk', 'merk', 'trim|required');
        //$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
        //$this->form_validation->set_rules('stok', 'stok', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('kode_barang', 'kode_barang', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile  = "tab_barang.xls";
        $judul     = "tab_barang";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Group");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Gambar");
        xlsWriteLabel($tablehead, $kolomhead++, "Stok");
        xlsWriteLabel($tablehead, $kolomhead++, "Spesifikasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Merk");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

        foreach ($this->Tab_barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->kode_barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->kode_group);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->gambar);
            xlsWriteNumber($tablebody, $kolombody++, $data->stok);
            xlsWriteLabel($tablebody, $kolombody++, $data->spesifikasi);
            xlsWriteLabel($tablebody, $kolombody++, $data->merk);
            xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}
