<?php 
class lembur extends CI_Controller {

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
			$this->session->set_userdata('halaman','lembur');	
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
		$this->session->set_flashdata('dept_lembur',0);
		$data['main_view']='lembur'; //html pada view/lembur.php
		$data['form']=site_url('lembur/add_lembur');	//action pada button simpan
		$data['form2']=site_url('lembur/edit_lembur');	//action pada button simpan
		$data['form3']=site_url('lembur/delete_lembur');	//action pada button simpan
		$data['form4']=site_url('lembur/');	//action pada button simpan
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
		$this->session->set_userdata('tgl1_lembur',$data['tgl1']);
		$data['lemburl']=$this->Transaksi->lembur($tgl1,$tgl2)->result();
		$this->load->view('lembur',$data);
	}
	function add_lembur()
	{
		$this->cek_login();
		$cek=$this->Master->get_user($this->input->post('karyawan'))->row();
		$upah=round($cek->UPAH);
		if(!empty($upah))
		{
			//$var=30;
			$tgl=$this->input->post('tgl');
			
			$tgl_pertama = date('Y-m-01', strtotime($tgl));
			$tgl_terakhir = date('Y-m-t', strtotime($tgl));
			$vars=$this->Master->hari_aktif($tgl_pertama,$tgl_terakhir)->row();
			$var=$vars->aktif;
			
			$ln1=0;
			$ln2=0;
			$ll1=0;
			$ll2=0;
			$ll3=0;
			$lama=$this->input->post('lama');
			if ($this->input->post('jenis')=='PKLN' )
			{
				if ($lama>1)
				{
					$ln1=1;
					$ln2=$lama-$ln1;
				}
				else
				{
					$ln1=$lama;
				}
			}
			if ($this->input->post('jenis')=='PKLL')
			{
				if (date("w",strtotime($this->input->post('tgl'))) == 6)
				{
					$sll1=5;
				}
				else 
				{
					$sll1=7;
				}
				if($lama>$sll1)
				{
					$ll1=$sll1;
					if(($lama-$ll1)>1)
					{
						$ll2=1;
						$ll3=$lama-$ll1-$ll2;
					}
					else	
					{
						$ll2=$lama-$ll1;
					}
				}
				else
				{
					$ll1=$lama;
				}
			}
			$nln1=round($upah*$var*1.5/173);
			$nln2=round($upah*$var*2/173);
			$nll1=round($upah*$var*2/173);
			$nll2=round($upah*$var*3/173);
			$nll3=round($upah*$var*4/173);
			$form=array('USERID'=>$this->input->post('karyawan'),
						'deptid'=>$cek->DEFAULTDEPTID,
						'tanggal'=>$this->input->post('tgl'),
						'jenis'=>$this->input->post('jenis'),
						'lama'=>$this->input->post('lama'),
						'ln1'=>$ln1,
						'ln2'=>$ln2,
						'll1'=>$ll1,
						'll2'=>$ll2,
						'll3'=>$ll3,
						'n_ln1'=>$nln1,
						'n_ln2'=>$nln2,
						'n_ll1'=>$nll1,
						'n_ll2'=>$nll2,
						'n_ll3'=>$nll3, 
						);
		
		$this->Transaksi->add_form($form,'lembur');
		$this->session->set_flashdata('msg_lembur','Data Berhasih ditambahkan');
		$this->session->set_flashdata('dept_lembur',$this->input->post('dept'));
		}
		else
		{
			$this->session->set_flashdata('msg_lembur_fail','Upah belum disetting. Lembur tidak bisa ditambahkan');
			$this->session->set_flashdata('dept_lembur',$this->input->post('dept'));
		}
		
		redirect('lembur'); 
		
	}
	function edit_lembur()
	{
		$this->cek_login();
			$tgl=$this->input->post('tgl');
			$tgl_pertama = date('Y-m-01', strtotime($tgl));
			$tgl_terakhir = date('Y-m-t', strtotime($tgl));
			$vars=$this->Master->hari_aktif($tgl_pertama,$tgl_terakhir)->row();
			$var=$vars->aktif;
			
			
			$ln1=0;
			$ln2=0;
			$ll1=0;
			$ll2=0;
			$ll3=0;
			$lama=$this->input->post('lama');
			if ($this->input->post('jenis')=='PKLN' )
			{
				if ($lama>1)
				{
					$ln1=1;
					$ln2=$lama-$ln1;
				}
				else
				{
					$ln1=$lama;
				}
			}
			if ($this->input->post('jenis')=='PKLL')
			{
				if (date("w",strtotime($this->input->post('tgl'))) == 6)
				{
					$sll1=5;
				}
				else 
				{
					$sll1=7;
				}
				if($lama>$sll1)
				{
					$ll1=$sll1;
					if(($lama-$ll1)>1)
					{
						$ll2=1;
						$ll3=$lama-$ll1-$ll2;
					}
					else	
					{
						$ll2=$lama-$ll1;
					}
				}
				else
				{
					$ll1=$lama;
				}
			}
			$cek=$this->Master->get_user($this->input->post('karyawan'))->row();
			$upah=round($cek->UPAH);
			$nln1=round($upah*$var*1.5/173);
			$nln2=round($upah*$var*2/173);
			$nll1=round($upah*$var*2/173);
			$nll2=round($upah*$var*3/173);
			$nll3=round($upah*$var*4/173);
			$form=array(
						'tanggal'=>$this->input->post('tgl'),
						'jenis'=>$this->input->post('jenis'),
						'lama'=>$this->input->post('lama'),
						'ln1'=>$ln1,
						'ln2'=>$ln2,
						'll1'=>$ll1,
						'll2'=>$ll2,
						'll3'=>$ll3,
						'n_ln1'=>$nln1,
						'n_ln2'=>$nln2,
						'n_ll1'=>$nll1,
						'n_ll2'=>$nll2,
						'n_ll3'=>$nll3,
						);
		$this->Transaksi->edit_form2($this->input->post('id'),$form,'lembur','id');
		$this->session->set_flashdata('msg_lembur','Data Berhasih diupdate');

		redirect('lembur');
	}
	function delete_lembur()
	{
		$this->Transaksi->delete_form2($this->input->post('id'),'lembur','id');
		$this->session->set_flashdata('msg_lembur_fail','Data Berhasih dihapus');

		redirect('lembur');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
