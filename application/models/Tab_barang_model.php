<?php

if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

class Tab_barang_model extends CI_Model
{

  public $table = 'tab_barang';
  public $id    = 'kode_barang';
  public $order = 'DESC';

  public function __construct()
  {
    parent::__construct();
  }

  // datatables
  public function json()
  {
    $this->datatables->select('master_group.kode_group, master_group.nama_group, tab_barang.kode_barang, tab_barang.kode_group, tab_barang.nama, tab_barang.gambar, tab_barang.stok, tab_barang.keterangan, tab_barang.spesifikasi, tab_barang.merk, GROUP_CONCAT(stock_opname_detail.lokasi) as lokasi');
    $this->datatables->from('tab_barang');
    //add this line for join
    $this->datatables->join('master_group', 'tab_barang.kode_group = master_group.kode_group');
    $this->datatables->join('stock_opname_detail', 'stock_opname_detail.kode_barang = tab_barang.kode_barang', 'LEFT');
    // $this->datatables->group_by('tab_barang.kode_barang');
    $this->datatables->add_column('action', anchor(site_url('tab_barang/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
            " . anchor(site_url('tab_barang/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
                " . anchor(site_url('tab_barang/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_barang');
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

  public function get_by_kode($kode_barang)
  {
    $this->db->where('kode_barang', $kode_barang);
    return $this->db->get($this->table)->row();
  }

  // get total rows
  public function total_rows($q = null)
  {
    $this->db->like('kode_barang', $q);
    //   $this->db->like('kode_manual', $q);
    $this->db->or_like('kode_group', $q);
    $this->db->or_like('nama', $q);
    $this->db->or_like('gambar', $q);
    $this->db->or_like('stok', $q);
    $this->db->or_like('keterangan', $q);
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // get data with limit and search
  public function get_limit_data($limit, $start = 0, $q = null)
  {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('kode_barang', $q);
    $this->db->or_like('kode_group', $q);
    //   $this->db->or_like('kode_manual', $q);
    $this->db->or_like('nama', $q);
    $this->db->or_like('gambar', $q);
    $this->db->or_like('stok', $q);
    $this->db->or_like('keterangan', $q);
    $this->db->limit($limit, $start);
    return $this->db->get($this->table)->result();
  }

  // insert data
  public function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  // update data
  public function update($id, $data)
  {
    $this->db->where($this->id, $id);
    $this->db->update($this->table, $data);
  }

  // update data
  public function updateStok($id, $data)
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
}
