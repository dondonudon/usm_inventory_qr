<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stock_opname_model extends CI_Model
{

    public $table = 'stock_opname';
    public $id    = 'id_stock_opname';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // datatables
    public function json()
    {
        $this->datatables->select('stock_opname.id_stock_opname,stock_opname.nostockopname,stock_opname.ket,stock_opname.datetime');
        $this->datatables->from('stock_opname');
        //add this line for join
        //$this->datatables->join('tab_barang', 'stock_opname.kode_barang = tab_barang.kode_barang');
        //$this->datatables->add_column('action', anchor(site_url('stock_opname/retur/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'nostockopname');
        $this->datatables->add_column('action', anchor(site_url('stock_opname/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'nostockopname');
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
        $this->db->like('id_stock_opname', $q);
        $this->db->or_like('kode_barang', $q);
        $this->db->or_like('stok', $q);
        $this->db->or_like('ket', $q);
        $this->db->or_like('datetime', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_stock_opname', $q);
        $this->db->or_like('kode_barang', $q);
        $this->db->or_like('stok', $q);
        $this->db->or_like('ket', $q);
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
            'ket'         => $data['ket'],
            'kode_barang' => $data['kode_barang'],
            'qty'         => $data['stok'],
            'datetime'    => $data['datetime'],
            'tipe'        => 'A',
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

    // delete data
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    public function barang_list()
    {
        $hasil = $this->db->query("SELECT tab_barang.nama, temp_stock_opname.id_stock_opname, temp_stock_opname.nostockopname, temp_stock_opname.kode_barang, temp_stock_opname.stok, temp_stock_opname.harga, temp_stock_opname.jumlah, temp_stock_opname.datetime FROM temp_stock_opname INNER JOIN tab_barang ON tab_barang.kode_barang=temp_stock_opname.kode_barang");
        return $hasil->result();
    }

    public function simpan_barang($kode_barang, $stok, $harga, $nostockopname, $datetime, $image_name)
    {
        $jumlah = $stok * $harga;
        $hasil  = $this->db->query("INSERT INTO temp_stock_opname (nostockopname,kode_barang,stok, harga, jumlah, qrcode ,datetime)VALUES('$nostockopname','$kode_barang','$stok','$harga','$jumlah','$image_name','$datetime')");
        return $hasil;
    }

    public function get_barang_by_kode($id_stock_opname)
    {
        $hsl = $this->db->query("SELECT tab_barang.nama, temp_stock_opname.id_stock_opname, temp_stock_opname.nostockopname, temp_stock_opname.kode_barang, temp_stock_opname.stok, temp_stock_opname.harga, temp_stock_opname.datetime FROM temp_stock_opname INNER JOIN tab_barang ON tab_barang.kode_barang=temp_stock_opname.kode_barang
                         WHERE temp_stock_opname.id_stock_opname='$id_stock_opname'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'id_stock_opname' => $data->id_stock_opname,
                    'nama'            => $data->nama,
                    'stok'            => $data->stok,
                    'harga'           => $data->harga,
                );
            }
        }
        return $hasil;
    }

    public function update_barang($stok, $harga, $id_stock_opname)
    {
        $jumlah = $stok * $harga;
        $hasil  = $this->db->query("UPDATE temp_stock_opname SET stok='$stok', harga='$stok',jumlah='$jumlah' WHERE id_stock_opname='$id_stock_opname'");
        return $hasil;
    }

    public function hapus_barang($id_stock_opname)
    {
        $hasil = $this->db->query("DELETE FROM temp_stock_opname WHERE id_stock_opname='$id_stock_opname'");
        return $hasil;
    }

    public function insert_trans($notrans, $id_user, $ket, $image_name, $datetime)
    {
        $this->db->trans_start();

        $q0     = $this->db->query("SELECT SUM(jumlah) as jumlah FROM temp_stock_opname WHERE nostockopname = '$notrans'")->row();

        //insert into stock_opname
        $q1 = $this->db->query("INSERT into stock_opname (nostockopname, ket, id_user, jumlah, qrcode, datetime) VALUES ('$notrans','$ket', '$id_user',$q0->jumlah, '$image_name', '$datetime')");
        //insert into stock_opname_detail
        $q2 = $this->db->query("INSERT into stock_opname_detail (nostockopname, kode_barang, stok, harga, jumlah, qrcode, datetime) SELECT nostockopname, kode_barang, stok, harga, jumlah, qrcode, datetime FROM temp_stock_opname WHERE nostockopname = '$notrans'");
        //delete temp_stock_opname
        $q3 = $this->db->query("DELETE FROM temp_stock_opname WHERE nostockopname='$notrans'");

        //INSERT LOG
        $log = $this->db->query("SELECT * FROM stock_opname_detail WHERE nostockopname = '$notrans'")->result_array();
        foreach ($log as $data) {
            $kode_barang = $data['kode_barang'];
            $ket         = $notrans;
            $qty         = $data['stok'];
            $datetime    = date('Y-m-d H:i:s');
            $this->db->query("INSERT INTO log (ket, kode_barang, qty, tipe, datetime) VALUES ('$ket', '$kode_barang', '$qty', 'A', '$datetime')");
        }
        //END INSERT LOG

        //UPDATE STOK BARANG
        $barang = $this->db->query("SELECT * FROM tab_barang WHERE kode_barang IN (SELECT kode_barang FROM stock_opname_detail WHERE nostockopname = '$notrans')")->result_array();
        foreach ($barang as $data2) {
            $kode_barang = $data2['kode_barang'];
            $_stok       = $data2['stok'];
            $stockopname = $this->db->query("SELECT nostockopname, kode_barang, stok FROM stock_opname_detail WHERE nostockopname = '$notrans' AND kode_barang = '$kode_barang'")->row();

            $stok_akhir = $_stok + $stockopname->stok;
            $this->db->query("UPDATE tab_barang SET stok = '$stok_akhir' WHERE kode_barang = $kode_barang");
        }
        //UPDATE STOK BARANG

        //UPDATE COUNTER B
        $query    = $this->db->query("SELECT counter FROM counter WHERE id='B'");
        $ret      = $query->row();
        $_counter = $ret->counter;
        $_counter++;
        $query = $this->db->query("UPDATE counter SET counter = '$_counter' WHERE id='B'");
        //END UPDATE COUNTER B
        $this->db->trans_complete();
    }

    public function retur($nostockopname)
    {
        $q1 = $this->db->query("DELETE FROM stock_opname WHERE nostockopname = '$nostockopname'");
        $q2 = $this->db->query("DELETE FROM stock_opname_detail WHERE nostockopname = '$nostockopname'");
        $q3 = $this->db->query("DELETE FROM log WHERE ket = '$nostockopname'");
    }
}
