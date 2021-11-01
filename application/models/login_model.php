<?php
class Login_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct() {
        parent::__construct();
	}
	
	// Inisialisasi nama tabel 
	
	
	
	

	
	
	
	function check_user2($username,$password)
	{
		$sql="SELECT * FROM login where nama='$username' and password='$password'";
		$sql=$this->db->query($sql);
		if($sql->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
			$this->session->set_flashdata('message_login', 'account login anda tidak ada/salah');
		}
	}
	

	
	function get_akses2($id)
	{
			$sql="SELECT  * FROM login where nama='$id'  ";
		return $this->db->query($sql);
	}
	function get_akses($id,$pass)
	{
			$sql="SELECT  * FROM login where nama='$id'  and password='$pass'";
		return $this->db->query($sql);
	}
	function list_user(){
		$sql="select * from login";
		return $this->db->query($sql);
	}
	
	
}
