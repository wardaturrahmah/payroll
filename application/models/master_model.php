<?php
class Master_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct() 
	{
        parent::__construct();
	}
	
	
	function get_departments()
	{
		$sql="
				select * from departments
			";
			return $this->db->query($sql);
	}
	function get_departments_parent()
	{
		$sql="
				select a.*,b.deptname as parent 
				from departments a, departments b
				where a.supdeptid=b.deptid
			";
			return $this->db->query($sql);
	}
	function cek_depertemen($nama,$parent)
	{
			$sql="
				select * from DEPARTMENTS
				where deptname='$nama' and  SUPDEPTID=$parent
			";
			return $this->db->query($sql);
	}
	function cek_depertemen2($nama,$parent,$deptid)
	{
			$sql="
				select * from DEPARTMENTS
				where deptname='$nama' and  SUPDEPTID=$parent
				and deptid!=$deptid
			";
			return $this->db->query($sql);
	}
	function get_karyawan($dept)
	{
		$sql="
				EXEC sp_userinfo $dept
			";
			return $this->db->query($sql);
	}
	function get_absen($dept,$tgl,$tgl2)
	{
		$sql="
				EXEC sp_absen $dept,'$tgl','$tgl2'
			";
			return $this->db->query($sql);
	}
	function get_user($userid)
	{
		$sql="
				select * from userinfo
				where userid=$userid
			";
			return $this->db->query($sql);
	}
	function shift($day,$userid,$in)
	{
		$sql="
				
				select cast(c.STARTTIME as time) STARTTIME,cast(c.ENDTIME as time) ENDTIME,d.WorkMins
				 from USER_OF_RUN A, NUM_RUN B, NUM_RUN_DEIL C, SCHCLASS D
				WHERE A.NUM_OF_RUN_ID=B.NUM_RUNID  AND B.NUM_RUNID=C.NUM_RUNID AND C.SCHCLASSID=D.SCHCLASSID
				AND C.SDAYS=$day AND USERID=$userid AND '$in' between d.CHECKINTIME1 and DATEADD(day,(c.edays-c.sdays), d.CHECKINTIME2)

			";
			return $this->db->query($sql);
	}
	function type_jeda()
	{
		$sql="SELECT * FROM LEAVECLASS";
		return $this->db->query($sql);
	}
	function no_libur()
	{
		$sql="
			select top 1 holidayid as id from HOLIDAYS
			order by holidayid desc
			";
		return $this->db->query($sql);
	}
	function libur($tgl,$tgl2)
	{
		$sql="
			select * from HOLIDAYS
			where STARTTIME between '$tgl' and '$tgl2'";
		return $this->db->query($sql);
	}
	function libur_non_minggu($tgl,$tgl2)
	{
		$sql="
			select * from HOLIDAYS
			where STARTTIME between '$tgl' and '$tgl2'
			and DATENAME(dw,STARTTIME)!='Sunday'";
		return $this->db->query($sql);
	}
	function hari_aktif($tgl,$tgl2)
	{
		$sql="
			select dbo.ACTIVEDAY($tgl,$tgl2) as aktif
		";
		return $this->db->query($sql);

	}
	function cek_libur($nama,$tgl)
	{
		$sql="
				select * from HOLIDAYS
			where STARTTIME = '$tgl' and holidayname='$nama'
		";
		return $this->db->query($sql);
	}
	function cek_libur2($nama,$tgl,$id)
	{
		$sql="
				select * from HOLIDAYS
			where STARTTIME = '$tgl' and holidayname='$nama' and holidayid!=$id
		";
		return $this->db->query($sql);
	}
}
