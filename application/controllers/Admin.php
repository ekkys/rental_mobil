<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		//cek login agar aman dari pembobolan melalui
		if ($this->session->userdata('status') != "login") {
			redirect(base_url('login?pesan=belumlogin'));
		}
		//Do your magic here
	}

	function index()
	{

		//mengambil data dari db pertabel hanya 10 baris saja
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi ORDER BY transaksi_id DESC LIMIT 10")->result();
		$data['kostumer'] = $this->db->query("SELECT * FROM kostumer ORDER BY kostumer_id DESC LIMIT 10")->result();
		$data['mobil'] = $this->db->query("SELECT * FROM mobil ORDER BY mobil_id DESC LIMIT 10")->result();
		//ini viewnya
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_index', $data);
		$this->load->view('admin/v_footer');

	}

	function logout()
	{
		//mengakhiri session lalu direct ke halaman login dengan membawa notif logout
		$this->session->sess_destroy();
		redirect(base_url('login?pesan=logout'));
	}

	function ganti_password()
	{
		//load view form ganti password
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_ganti_password');
		$this->load->view('admin/v_footer');
	}

	function ganti_password_aksi()
	{
		//menampung  input password
		$pass_baru = $this->input->post('pass_baru');
		$ulang_pass = $this->input->post('ulang_pass');

		//validasi isian apakah sudah sesuai rules dan aman
		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass', 'Ulangi Password Baru', 'required');

		
		if ($this->form_validation->run() != false) {

			$data = array(
				'admin_password' => md5($pass_baru)
			);
			$w = array(
				'admin_id' => $this->session->userdata('id')
			);

			//update password di db sesuai id yang ditangkap
			$this->m_rental->update_data($w, $data, 'admin');
			redirect(base_url('admin/ganti_password?pesan=berhasil'));

		}else{
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_ganti_password');
			$this->load->view('admin/v_footer');
		}

	}

	//CRUD Mobil
	function mobil(){
		//menampilkan all data mobil 
		$data['mobil']= $this->m_rental->get_data('mobil')->result();
		//viewnya
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_mobil',$data);
		$this->load->view('admin/v_footer');
	}

	function mobil_tambah(){
		//form tambah data mobil
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_mobil_tambah');
		$this->load->view('admin/v_footer');
	}

	function mobil_tambah_aksi(){
		//menampung inputan
		$merk = $this->input->post('merk');
		$plat = $this->input->post('plat');
		$warna = $this->input->post('warna');
		$tahun = $this->input->post('tahun');
		$status = $this->input->post('status');

		//cek validasi
		$this->form_validation->set_rules('merk','Merk Mobil','required');
		$this->form_validation->set_rules('status','Status Mobil','required');

		if ($this->form_validation->run() != false) {
			$data = array(
				'mobil_merk' => $merk,
				'mobil_plat' => $plat,
				'mobil_warna' => $warna,
				'mobil_tahun' => $tahun,
				'mobil_status' => $status
			);
			//insert ke db lalu redirect ke v_mobil
			$this->m_rental->insert_data($data, 'mobil');
			redirect(base_url('admin/mobil'));

		}else{
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_mobil');
			$this->load->view('admin/v_footer');
		}
	}

	function mobil_edit($id){
		//menampung id
		$where = array('mobil_id' => $id );

		//menampilkan data sesuai id di view edit
		$data['mobil'] = $this->m_rental->edit_data($where,'mobil')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_mobil_edit',$data);
		$this->load->view('admin/v_footer'); 
	}

	function mobil_update(){
		//menampung data
		$id = $this->input->post('id');
		$merk = $this->input->post('merk');
		$plat = $this->input->post('plat');
		$warna = $this->input->post('warna');
		$tahun = $this->input->post('tahun');
		$status = $this->input->post('status');

		//cek validasi
		$this->form_validation->set_rules('merk', 'Merk Mobil', 'required');
		$this->form_validation->set_rules('status', 'Status Mobil', 'required');

		if ($this->form_validation->run() != false) {
			$where = array('mobil_id' => $id );

			$data = array(
				'mobil_merk' => $merk,
				'mobil_plat' => $plat,			
				'mobil_warna' => $warna,			
				'mobil_tahun' => $tahun,			
				'mobil_status' => $status
			);

			//update ke database dan redirect ke v_mobil
			$this->m_rental->update_data($where, $data, 'mobil');
			redirect(base_url('admin/mobil'));
		}else{
			$where = array('mobil_id' => $id );

			$data['mobil'] = $this->m_rental->edit_data($where, 'mobil');
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_mobil_edit',$data);
			$this->load->view('admin/v_footer');
		}
	}

	function mobil_hapus($id)
	{
		$where = array('mobil_id'=>$id);

		$this->m_rental->delete_data($where, 'mobil');
		redirect(base_url('admin/mobil'));
	}
	//Akhir CRUD Mobil 

	//CRUD Kostumer
	function kostumer(){	
		//mengambil data dari database
		$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();

		//viewnya
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_kostumer', $data);
		$this->load->view('admin/v_footer');
	}

	function kostumer_tambah(){
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_kostumer_tambah');
		$this->load->view('admin/v_footer');	
	}

	function kostumer_tambah_aksi(){
		//menampung inputan dari elemen form
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$jk	= $this->input->post('jk');
		$hp = $this->input->post('hp');
		$ktp = $this->input->post('ktp');
		//validasi
		$this->form_validation->set_rules('nama','nama', 'required');


		if ($this->form_validation->run() != false) {
			//tampung data ke array
			$data = array(
				'kostumer_nama' =>$nama , 
				'kostumer_alamat' =>$alamat , 
				'kostumer_jk' => $jk , 
				'kostumer_hp' => $hp ,
				'kostumer_ktp' => $ktp 
			);

			//insert ke database
			$this->m_rental->insert_data($data, 'kostumer');
			redirect(base_url('admin/kostumer'));
		}else{
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_kostumer_tambah');
			$this->load->view('admin/v_footer');
		}
	}


	function kostumer_edit($id){
		//menampung id yang ditangkap url
		$where = array('kostumer_id'=>$id);

		//mengambil data sesuai id
		$data['kostumer'] = $this->m_rental->edit_data($where, 'kostumer')->result();

		$this->load->view('admin/v_header');
		$this->load->view('admin/v_kostumer_edit',$data);
		$this->load->view('admin/v_footer');
	}

	function kostumer_update(){
		//menampung inputan dari form edit
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$jk	= $this->input->post('jk');
		$hp = $this->input->post('hp');
		$ktp = $this->input->post('ktp');

		//validasi
		$this->form_validation->set_rules('nama','nama', 'required');

		if ($this->form_validation->run() != false) {
			
			//menampung id
			$where = array('kostumer_id' => $id );

			//menampung data yang dieit
			$data = array(
				'kostumer_nama' => $nama,
				'kostumer_alamat' => $alamat,
				'kostumer_jk' => $jk,
				'kostumer_hp' => $hp,
				'kostumer_ktp' => $ktp
			);

			//update ke database sesuai id yng ditangkap
			$this->m_rental->update_data($where, $data, 'kostumer');
			redirect(base_url('admin/kostumer'));
		}else{
					//menampung id yang ditangkap url
			$where = array('kostumer_id' => $id);

		//mengambil data sesuai id
			$data['kostumer'] = $this->m_rental->edit_data($where, 'kostumer')->result();

			$this->load->view('admin/v_header');
			$this->load->view('admin/v_kostumer_edit',$data);
			$this->load->view('admin/v_footer');
		}
	}

	function kostumer_hapus($id){
		$where = array('kostumer_id' => $id );

		$this->m_rental->delete_data($where, 'kostumer');
		redirect(base_url('admin/kostumer'));
	}
	//Akhir CRUD Kostumer


	//CRUD Transaksi
	function transaksi(){
		//mengambil seluruh data transaksi dari db
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi, mobil, kostumer WHERE transaksi_mobil =  mobil_id AND transaksi_kostumer = kostumer_id")->result();
		//viewnya
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_transaksi',$data);
		$this->load->view('admin/v_footer');
	}

	function transaksi_tambah(){
		//mengambil data mobil berstatus 1(tersedia) dan mengambil all data kostumer
		$w  = array('mobil_status' => '1' );
		$data['mobil'] = $this->m_rental->edit_data($w, 'mobil')->result();
		$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();

		//viewnya
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_transaksi_tambah',$data);
		$this->load->view('admin/v_footer');
	}

	function transaksi_tambah_aksi(){
		//menmapung inputan dari form
		$kostumer = $this->input->post('kostumer');
		$mobil = $this->input->post('mobil');
		$tgl_pinjam = $this->input->post('tgl_pinjam');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$harga = $this->input->post('harga');
		$denda = $this->input->post('denda');

		//validasi
		$this->form_validation->set_rules('kostumer','Kostumer','required');
		$this->form_validation->set_rules('mobil','Mobil','required');
		$this->form_validation->set_rules('tgl_pinjam','Tanggal Pinjam','required');
		$this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
		$this->form_validation->set_rules('harga','Harga','required');
		$this->form_validation->set_rules('denda','Denda','required');

		//cek dan tampung data dalam array

		if ($this->form_validation->run() != false) {
			$data = array(
				'transaksi_karyawan' => $this->session->userdata('id'),
				'transaksi_kostumer' => $kostumer,
				'transaksi_mobil' => $mobil,
				'transaksi_tgl_pinjam' => $tgl_pinjam,
				'transaksi_tgl_kembali' => $tgl_kembali,
				'transaksi_harga' => $harga,
				'transaksi_denda' => $denda,
				'transaksi_tgl' => date('Y-m-d')
			);

			//insert ke database
			$this->m_rental->insert_data($data, 'transaksi');

			//update status mobil
			$d = array('mobil_status' => '2' );

			//where id dari $mobil yang mengambi mobil_id dari  value form
			$w = array('mobil_id' => $mobil );
			$this->m_rental->update_data($w, $d, 'mobil');

			redirect(base_url('admin/transaksi'));

		}else{

			$w = array('mobil_status'=>'1');
			$data['mobil'] = $this->m_rental->edit_data($w,'mobil')->result();
			$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();

			$this->load->view('admin/v_header');
			$this->load->view('admin/v_transaksi_tambah',$data);
			$this->load->view('admin/v_footer');

		} 

	}

	function transaksi_hapus($id){
		//menmapung id
		$where = array('transaksi_id' => $id );

		// mengacek data sesuai id untuk update status mobil
		$data = $this->m_rental->edit_data($where, 'transaksi')->row();

		//mengambil id mobil dari data transaksi sesuai id
		$where2 = array('mobil_id' =>  $data->transaksi_mobil );

		//ubah status jadi 1 = tersedia
		$data2  = array('mobil_status' => '1' );

		//update ke database status mobil
		$this->m_rental->update_data($where2, $data2, 'mobil');

		//menghapus transaksi
		$this->m_rental->delete_data($where, 'transaksi');		


		redirect(base_url('admin/transaksi'));
	}

	function transaksi_selesai($id){
		//ambil data mobil, kostumer, dan transaksi
		$data['mobil'] = $this->m_rental->get_data('mobil')->result();
		$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi, mobil, kostumer WHERE transaksi_mobil =  mobil_id AND transaksi_kostumer=kostumer_id  AND transaksi_id ='$id'")->result();

		//viewnya
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_transaksi_selesai',$data);
		$this->load->view('admin/v_footer');

	}

	function transaksi_selesai_aksi(){
		// menampung inputan dari form
		$id = $this->input->post('id');
		$tgl_dikembalikan = $this->input->post('tgl_dikembalikan');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$mobil = $this->input->post('mobil');
		$denda = $this->input->post('denda');

		// validasi
		$this->form_validation->set_rules('tgl_dikembalikan','Tanggal
			Di Kembalikan','required');

		if ($this->form_validation->run() != false) {
			//menghitung selisih hari
			$batas_kembali = strtotime($tgl_kembali);
			$dikembalikan  = strtotime($tgl_dikembalikan);
			//abs() untuk membulatkan bilangan
			$selisih = abs(($batas_kembali - $dikembalikan) / (60*60*24) );

			$total_denda = $denda * $selisih;

			//update status transaksi 
			$data = array(
				'transaksi_tgldikembalikan' => $tgl_dikembalikan,
				'transaksi_status' => '1',
				'transaksi_haritelat' => $selisih,
				'transaksi_totaldenda' => $total_denda

			);

			// var_dump($data);die();

			$where = array('transaksi_id' => $id );

			//update transaksi ke database
			$this->m_rental->update_data($where, $data, 'transaksi');


			// update status mobil -> 1 = tersedia ke db
			$data2 = array('mobil_status' => '1');
			$where2 = array('mobil_id' => $mobil);

			$this->m_rental->update_data($where2, $data2, 'mobil');
			redirect(base_url('admin/transaksi'));
		}else{

			//ambil data dari db
			$data['mobil'] = $this->m_rental->get_data('mobil')->result();
			$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();
			$data['transaksi'] = $this->db->query("SELECT * FROM transaksi,mobil,kostumer WHERE transaksi_mobil=mobil_id AND transaksi_kostumer=kostumer_id AND transaksi_id='$id'")->result();
			//viewnya
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_transaksi_selesai',$data);
			$this->load->view('admin/v_footer');
		}
	}
	//Akhir CRUD Transaksi

	// LAPORAN
	function laporan(){
		//menampung input 
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		// validasi
		$this->form_validation->set_rules('dari','Dari Tanggal','required');
		$this->form_validation->set_rules('sampai','Sampai Tanggal','required');

		if ($this->form_validation->run() != false) {
			
			//ambil data sesuai filter
			$data['laporan'] = $this->db->query("SELECT * FROM transaksi,mobil,kostumer WHERE transaksi_mobil=mobil_id AND
				transaksi_kostumer=kostumer_id AND date(transaksi_tgl) >= '$dari'")->result();

			// view
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_laporan_filter',$data);
			$this->load->view('admin/v_footer');

		}else{
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_laporan');
			$this->load->view('admin/v_footer');
		}

	}

	function laporan_print(){
		//menampung range tanggal laporan
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');
		if($dari != "" && $sampai != ""){
			$data['laporan'] = $this->db->query("SELECT * FROM
				transaksi,mobil,kostumer WHERE transaksi_mobil=mobil_id AND transaksi_kostumer=kostumer_id AND date(transaksi_tgl) >= '$dari'")->result();
			$this->load->view('admin/v_laporan_print',$data);
		}else{
			redirect("admin/laporan");
		}
	}

	function laporan_pdf1(){
		//load lib dompdf 
		$this->load->library('pdf');

		//menampung range tanggal laporan
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		//mengambil data sesuai tanggal
		$data['laporan'] = $this->db->query("SELECT * FROM transaksi,mobil,kostumer WHERE transaksi_mobil=mobil_id AND transaksi_kostumer=kostumer_id AND date(transaksi_tgl) >= '$dari'")->result();

		//viewnya
		$this->load->view('admin/v_laporan_pdf', $data);

		$paper_size = 'A4'; // ukuran kertas
		$orientation = 'landscape'; //tipe format kertas potrait ataulandscape
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
//Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_rental_mobil.pdf", array('Attachment'=>0));
// nama file pdf yang di hasilkan
	}

	public function laporan_pdf(){

		
		//menampung range tanggal laporan
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		//mengambil data sesuai tanggal
		$data['laporan'] = $this->db->query("SELECT * FROM transaksi,mobil,kostumer WHERE transaksi_mobil=mobil_id AND transaksi_kostumer=kostumer_id AND date(transaksi_tgl) >= '$dari'")->result();

		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan_transaksi.pdf";
		$this->pdf->load_view('admin/v_laporan_pdf', $data);


	}

}

/* End of file Admin.php */
	/* Location: ./application/controllers/Admin.php */