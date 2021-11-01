<?php 
class dept extends CI_Controller {

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
			$this->session->set_userdata('halaman','departemen');	
		}
	}
	
	function add_form()
	{
		
		$this->cek_login();	
		$data['main_view']='dept'; //html pada view/dept.php
		$data['form']=site_url('dept/add_dept');	//action pada button simpan
		$data['form2']=site_url('dept/edit_dept');	//action pada button simpan
		$data['form3']=site_url('dept/delete_dept');	//action pada button simpan
		$data['deptm']=$this->Master->get_departments()->result();
		$data['deptl']=$this->Master->get_departments_parent()->result();
		$this->load->view('dept',$data);
	}
	function add_dept()
	{
		$this->cek_login();
		$nama=trim($this->input->post('deptname'));
		$parent=$this->input->post('supdeptid');
		$cek=$this->Master->cek_depertemen($nama,$parent)->result();
		if(count($cek)==0)
		{
		$form=array('DEPTNAME' => trim($this->input->post('deptname')),
					'SUPDEPTID' => $this->input->post('supdeptid'),
					);
		$this->Transaksi->add_form($form,'departments');
		$this->session->set_flashdata('msg_dept','Data Berhasih ditambahkan');
		}
		else
		{
			$this->session->set_flashdata('msg_dept_fail','Data sudah ada. Tidak dapat ditambahkan');
		}
		redirect('dept');
	}
	function edit_dept()
	{
		$this->cek_login();
		$nama=trim($this->input->post('deptname'));
		$parent=$this->input->post('supdeptid');
		$deptid=$this->input->post('deptid');
		$cek=$this->Master->cek_depertemen2($nama,$parent,$deptid)->result();
		if(count($cek)==0)
		{
			$form=array('DEPTNAME' => trim($this->input->post('deptname')),
						'SUPDEPTID' => $this->input->post('supdeptid'),
						);
			$this->Transaksi->edit_form2($this->input->post('deptid'),$form,'departments','DEPTID');
			$this->session->set_flashdata('msg_dept','Data Berhasih diupdate');
		}
		else
		{
			$this->session->set_flashdata('msg_dept_fail','Data sudah ada. Tidak dapat diedit');
		}
		redirect('dept');
	}
	function delete_dept()
	{
		$this->Transaksi->delete_form2($this->input->post('deptid'),'departments','DEPTID');
		$this->session->set_flashdata('msg_dept_fail','Data Berhasih dihapus');

		redirect('dept');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
