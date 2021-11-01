<?php 
class cuti extends CI_Controller {

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
			$this->session->set_userdata('halaman','cuti');	
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
		$this->session->set_flashdata('dept_cuti',0);
		$data['main_view']='cuti';
		$data['form']=site_url('cuti/add_cuti');	
		$data['form2']=site_url('cuti/edit_cuti');	
		$data['form3']=site_url('cuti/delete_cuti');	
		$data['form4']=site_url('cuti/');
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
		$this->session->set_userdata('tgl1_cuti',$data['tgl1']);
		$data['cutil']=$this->Transaksi->cuti($tgl1,$tgl2)->result();
		$data['type_cuti']=$this->Master->type_jeda()->result();
		$this->load->view('cuti',$data);
	}
	function add_cuti()
	{
		$this->cek_login();
		$tgl=$this->input->post('tgl');
		$tgla=explode(' - ',$tgl);
		$tgl1=$tgla[0];
		$tgl2=$tgla[1];
		$jum=0;
		$msg='';
		$diff=strtotime($tgl2)-strtotime($tgl1);
		$a=floor($diff / (60 * 60 * 24))+1;
		$cek=$this->Master->get_user($this->input->post('karyawan'))->row();
		$cuti=$cek->OPHONE;
		$jenis=$this->input->post('jenis');
		if($jenis==5)
		{
			$tgls=date("Y-m-d", strtotime($tgl1));
			for($i=1;$i<=$a;$i++)
			{
				$cek=$this->Transaksi-> cek_cuti($this->input->post('karyawan'),$tgls)->result();
				if(count($cek)==0)
				{
					$form=array('USERID'=>$this->input->post('karyawan'),
					'deptid'=>$cek->DEFAULTDEPTID,
					'tanggal'=>$tgls,
					'type'=>$this->input->post('jenis'),
					'lama'=>$this->input->post('lama'),
					'keterangan'=>$this->input->post('keterangan'),
					'status'=>0
					);
					$this->Transaksi->add_form($form,'cuti');
				}
				else
				{
					$jum++;
					$msg.=$tgls.',';
				}
				$tgls = date("Y-m-d", strtotime('+1 day', strtotime($tgls)));
			}
			if($jum>0)
			{
			$this->session->set_flashdata('msg_cuti_fail','Data tanggal '.rtrim($msg,',').' sudah ada');
			}
			else
			{
			$this->session->set_flashdata('msg_cuti','Data Berhasih ditambahkan');	
			}
		}
		else if($jenis==6)
		{
				
					$tgls=date("Y-m-d", strtotime($tgl1));
					for($i=1;$i<=$a;$i++)
					{
						$cek=$this->Transaksi-> cek_cuti($this->input->post('karyawan'),$tgls)->result();
						if(count($cek)==0)
						{
						$form=array('USERID'=>$this->input->post('karyawan'),
						'deptid'=>$cek->DEFAULTDEPTID,
						'tanggal'=>$tgls,
						'type'=>$this->input->post('jenis'),
						'lama'=>8,
						'keterangan'=>$this->input->post('keterangan'),
						);
						$this->Transaksi->add_form($form,'cuti');
						}
						else
						{
							$jum++;
							$msg.=$tgls.',';
						}
						$tgls = date("Y-m-d", strtotime('+1 day', strtotime($tgls)));
					}
					if($jum>0)
					{
					$this->session->set_flashdata('msg_cuti_fail','Data tanggal '.rtrim($msg,',').' sudah ada');
					}
					else
					{
					$this->session->set_flashdata('msg_cuti','Data Berhasih ditambahkan');	
					}
		}
		else
		{
			if(!empty($cuti))
			{
				$hari_ini = date("Y-m-d");
				$tgl_pertama = date('Y-01-01', strtotime($hari_ini));
				$tgl_terakhir = date('Y-12-31', strtotime($hari_ini));
				$cutit=$this->Transaksi->cuti_terpakai($this->input->post('karyawan'),$tgl_pertama,$tgl_terakhir)->result();
				
				$sisa=$cuti-count($cutit);
				
				if($sisa>=$a)
				{
					$tgls=date("Y-m-d", strtotime($tgl1));
					for($i=1;$i<=$a;$i++)
					{
						$cek=$this->Transaksi-> cek_cuti($this->input->post('karyawan'),$tgls)->result();
						if(count($cek)==0)
						{
						$jum++;
						$form=array('USERID'=>$this->input->post('karyawan'),
						'deptid'=>$cek->DEFAULTDEPTID,
						'tanggal'=>$tgls,
						'type'=>$this->input->post('jenis'),
						'lama'=>8,
						'keterangan'=>$this->input->post('keterangan'),
						);
						$this->Transaksi->add_form($form,'cuti');
						}
						else
						{
							$jum++;
							$msg.=$tgls.',';
						}
						$tgls = date("Y-m-d", strtotime('+1 day', strtotime($tgls)));
					}
					if($jum>0)
					{
					$this->session->set_flashdata('msg_cuti_fail','Data tanggal '.rtrim($msg,',').' sudah ada');
					}
					else
					{
					$this->session->set_flashdata('msg_cuti','Data Berhasih ditambahkan');	
					}
				}
				else
				{
					//echo 'sisa cuti hanya '.$sisa;
					$this->session->set_flashdata('msg_cuti_fail','Data tidak dapat ditambahkan. Jatah cuti hanya tersisa '.$sisa);
				}
			}
			else
			{
				$this->session->set_flashdata('msg_cuti_fail','Data tidak dapat ditambahkan. Karyawan tidak memiliki jatah cuti');
			}
		}
		redirect('cuti'); 
	}
	function edit_cuti()
	{
		$this->cek_login();
		$form=array(
			'tanggal'=>$this->input->post('tgl'),
				'type'=>$this->input->post('jenis'),
				'lama'=>$this->input->post('lama'),
				'keterangan'=>$this->input->post('keterangan'),
			);		
		$this->Transaksi->edit_form2($this->input->post('id'),$form,'cuti','id');
		$this->session->set_flashdata('msg_cuti','Data Berhasih diupdate');

		redirect('cuti');
	}
	function delete_cuti()
	{
		$this->Transaksi->delete_form2($this->input->post('id'),'cuti','id');
		$this->session->set_flashdata('msg_cuti_fail','Data Berhasih dihapus');

		redirect('cuti');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
