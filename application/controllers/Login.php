<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_rental');
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	function login_aksi()
	{
		//menampung inputan username dan password
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//cek apakah sudah diisi semua dan menampung data yaang aman dan valid
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		//Cek kondisi
		if ($this->form_validation->run() != false) 
		{

			$where = array(
				'admin_username' => $username,
				'admin_password' => md5($password)
			);

			//cek ketersediaan data dan $data mengambil data jika ada
			$data = $this->m_rental->edit_data($where, 'admin');
			$d  = $this->m_rental->edit_data($where, 'admin')->row();
			$cek = $data->num_rows();
			if ($cek > 0) 
			{
				//membuat session dari $data yang ditemukan
				$session = array(
					'id' => $d->admin_id ,
					'nama' => $d->admin_nama,
					'status' => 'login'
				);

				//menjalankan fungsi session sesuai data
				$this->session->set_userdata($session);
				redirect(base_url('admin'));
			}else{
				redirect(base_url('login?pesan=gagal'));
			}
		}else{
			$this->load->view('v_login');
		}


	}

	

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */