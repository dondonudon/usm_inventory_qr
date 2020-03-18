<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Master_stok_kasir_model extends CI_Model
{

    public $table = 'master_stok_kasir';
    public $id    = 'id_s_kasir';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // datatables
    public function json()
    {
        $this->datatables->select('id_s_kasir , nostokkasir, ket, id_user, datetime');
        $this->datatables->from('master_stok_kasir');
        //add this line for join
        //   $this->datatables->join('master_kasir', 'master_stok_kasir.kode_m_kasir = master_kasir.kode_m_kasir');
        //$this->datatables->join('tab_barang', 'master_stok_kasir.kode_barang = tab_barang.kode_barang');
        $this->datatables->add_column('action', anchor(site_url('master_stok_kasir/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'nostokkasir');

        return $this->datatables->generate();
    }

    // get all
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    public function total_rows($q = null)
    {
        $this->db->like('id_s_kasir', $q);
        $this->db->or_like('kode_m_kasir', $q);
        $this->db->or_like('kode_barang', $q);
        $this->db->or_like('stok', $q);
        $this->db->or_like('datetime', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_s_kasir', $q);
        $this->db->or_like('kode_m_kasir', $q);
        $this->db->or_like('kode_barang', $q);
        $this->db->or_like('stok', $q);
        $this->db->or_like('datetime', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        //INSERT LOG
        $data2 = array(
            'kode_m_kasir' => $data['kode_m_kasir'],
            'kode_barang'  => $data['kode_barang'],
            'qty'          => $data['stok'],
            'datetime'     => $data['datetime'],
            'tipe'         => 'B',
        );
        $this->db->insert('log', $data2);
        //END INSERT LOG

    }

    // update data
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    //get stok
    public function get_stok($kode_barang)
    {
        //$hsl1 = $this->db->query("SELECT ifnull(stok,0) as stok_gudang FROM tab_barang WHERE kode_barang='$kode_barang'");

        $hasil = array(
            'stok' => 0,
        );
        $hsl1 = $this->db->query("SELECT ifnull(stok,0) as stok_gudang FROM tab_barang WHERE kode_barang='$kode_barang'")->result();
        foreach ($hsl1 as $data1) {
            $hasil1 = array(
                'stok_gudang' => $data1->stok_gudang,
            );
            $hasil_baru = array_merge($hasil, $hasil1);
        }

        return $hasil_baru;
    }

    // delete data
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function barang_list()
    {
        $hasil = $this->db->query("SELECT tab_barang.nama, temp_master_stok_kasir.id_s_kasir, temp_master_stok_kasir.nostokkasir, temp_master_stok_kasir.kode_barang, temp_master_stok_kasir.stok, temp_master_stok_kasir.datetime FROM temp_master_stok_kasir INNER JOIN tab_barang ON tab_barang.kode_barang=temp_master_stok_kasir.kode_barang");
        return $hasil->result();
    }

    public function simpan_barang($kode_barang, $stok, $nostokkasir, $image_name, $datetime)
    {
        $hasil = $this->db->query("INSERT INTO temp_master_stok_kasir (nostokkasir,kode_barang,stok, qrcode,datetime)VALUES('$nostokkasir','$kode_barang','$stok','$image_name','$datetime')");
        return $hasil;
    }

    public function get_barang_by_kode($id_s_kasir)
    {
        $hsl = $this->db->query("SELECT tab_barang.nama, temp_master_stok_kasir.id_s_kasir, temp_master_stok_kasir.nostokkasir, temp_master_stok_kasir.kode_barang, temp_master_stok_kasir.stok, temp_master_stok_kasir.datetime FROM temp_master_stok_kasir INNER JOIN tab_barang ON tab_barang.kode_barang=temp_master_stok_kasir.kode_barang
                         WHERE temp_master_stok_kasir.id_s_kasir='$id_s_kasir'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'id_s_kasir' => $data->id_s_kasir,
                    'nama'       => $data->nama,
                    'stok'       => $data->stok,
                );
            }
        }
        return $hasil;
    }

    public function update_barang($stok, $id_s_kasir)
    {
        $hasil = $this->db->query("UPDATE temp_master_stok_kasir SET stok='$stok' WHERE id_s_kasir='$id_s_kasir'");
        return $hasil;
    }

    public function hapus_barang($id_s_kasir)
    {
        $hasil = $this->db->query("DELETE FROM temp_master_stok_kasir WHERE id_s_kasir='$id_s_kasir'");
        return $hasil;
    }
    public function insert_trans($notrans, $ket, $id_user, $image_name, $datetime)
    {

        //insert into master_stok_kasir
        $q3 = $this->db->query("INSERT into master_stok_kasir (nostokkasir, ket, id_user, qrcode, datetime) VALUES ('$notrans', '$ket', '$id_user','$image_name', '$datetime')");
        //insert into master_stok_kasir_detail
        $q4 = $this->db->query("INSERT into master_stok_kasir_detail (nostokkasir, kode_barang, stok, qrcode, datetime) SELECT nostokkasir, kode_barang, stok, qrcode, datetime FROM temp_master_stok_kasir WHERE nostokkasir = '$notrans'");
        //delete temp_master_stok_kasir
        $q5 = $this->db->query("DELETE FROM temp_master_stok_kasir WHERE nostokkasir='$notrans'");

        //INSERT LOG
        $log = $this->db->query("SELECT * FROM master_stok_kasir_detail WHERE nostokkasir = '$notrans'")->result_array();
        foreach ($log as $data) {
            $kode_barang = $data['kode_barang'];
            $ket         = $notrans;
            $qty         = $data['stok'];
            $datetime    = date('Y-m-d H:i:s');
            $this->db->query("INSERT INTO log (ket, kode_barang, qty, tipe, datetime) VALUES ('$ket', '$kode_barang', '$qty', 'B', '$datetime')");
        }
        //END INSERT LOG

        //UPDATE STOK BARANG
        $barang = $this->db->query("SELECT * FROM tab_barang WHERE kode_barang IN (SELECT kode_barang FROM master_stok_kasir_detail WHERE nostokkasir = '$notrans')")->result_array();
        foreach ($barang as $data2) {
            $kode_barang = $data2['kode_barang'];
            $_stok       = $data2['stok'];
            $stockopname = $this->db->query("SELECT nostokkasir, kode_barang, stok FROM master_stok_kasir_detail WHERE nostokkasir = '$notrans' AND kode_barang = '$kode_barang'")->row();

            $stok_akhir = $_stok - $stockopname->stok;
            $this->db->query("UPDATE tab_barang SET stok = '$stok_akhir' WHERE kode_barang = $kode_barang");
        }
        //UPDATE STOK BARANG

        //UPDATE COUNTER C
        $query    = $this->db->query("SELECT counter FROM counter WHERE id='C'");
        $ret      = $query->row();
        $_counter = $ret->counter;
        $_counter++;
        $query = $this->db->query("UPDATE counter SET counter = '$_counter' WHERE id='C'");
        //END UPDATE COUNTER C

    }
}
