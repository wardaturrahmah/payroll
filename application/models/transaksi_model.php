<?php
class Transaksi_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct() 
	{
        parent::__construct();
	}
	
	function add_form($form,$table)
	{
		$this->db->insert($table, $form);
	}
	
	function edit_form($id,$waktu_jeda,$table)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $waktu_jeda);
	}
	
	function edit_form2($id,$waktu_jeda,$table,$kolom)
	{
		$this->db->where($kolom, $id);
		$this->db->update($table, $waktu_jeda);
	}
	function edit_form3($id,$waktu_jeda,$table)
	{
		$this->db->where($id);
		$this->db->update($table, $waktu_jeda);
	}
	
	function delete_form($id,$table)
	{
		$this->db->delete($table, array('id' => $id));
	}	
	
	function delete_form2($id,$table,$kolom)
	{
		$this->db->delete($table, array($kolom  => $id));
	}	
	function delete_form3($table,$form)
	{
		$this->db->delete($table, $form);
	}	
	function lembur($tgl,$tgl2)
	{
		$sql="
				select * from userinfo a, lembur b
				where a.userid=b.userid and b.tanggal between '$tgl' and '$tgl2'
			";
			return $this->db->query($sql);
	}
	function cuti_terpakai($userid,$tgl,$tgl2)
	{
		$sql="
				select * from cuti a, LEAVECLASS b
				where a.type=b.LEAVEID and tanggal between '$tgl' and '$tgl2'
				and userid=$userid and type=4
			";
			return $this->db->query($sql);
	}
	/* function telat($userid,$tgl,$tgl2)
	{
		$sql="
				select * from cuti a, LEAVECLASS b
				where a.type=b.LEAVEID and tanggal between '$tgl' and '$tgl2'
				and userid=$userid and type=6
			";
			return $this->db->query($sql);
	} */
	function cuti($tgl,$tgl2)
	{
		$sql="
				select * from userinfo a, cuti b, LEAVECLASS c
		where a.userid=b.userid and b.type=c.LEAVEID
		and b.tanggal between '$tgl' and '$tgl2'
			";
			return $this->db->query($sql);
	}
	function approve_absen($deptid,$tgl,$tgl2)
	{
		$sql="
				exec sp_absen_approve $deptid,'$tgl','$tgl2'
			";
			return $this->db->query($sql);
	}
	
	function absen_user($userid,$tgl,$tgl2)
	{
		$sql="
				select * from CHECKINOUT
				where USERID=$userid and cast(CHECKTIME as date) between '$tgl' and '$tgl2'
			";
			return $this->db->query($sql);
	}
	function absen_user_in($userid,$tgl)
	{
		$sql="
				

			select min(CHECKTIME) as xin from CHECKINOUT
				where USERID=$userid and cast(CHECKTIME as date) = '$tgl' and CHECKTYPE='I'
			";
			return $this->db->query($sql);
	}
	function gaji_lembur($userid,$tgl,$tgl2)
	{
		$sql="
				select USERID, sum(ln1) as ln1, sum(ln2) as ln2, sum(ll1) as ll1, sum(ll2) as ll2, sum(ll3) as ll3
				,n_ln1,n_ln2,n_ll1,n_ll2,n_ll3
				from lembur
				where status=1 and tanggal between '$tgl' and '$tgl2' and userid=$userid
				group by USERID,n_ln1,n_ln2,n_ll1,n_ll2,n_ll3

			";
			return $this->db->query($sql);
	}
	function gaji_temp($user)
	{
		$sql="
				
			select userid,badgenumber,name,deptid,deptname, sum(upah) as upah, sum(lembur) as lembur,premi, bpjs_kes,bpjs_ktn
			from temp_gaji
			where pic='$user'
			group by userid,badgenumber,name,deptid,deptname,premi,bpjs_kes,bpjs_ktn

			";
			return $this->db->query($sql);
	}
	function std_inout_tgl($tgl)
	{
		$sql="
				
			select * from std_inout a,userinfo b
			where a.userid=b.userid and '$tgl' between tgl1 and tgl2
			order by b.badgenumber
			";
			return $this->db->query($sql);
	}
	function std_inout_userid($tgl,$userid)
	{
		$sql="
				
			select * from std_inout
			where '$tgl' between tgl1 and tgl2
			and userid=$userid
			";
			return $this->db->query($sql);
	}
	function std_inout_userid2($tgl,$tgl2,$userid)
	{
		$sql="
				
			select * from std_inout
			where  tgl1 between '$tgl' and '$tgl2'
			and userid=$userid
			";
			return $this->db->query($sql);
	}
	function std_inout_userid3($tgl,$tgl2,$userid)
	{
		$sql="
				
			select * from std_inout
			where  tgl2 between '$tgl' and '$tgl2'
			and userid=$userid
			";
			return $this->db->query($sql);
	}
	function hk_aktif($tgl,$tgl2,$userid)
	{
		$sql="
			select * from CHECKINOUTLOCKED a
			left join HOLIDAYS b on a.TGL=b.STARTTIME and b.STARTTIME is null
			where xin!='' and xout!=''
			and DATENAME(dw,TGL)!='Sunday'
			and TGL between '$tgl' and '$tgl2'
			and USERID=$userid
			";
			return $this->db->query($sql);
	}
	function gaji($pic)
	{
		$sql="
			insert into gaji
			select userid,badgenumber,name,deptid,deptname,tgl,upah,lembur,premi,bpjs_kes,bpjs_ktn
			,pic,GETDATE() AS TIME_APPROVE from temp_gaji
			where pic='$pic'";
			return $this->db->query($sql);
	}
	function approve_gaji($deptid,$tgl1,$tgl2)
	{
		$sql="
				exec sp_gaji $deptid,'$tgl1','$tgl2'
			";
			return $this->db->query($sql);
	}
	function unapprove_gaji($dept,$tgl1,$tgl2)
	{
		$sql="exec sp_gaji_unapprove $dept,'$tgl1','$tgl2'";
		return $this->db->query($sql);
	}
	function cek_cuti($userid,$tgl)
	{
		$sql="
								
				select * from cuti
				where userid=$userid and tanggal='$tgl'
		";
		return $this->db->query($sql);
	}
}
