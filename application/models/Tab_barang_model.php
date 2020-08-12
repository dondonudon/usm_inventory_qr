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
  //select b.kode_group, b.nama_group, a.kode_barang, a.nama, a.gambar, a.stok, a.keterangan, a.spesifikasi, a.merk,GROUP_CONCAT(DISTINCT c.lokasi) as lokasi
	//from tab_barang a
	//inner join master_group b on a.kode_group=b.kode_group
	//left join stock_opname_detail c on a.kode_barang=c.kode_barang
	//where a.del=0
	//GROUP BY b.kode_group, b.nama_group, a.kode_barang, a.nama, a.gambar, a.keterangan, a.spesifikasi, a.merk
  public function json()
  {
    $this->datatables->select('b.kode_group, b.nama_group, a.kode_barang,b.kode_group, a.nama, a.gambar, a.stok, a.keterangan, a.spesifikasi, a.merk,GROUP_CONCAT(DISTINCT c.lokasi) as lokasi');
    $this->datatables->from('tab_barang a');
    //add this line for join
    $this->datatables->join('master_group b', 'a.kode_group=b.kode_group');
    $this->datatables->join('stock_opname_detail c', 'a.kode_barang=c.kode_barang', 'LEFT');
    $this->datatables->where('a.del =', 0);
    $this->datatables->group_by('b.kode_group, b.nama_group, a.kode_barang, a.nama, a.gambar, a.keterangan, a.spesifikasi, a.merk');
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
    $this->db->query("UPDATE tab_barang SET del = 1 WHERE $this->id = '$id'");
    // $this->db->where($this->id, $id);
    // $this->db->delete($this->table);
  }
}
