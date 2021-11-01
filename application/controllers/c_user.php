<?php 
class c_user extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('Transaksi_model', 'Transaksi', TRUE);
		$this->load->model('Master_model', 'Master', TRUE);
		$this->load->model('Login_model', 'Login', TRUE);
	}
	public function index()
	{
		$this->add_form();
	}
	function cek_login()
	{
		if(($this->session->userdata('login_sta')!=TRUE) )
		{
			redirect();
		}
		else
		{
			$this->session->set_userdata('halaman','c_user');	
		}
	}
	
	function add_form()
	{
		$this->cek_login();	
		$data['main_view']='c_user'; //html pada view/c_user.php
		$data['form']=site_url('c_user/add_c_user');	//action pada button simpan
		$data['form2']=site_url('c_user/edit_c_user');	//action pada button simpan
		$data['form3']=site_url('c_user/delete_c_user');	//action pada button simpan
		$data['form4']=site_url('c_user/reset_c_user');	//action pada button simpan
		$data['userl']=$this->Login->list_user()->result();
		$this->load->view('c_user',$data);
	}
	function add_c_user()
	{
		$this->cek_login();
		$cek=$this->Login->get_akses2($this->input->post('username'))->result();
		if(count($cek)==0)
		{
			$form=array('nama' => $this->input->post('username'),
						'grup' => $this->input->post('grup'),
						'password' => md5($this->input->post('password')),
						);
			$this->Transaksi->add_form($form,'login');
			$this->session->set_flashdata('msg_user','Data Berhasih ditambahkan');
		}
		else
		{
			$this->session->set_flashdata('msg_user_fail','Data sudah ada. Tidak dapat ditambahkan');
		}
		redirect('c_user');
	}
	function edit_c_user()
	{
		$this->cek_login();
		$form=array(
					'grup' => $this->input->post('grup'),
					);
		$this->Transaksi->edit_form2($this->input->post('username'),$form,'login','nama');
		$this->session->set_flashdata('msg_user','Data Berhasih diupdate');

		redirect('c_user');
	}
	function reset_c_user()
	{
		$this->cek_login();
		$form=array(
					'password' => md5('123'),
					);
		$this->Transaksi->edit_form2($this->input->post('username'),$form,'login','nama');
		$this->session->set_flashdata('msg_user','Password Berhasih direset');

		redirect('c_user');
	}
	function delete_c_user()
	{
		$this->Transaksi->delete_form2($this->input->post('username'),'login','nama');
		$this->session->set_flashdata('msg_user','Data Berhasih dihapus');

		redirect('c_user');
	}
	function pass()
	{
		$this->cek_login();
		$data['username']=$this->session->userdata('nama_sta');
		$data['main_view']='c_user'; //html pada view/c_user.php
		$data['form']=site_url('c_user/ganti_pass');
		$this->load->view('pass',$data);
	}
	function ganti_pass()
	{
		$this->cek_login();
		$cek=$this->Login->get_akses($this->input->post('username'),md5($this->input->post('password')))->result();
		if(count($cek)>0)
		{
			$form=array(
					'password' =>md5($this->input->post('passwordb')),
					);
			$this->Transaksi->edit_form2($this->input->post('username'),$form,'login','nama');
			$this->session->set_flashdata('msg_user','Password Berhasih diubah');
		}
		else
		{
			$this->session->set_flashdata('msg_user_fail','Password tidak dapat diubah. Password lama salah');
		}
		redirect('c_user/pass');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
