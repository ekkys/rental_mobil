<?php

//Pembimbing : Diki Alfarabi Hadi, Author WWW.MALASNGODING.COM 
// Model dibuat terstuktur agar bisa digunakan berulang kali untuk membuat CRUD. Jadi, dalam penggunaanya tinggal memanggil function, dan mendefinisikan $where nya apa? nama tabelnya apa?

defined('BASEPATH') OR exit('No direct script access allowed');

class M_rental extends CI_Model {

	//menampilkan data dari sebuah tabel
	function get_data($table)
	{
		return $this->db->get($table);
	}

	//menampilkan data sesuai nama tabel dan nilai tertentu
	function edit_data($where, $table)
	{
		return $this->db->get_where( $table, $where);
	} 

	 //menyimpan data baru ke database sesuai nama table dan data yang dibawa
	function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	 //memperbarui data di database sesuai nilai, data, dan nama tabel
	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	 //menghapus data di database sesuai nilai dan tabel
	function delete_data($where, $table)
	{
		$this->db->delete($table, $where);
	}
	
	function cek_login($where, $table){
		return $this->db->get_where($table,$where);
	}
	
}





/* End of file M_rental.php */
/* Location: ./application/models/M_rental.php */