<html lang="en">
<head>
</head>
<body>
<?php 
$karyawan=$this->Master->get_karyawan()->result();
foreach($karyawan as $kar)
{
	ECHO base64_decode($kar->Notes);?>
<img src="data:image/jpeg;base64,<?php echo base64_encode($kar->PHOTO);?>"/>
<?php }?>
</body>

</html>