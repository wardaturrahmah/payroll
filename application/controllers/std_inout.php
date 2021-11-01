<?php 
class std_inout extends CI_Controller {

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
			$this->session->set_userdata('halaman','std_inout');	
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
		$this->session->set_flashdata('dept_std_inout',0);
		$data['main_view']='std_inout';
		$data['form']=site_url('std_inout/add_std_inout');	
		$data['form2']=site_url('std_inout/edit_std_inout');	
		$data['form3']=site_url('std_inout/delete_std_inout');	
		$data['form4']=site_url('std_inout');
		$data['deptl']=$this->Master->get_departments_parent()->result();
		$data['tgl2']=date('Y-m-d');
		$data['tgl']=date('m/d/Y').' - '.date('m/d/Y');
		
		if($this->input->post('tgl2')!='')
		{
			$data['tgl2']=$this->input->post('tgl2');
			
		}
		$data['stdl']=$this->Transaksi->std_inout_tgl($data['tgl2'])->result();
		
		$this->load->view('std_inout',$data);
	}
	function add_std_inout()
	{
		$this->cek_login();
		
		$tgl=$this->input->post('tgl');
		$arr=explode(' - ',$tgl);
		$tgl1=date('Y-m-d',strtotime($arr[0]));
		$tgl2=date('Y-m-d',strtotime($arr[1]));
		
		$in=$this->input->post('in');
		$out=$this->input->post('out');
		$pils=$this->input->post('pilihan');
		
		if($pils!='')
		{
			$notif=0;
			$badge='';
			foreach($pils as $pil)
			{	$cek=0;
				$cek1=$this->Transaksi->std_inout_userid($tgl1,$pil)->num_rows();
				$cek2=$this->Transaksi->std_inout_userid($tgl2,$pil)->num_rows();
				$cek3=$this->Transaksi->std_inout_userid2($tgl1,$tgl2,$pil)->num_rows();
				$cek4=$this->Transaksi->std_inout_userid3($tgl1,$tgl2,$pil)->num_rows();
				$cek=$cek1+$cek2+$cek3+$cek4;
				if($cek==0)
				{
					$form=array('USERID'=>$pil,
					'tgl1'=>$tgl1,
					'tgl2'=>$tgl2,
					'jam_in'=>$in,
					'jam_out'=>$out,
					);
					$this->Transaksi->add_form($form,'std_inout');
					//notif dapat diinput
					$notif+=0;
				}
				else
				{
					$user=$this->Master->get_user($pil)->row();
					$badge.=$user->Name.' ('.$user->Badgenumber.'),';
					$notif+=1;
				}
				if($notif>0)
				{
					$this->session->set_flashdata('msg_std_inout_fail','Data '.$badge.' tidak dapat ditambah karena sudah ada');
				}
				else
				{
					$this->session->set_flashdata('msg_std_inout','Data Berhasih ditambah');
				}
			}
		}
		redirect('std_inout');
	}
	function edit_std_inout()
	{
		$this->cek_login();
		$in=$this->input->post('in');
		$out=$this->input->post('out');
		$tgl=$this->input->post('tgl');
		$arr=explode(' - ',$tgl);
		$tgl1=date('Y-m-d',strtotime($arr[0]));
		$tgl2=date('Y-m-d',strtotime($arr[1]));
		$form=array('tgl1'=>$tgl1,
					'tgl2'=>$tgl2,
					'jam_in'=>$in,
					'jam_out'=>$out,
				);
		$this->Transaksi->edit_form2($this->input->post('id'),$form,'std_inout','id');
		$this->session->set_flashdata('msg_std_inout','Data Berhasih diupdate');

		redirect('std_inout');
	}
	function delete_std_inout()
	{
		$this->Transaksi->delete_form2($this->input->post('id'),'std_inout','id');
		$this->session->set_flashdata('msg_std_inout_fail','Data Berhasih dihapus');

		redirect('std_inout');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
