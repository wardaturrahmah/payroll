<?php 
class gaji extends CI_Controller 
{

	function __construct()
	{
        parent::__construct();
		$this->load->model('Transaksi_model', 'Transaksi', TRUE);
		$this->load->model('Master_model', 'Master', TRUE);
	}
	public function index()
	{
		$this->session->set_userdata('page','gaji');
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
			$this->session->set_userdata('halaman','gaji');	
		}
	}
	
	function add_form()
	{
		
		$this->cek_login();	
		$data['main_view']='gaji'; 
		$data['form']=site_url('gaji/add_temp_gaji');
		$data['form2']=site_url('gaji/approved');
		$data['form3']=site_url('gaji/unapproved');
		$tgl=date('m/d/Y').' - '.date('m/d/Y');
		$data['gajil']=array();
		if($this->session->flashdata('tgl_gaji')!='')
		{
			$tgl=$this->session->flashdata('tgl_gaji');
			
		
		}
		if($this->session->flashdata('dept_gaji')!='')
		{
			$dept=$this->session->flashdata('dept_gaji');
			$data['deptfal']=$dept;
			$tglarr=explode(' - ',$tgl);
			$tgl1=$tglarr[0];
			$tgl2=$tglarr[1];
			$approve=$this->Transaksi->approve_gaji($dept,$tgl1,$tgl2)->result();
			$data['cek']=count($approve);
			if($data['cek']==0)
			{
				$data['gajil']=$this->Transaksi->gaji_temp($this->session->userdata('nama_sta'))->result();
			}
			else
			{
				$data['gajil']=$approve;
			}
		}
		$data['tgl']=$tgl;
		$arrtgl=explode(' - ',$tgl);
		$tgl1=$arrtgl[0];
		$tgl2=$arrtgl[1];
		$data['deptl']=$this->Master->get_departments()->result();
		$this->load->view('gaji',$data);
	}
	function add_temp_gaji()
	{
		$this->cek_login();
		$jammin=4.5;
		$telatmax=15;
		$deptid=$this->input->post('dept');
		$tgl=$this->input->post('tgl');
		$arrtgl=explode(' - ',$tgl);
		$periode1=$arrtgl[0];
		$periode2=$arrtgl[1];

		$user=$this->Master->get_karyawan($deptid)->result();
		$absen=$this->Transaksi->approve_absen($deptid,$periode1,$periode2)->result();	
		$this->Transaksi->delete_form2($this->session->userdata('nama_sta'),'temp_gaji','pic');
		if(count($user)>0)
		{
			foreach($user as $user)
			{
				$cek_premi=$this->Transaksi->hk_aktif($periode1,$periode2,$user->USERID)->result();
				$cek_aktif=$this->Master->hari_aktif($periode1,$periode2)->row();
				$hari_aktif=$cek_aktif->aktif;
				if(count($cek_premi)==$hari_aktif)
				{
					$premi=$user->PREMI;
				}
				else
				{
					$premi=0;
				}
				if(count($absen)>0)
				{
					foreach($absen as $absens)
					{
						$jamn=$absens->STDMIN/60;
						if($absens->USERID == $user->USERID)
						{
							if(!empty($absens->STDIN) and !empty($absens->STDOUT)  and ($absens->JK>=$jammin))
							{
								$upah=round($user->UPAH);
								if($absens->TELAT!=0 and $absens->TELAT<=$telatmax)
								{
									$potong_telat=round($absens->TELAT/($jamn*60)*$upah);
								}
								else
								{
									$potong_telat=0;
								}
								if($absens->TELATP!=0 and $absens->PA==0)
								{
									$potong_telat+=round($absens->TELATP/($jamn*60)*$upah);
								}
								else
								{
									$potong_telat=$potong_telat;
								}
							}
							else
							{
								$upah=0;
								$potong_telat=0;
							}
							if($absens->TELAT>$telatmax)
							{
								$upah=0;
								$potong_telat=0;
							}
							if(($absens->PA!=0) and ($absens->PA>=$jammin))
							{
								$jk=$absens->PA;
								$upah=round(($absens->PA/$jamn)*$user->UPAH);
							}
							$lembur=$this->Transaksi->gaji_lembur($user->USERID,$absens->TGL,$absens->TGL)->row();
							if(count($lembur)>0)
							{
								$upah_lembur=round(($lembur->ln1*$lembur->n_ln1)+($lembur->ln2*$lembur->n_ln2)+($lembur->ll1*$lembur->n_ll1)+($lembur->ll2*$lembur->n_ll2)+($lembur->ll3*$lembur->n_ll3));
							}
							else
							{
								$upah_lembur=0;
							}
							//jika lembur  libur. Gaji dibayar lembur saja
							if($absens->PKLL!=0)
							{
								$upah=0;
							}
							//jika lembur  libur. Gaji dibayar lembur saja
							
							$upahs=$upah-$potong_telat;
							$bpjs_kes=round($user->BPJS_KESEHATAN);
							$bpjs_ktn=round($user->BPJS_KTN);
							$form=array('userid' => $user->USERID,
							'badgenumber' => $user->Badgenumber,
							'name' => $user->Name,
							'deptid' => $user->DEPTID,
							'deptname' => $user->DEPTNAME,
							'tgl' =>$absens->TGL,
							'upah' =>$upahs,
							'lembur' =>$upah_lembur,
							'PREMI'=>$premi,
							'bpjs_kes' =>$bpjs_kes,
							'bpjs_ktn' =>$bpjs_ktn,
							'pic' =>$this->session->userdata('nama_sta'),
							);
							$this->Transaksi->add_form($form,'temp_gaji');
						}
					}
				}
			}
		}
		$this->session->set_flashdata('tgl_gaji',$tgl);
		$this->session->set_flashdata('dept_gaji',$deptid);
		redirect('gaji');
	}
	
	function approved()
	{		
		$this->Transaksi->gaji($this->session->userdata('nama_sta'));
		$tgl=$this->input->post('tgl_approve');
		$dept=$this->input->post('dept_approve');
		$this->session->set_flashdata('msg_gaji','Approve Data Berhasih');
		$this->session->set_flashdata('tgl_gaji',$tgl);
		$this->session->set_flashdata('dept_gaji',$dept);
		redirect('gaji');

	}
	function unapproved()
	{
		$tgl=$this->input->post('tgl_unapprove');
		$dept=$this->input->post('dept_unapprove');
		$tglarr=explode(' - ',$tgl);
		$tgl1=$tglarr[0];
		$tgl2=$tglarr[1];
		$this->Transaksi->unapprove_gaji($dept,$tgl1,$tgl2);
		$this->session->set_flashdata('msg_gaji','Unapprove Data Berhasih');
		$this->session->set_flashdata('tgl_gaji',$tgl);
		$this->session->set_flashdata('dept_gaji',$dept);
		redirect('gaji');
	}
}