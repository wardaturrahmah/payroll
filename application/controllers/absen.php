<?php 
class absen extends CI_Controller {

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
			$this->session->set_userdata('halaman','absen');	
		}
	}
	
	function add_form()
	{
		$this->cek_login();	
		$data['main_view']='absen'; //html pada view/karyawan.php
		$data['form']=site_url('absen');	//action pada button edit
		$data['form2']=site_url('absen/edit_absen');	//action pada button edit
		$data['form3']=site_url('absen/delete_absen');	//action pada button delete
		$dept=-1;
		$data['deptfal']=$dept;
		$tgl = date("Y-m-d");
		$tgl2 = date("Y-m-d", strtotime('+1 day', strtotime($tgl)));
		$data['tgl']=$tgl;
		$data['tgl2']=$tgl2;
		if($this->session->userdata('deptfal_absen')!='')
		{
			$dept=$this->session->userdata('deptfal_absen');
			$data['deptfal']=$dept;
		}
		if($this->input->post('dept')!='')
		{
			$dept=$this->input->post('dept');
			$data['deptfal']=$dept;
			
		}
		if($this->input->post('tgl')!='')
		{
			$tgl=$this->input->post('tgl');
			$tgl2 = date("Y-m-d", strtotime('+1 day', strtotime($tgl)));
			$data['tgl']=$tgl;
			$data['tgl2']=$tgl2;
			
		}
		if($this->session->flashdata('tgl_absen')!='')
		{
			$tgl = date("Y-m-d",strtotime($this->session->flashdata('tgl_absen')));
			$tgl2 = date("Y-m-d", strtotime('+1 day', strtotime($tgl)));
			$data['tgl']=$tgl;
			$data['tgl2']=$tgl2;
		}
		$approve=$this->Transaksi->approve_absen($dept,$tgl,$tgl)->result();
		$data['cek']=count($approve);
		if($data['cek']==0)
		{
		$data['absenl']=$this->Master->get_absen($dept,$tgl,$tgl2)->result();
		}
		else
		{
			$data['absenl']=$approve;
		}
		$data['deptl']=$this->Master->get_departments()->result();
		$this->load->view('absen',$data);
	}
	
	function edit_absen()
	{
		$USERID=$this->input->post('USERID');
		$CHECKTIME=$this->input->post('CHECKTIME');
		$type_absen=$this->input->post('type_absen');
		$USER=$this->input->post('USER');
		$dateCustom=$this->input->post('dateCustom');
		$type_custom=$this->input->post('type_custom');
		$tgl=$this->input->post('tgl');
		
		for($i=0;$i<count($USERID);$i++)
		{
			/* echo $USERID[$i];
			echo $CHECKTIME[$i];
			echo $type_absen[$i];
			echo '<br>'; */
			$form2=array(
				'CHECKTYPE'	=> $type_absen[$i]
				);
			$id=array('USERID'	=> $USER
				,'CHECKTIME' => $CHECKTIME[$i]);
			
			$this->Transaksi->edit_form3($id,$form2,'CHECKINOUT');
		}
		if(!empty($dateCustom))
		{
		$form=array(
			'USERID'	=> $USER,
			'CHECKTIME'	=>	date("Y-m-d H:i:s",strtotime($dateCustom)),
			'CHECKTYPE'	=> $type_custom,
			'VERIFYCODE'	=> 1,
			'SENSORID'	=>1,
			'WorkCode'	=>1,
			'UserExtFmt'	=>0
			);
			$this->Transaksi->add_form($form,'CHECKINOUT');
		}
			$this->session->set_flashdata('msg_absen','Data Berhasih diupdate');
			$this->session->set_flashdata('tgl_absen',$tgl);
			redirect('absen');
	}
	function delete_absen()
	{
		$this->Transaksi->delete_form2($this->input->post('absenid'),'departments','DEPTID');
		$this->session->set_flashdata('msg_absen_fail','Data Berhasih dihapus');

		redirect('absen');
	}
	
	function approved()
	{		
		$arrno=explode(',',$this->input->post('arrno'));
		$arruserid=explode(',',$this->input->post('arruserid'));
		$arrbadgenumber=explode(',',$this->input->post('arrbadgenumber'));
		$arrname=explode(',',$this->input->post('arrname'));
		$arrdeptid=explode(',',$this->input->post('arrdeptid'));
		$arrdeptname=explode(',',$this->input->post('arrdeptname'));
		$arrtgl=explode(',',$this->input->post('arrtgl'));
		$arrpa=explode(',',$this->input->post('arrpa'));
		$arrin=explode(',',$this->input->post('arrin'));
		$arrout=explode(',',$this->input->post('arrout'));
		$arrstdin=explode(',',$this->input->post('arrstdin'));
		$arrstdout=explode(',',$this->input->post('arrstdout'));
		$arrstdmin=explode(',',$this->input->post('arrstdmin'));
		$arrjk=explode(',',$this->input->post('arrjk'));
		$arrtelat=explode(',',$this->input->post('arrtelat'));
		$arrtelatp=explode(',',$this->input->post('arrtelatp'));
		$arrpkln=explode(',',$this->input->post('arrpkln'));
		$arrpkll=explode(',',$this->input->post('arrpkll'));
		$jum=count($arrno);
		//print_r($arrout);
		for($i=0;$i<$jum;$i++)
		{
			$form=array(
			'USERID'	=> $arruserid[$i],
			'BADGENUMBER' => $arrbadgenumber[$i],
			'NAME' => $arrname[$i],
			'DEPTID' => $arrdeptid[$i],
			'DEPTNAME' => $arrdeptname[$i],
			'TGL' => $arrtgl[$i],
			'PA' => $arrpa[$i],
			'XIN' => $arrin[$i],
			'XOUT' => $arrout[$i],
			'STDIN'	=> $arrstdin[$i],
			'STDOUT'=> $arrstdout[$i],
			'STDMIN'=> $arrstdmin[$i],
			'JK'=> $arrjk[$i],
			'TELAT'	=> $arrtelat[$i],
			'TELATP'	=> $arrtelatp[$i],
			'PKLN'=> $arrpkln[$i],
			'PKLL' => $arrpkll[$i],
			'TGL_APPROVE' => date('Y-m-d H:i'),
			'PIC'=>$this->session->userdata('nama_sta')
			);
			$this->Transaksi->add_form($form,'CHECKinoutlocked');
			
			$form2=array(
			'status'	=> 1
			);
			$id=array('USERID'	=> $arruserid[$i]
			,'tanggal' => $arrtgl[$i]);
			$this->Transaksi->edit_form3($id,$form2,'lembur');
			$this->Transaksi->edit_form3($id,$form2,'cuti');
		
		}
		$this->session->set_flashdata('msg_absen','Data Berhasih diapprove');
		$this->session->set_flashdata('tgl_absen',$arrtgl[0]);
		redirect('absen');

	}
	function unapproved()
	{
		$arruserid=explode(',',$this->input->post('arruserid'));
		$arrtgl=explode(',',$this->input->post('arrtgl'));
		$jum=count($arruserid);
		for($i=0;$i<$jum;$i++)
		{
			$form2=array(
				'status'	=> 0
				);
			$id=array('USERID'	=> $arruserid[$i]
				,'tanggal' => $arrtgl[$i]);
			$id2=array('USERID'	=> $arruserid[$i]
				,'tgl' => $arrtgl[$i]);
			$this->Transaksi->edit_form3($id,$form2,'lembur');
			$this->Transaksi->edit_form3($id,$form2,'cuti');
			$this->Transaksi->delete_form3('CHECKINOUTLOCKED',$id2);
		}
		$this->session->set_flashdata('msg_absen','Unapprove Data Berhasih');
		$this->session->set_flashdata('tgl_absen',$arrtgl[0]);
		redirect('absen');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
