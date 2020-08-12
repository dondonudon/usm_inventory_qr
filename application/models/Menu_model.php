<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Menu_model extends CI_Model
{

 public $table = 'tbl_menu';
 public $id    = 'id_menu';
 public $order = 'DESC';

 public function __construct()
 {
  parent::__construct();
 }

 // datatables
 public function json()
 {
  $this->datatables->select('id_menu,title,url,icon,is_main_menu,is_aktif');
  $this->datatables->from('tbl_menu');
  $this->datatables->add_column('is_aktif', '$1', 'rename_string_is_aktif(is_aktif)');
  //add this line for join
  //$this->datatables->join('table2', 'tbl_menu.field = table2.field');
  $this->datatables->add_column('action', anchor(site_url('kelolamenu/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
                " . anchor(site_url('kelolamenu/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_menu');
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
  $this->db->like('id_menu', $q);
  $this->db->or_like('title', $q);
  $this->db->or_like('url', $q);
  $this->db->or_like('icon', $q);
  $this->db->or_like('is_main_menu', $q);
  $this->db->or_like('is_aktif', $q);
  $this->db->from($this->table);
  return $this->db->count_all_results();
 }

 // get data with limit and search
 public function get_limit_data($limit, $start = 0, $q = null)
 {
  $this->db->order_by($this->id, $this->order);
  $this->db->like('id_menu', $q);
  $this->db->or_like('title', $q);
  $this->db->or_like('url', $q);
  $this->db->or_like('icon', $q);
  $this->db->or_like('is_main_menu', $q);
  $this->db->or_like('is_aktif', $q);
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

 // delete data
 public function delete($id)
 {
  $this->db->where($this->id, $id);
  $this->db->delete($this->table);
 }

}
