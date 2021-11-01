<?php 
class libur extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('Transaksi_model', 'Transaksi', TRUE);
		$this->load->model('Master_model', 'Master', TRUE);
	}
	public function index()
	{
		setlocale(LC_TIME, 'id_ID.UTF8');
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
			$this->session->set_userdata('halaman','libur');
		}
	}
	function get_user()
	{
		$this->cek_login();
		$dept=$this->input->post('dept');
		$data=$this->Master->get_karyawan($dept)->result();
		echo json_encode($data);
	}
	function add_form()
	{
		$this->cek_login();	
		$this->session->set_flashdata('dept_libur',0);
		$data['main_view']='libur'; //html pada view/libur.php
		$data['form']=site_url('libur/add_libur');	//action pada button simpan
		$data['form2']=site_url('libur/edit_libur');	//action pada button simpan
		$data['form3']=site_url('libur/delete_libur');	//action pada button simpan
		$data['form4']=site_url('libur/');	//action pada button simpan
		$data['deptl']=$this->Master->get_departments_parent()->result();
		$data['tgl']=date('Y-m-d');
		$data['tgl1']=date('m/d/Y').' - '.date('m/d/Y');
		
		if($this->input->post('tgl_cari')!='')
		{
			$data['tgl1']=$this->input->post('tgl_cari');
			
		}
		$tgla=explode(' - ',$data['tgl1']);
		$tgl1=$tgla[0];
		$tgl2=$tgla[1];
		$this->session->set_userdata('tgl1_libur',$data['tgl1']);
		$data['liburl']=$this->Master->libur($tgl1,$tgl2)->result();
		$this->load->view('libur',$data);
	}
	function add_libur()
	{
		$this->cek_login();
		$id=$this->Master->no_libur()->row();
		if(count($id)>0)
		{
			$holidayid=$id->id+1;
		}
		else
		{
			$holidayid=1;
		}
		$tgl=$this->input->post('tgl');
		$nama=trim(str_replace("'","''",$this->input->post('libur')));
		$cek=$this->Master->cek_libur($nama,$tgl)->result();
		if(count($cek)==0)
		{
		$form=array('HOLIDAYID'=>$holidayid,
						'HOLIDAYNAME'=>trim(str_replace("'","''",$this->input->post('libur'))),
						'HOLIDAYYEAR'=>date('Y',strtotime($tgl)),
						'HOLIDAYMONTH'=>date('m',strtotime($tgl)),
						'HOLIDAYDAY'=>date('d',strtotime($tgl)),
						'STARTTIME'=>date('Y-m-d',strtotime($tgl)),
						'DURATION'=>1,
						'HOLIDAYTYPE'=>1,
						'XINBIE'=>1,
						'MINZU'=>1,
						'DeptID'=>1,
						
						);
		
		$this->Transaksi->add_form($form,'HOLIDAYS');
		$this->session->set_flashdata('msg_libur','Data Berhasih ditambahkan');
		}
		else
		{
			$this->session->set_flashdata('msg_libur_fail','Data tidak dapat ditambahkan. Data sudah ada');	
		}
		redirect('libur'); 
	}
	function edit_libur()
	{
		$this->cek_login();
		$tgl=$this->input->post('tgl');
		$nama=trim(str_replace("'","''",$this->input->post('libur')));
		$id=$this->input->post('id');
		$cek=$this->Master->cek_libur2($nama,$tgl,$id)->result();
		if(count($cek)==0)
		{
			$form=array(
						'HOLIDAYNAME'=>trim(str_replace("'","''",$this->input->post('libur'))),
						'STARTTIME'=>$this->input->post('tgl'),
						);		
		
		$this->Transaksi->edit_form2($this->input->post('id'),$form,'HOLIDAYS','HOLIDAYID');
		$this->session->set_flashdata('msg_libur','Data Berhasih diupdate');
		}
		else
		{
			$this->session->set_flashdata('msg_libur_fail','Data tidak dapat diupdate. Data sudah ada');	
		}
		redirect('libur');
	}
	function delete_libur()
	{
		$this->Transaksi->delete_form2($this->input->post('id'),'HOLIDAYS','HOLIDAYID');
		$this->session->set_flashdata('msg_libur_fail','Data Berhasih dihapus');

		redirect('libur');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
