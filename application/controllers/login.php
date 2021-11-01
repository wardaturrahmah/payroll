<?php
class login extends CI_Controller{
	function __construct() 
	{
        parent::__construct();
		$this->load->model('Login_model', '', TRUE);
	}
	function index()
	{
		$this->login();
	}
	function login()
	{
		$data['form_action']	= site_url('login/login_process'); //action diarahkan ke function login_process
		$this->load->view('login', $data);		
	}
	function login_process()
	{
		$username = $this->input->post('username'); //mengambil data username
		$password = md5($this->input->post('Password')); //mengambil data password
		if ($this->Login_model->check_user2($username, $password) == TRUE)//jika ada user dan pass di database
		{
			$login= $this->Login_model->get_akses2($username)->row();//mengambil data username tsb dari database
			$data = array('nama_sta' => $username, 'login_sta' => TRUE, 'group_sta' => $login->grup  );
			$this->session->set_userdata($data);//membuat session
			redirect('dept');//mengarahkan ke dept.php
		}
		else //jika tidak ada di db
		{
			$this->session->set_flashdata('message_login', 'account login anda tidak ada/salah');
			redirect()->back(); //kembali ke login.php
		}
	}
	
	function process_logout()
	{
		//$this->session->sess_destroy('login_sta');
		$data = array('nama_sta' => '', 'login_sta' => '', 'group_sta' => '','edit_sp' => '','edit_pkwt' => '','edit_region' => '','edit_depo' => '','edit_jabatan' => '','edit_karyawan' => '');
		$this->session->set_userdata($data);
		$this->session->sess_destroy();

		redirect('login');
	}
}