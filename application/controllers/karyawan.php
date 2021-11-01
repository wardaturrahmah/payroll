<?php 
class karyawan extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('Transaksi_model', 'Transaksi', TRUE);
		$this->load->model('Master_model', 'Master', TRUE);
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
			$this->session->set_userdata('halaman','karyawan');	
		}
	}
	
	function add_form()
	{
		$this->cek_login();	
		$data['main_view']='karyawan'; //html pada view/karyawan.php
		$data['form']=site_url('karyawan/add_form');	//action pada button edit
		$data['form2']=site_url('karyawan/edit_karyawan');	//action pada button edit
		$data['form3']=site_url('karyawan/delete_karyawan');	//action pada button delete
		$dept=-1;
		$data['deptfal']=$dept;
		if($this->session->userdata('deptfal_kary')!='')
		{
			$dept=$this->session->userdata('deptfal_kary');
			$data['deptfal']=$dept;
		}
		if($this->input->post('dept')!='')
		{
			$dept=$this->input->post('dept');
			$data['deptfal']=$dept;
			
		}
		$data['karyawanl']=$this->Master->get_karyawan($dept)->result();
		$data['deptl']=$this->Master->get_departments()->result();

		$this->load->view('karyawan',$data);
	}
	
	function add_karyawan()
	{
		$this->cek_login();
		$form=array('DEPTNAME' => $this->input->post('karyawanname'),
					'SUPDEPTID' => $this->input->post('supkaryawanid'),
					);
		$this->Transaksi->add_form($form,'departments');
		$this->session->set_flashdata('msg_karyawan','Data Berhasih ditambahkan');

		redirect('karyawan');
	}
	function edit_karyawan()
	{
		$this->cek_login();
		$form=array('Badgenumber' => $this->input->post('badgenumber'),
					'Name' => $this->input->post('nama'),
					'DEFAULTDEPTID' => $this->input->post('deptid'),
					'Gender' => $this->input->post('gender'),
					'BIRTHDAY' => $this->input->post('birthday'),
					'HIREDDAY' => $this->input->post('hiredday'),
					'street' => $this->input->post('street'),
					'CardNo' => $this->input->post('CardNo'),
					'PAGER' => $this->input->post('PAGER'),
					'UPAH' => str_replace(".","",$this->input->post('UPAH')),
					'PREMI' => str_replace(".","",$this->input->post('PREMI')),
					'BPJS_KESEHATAN' => str_replace(".","",$this->input->post('BPJS_KESEHATAN')),
					'BPJS_KTN' => str_replace(".","",$this->input->post('BPJS_KTN')),
					'OPHONE' => $this->input->post('CUTI'),
					);
		$this->Transaksi->edit_form2($this->input->post('userid'),$form,'USERINFO','userid');
		$this->session->set_flashdata('msg_karyawan','Data Berhasih diupdate');

		redirect('karyawan');
	}
	function delete_karyawan()
	{
		$this->Transaksi->delete_form2($this->input->post('userid'),'USERINFO','userid');
		$this->session->set_flashdata('msg_karyawan_fail','Data Berhasih dihapus');

		redirect('karyawan');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
