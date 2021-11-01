<!DOCTYPE html>
<html lang="en">
<?php 	
		$this->load->view('include/css'); 
		$this->load->model('Master_model', 'Master', TRUE);
		$this->load->model('Transaksi_model', 'Transaksi', TRUE);

?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse pace-primary">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('include/header2'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
		<?php $this->load->view('include/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Absen Harian</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Absen Harian</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

    <!-- Main content -->
			<section class="content">
				<div class="container-fluid">
        <!-- Info boxes -->
					<div class="row">
						<div class="col-md-12">
							<?php if($this->session->flashdata('msg_absen')){ ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_absen'); ?>
							</div>
							<?php }?>
							<?php if($this->session->flashdata('msg_absen_fail')){ ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_absen_fail'); ?>
							</div>
							<?php }?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Input</h5>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form class="form-horizontal" action="<?php echo $form; ?>" method="post" id="form1">
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Department</label>
													<div class="col-6">
														<select class="form-control form-control-sm select2" style="width: 100%;" name="dept">
															<?php 
																$this->session->set_userdata('deptfal_absen',$deptfal);

															
															foreach ($deptl as $dept)
															{
																if ($deptfal == $dept->DEPTID)
																{
																	?>
																	<option selected="selected" value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option><?php
																}
																else
																{
																?>
																<option value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option><?php
																}
															}?>
															
														</select>
													</div>
													
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal</label>
													<div class="col-3">
														<input type="date" class="form-control" name="tgl" value="<?php echo date('Y-m-d',strtotime($tgl)); ?>"></input>
													</div>
												</div>
												<div class="card-footer">

												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;"></label>
													<div class="col-6">
														<button type="submit" class="btn btn-primary" name="btn" value="cariData">Cari</button>
													</div>
												</div>	
												</div>
											</form>
										</div>
									  <!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								  <!-- ./card-body -->
								

							</div>
							
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Absen List</h5>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div  class="table-responsive">
												<?php 
												if($cek==0)
												{
												?>
												<table id="example1" class="table table-bordered table-striped table-hover">
													<thead>
														<th>No</th>
														<th>Badgenumber</th>
														<th>Nama</th>
														<th>Departemen</th>
														<th>PA</th>
														<th>IN</th>
														<th>OUT</th>
														<th>STD IN</th>
														<th>STD OUT</th>
														<th>JAM KERJA</th>
														<th>Telat Masuk (menit)</th>
														<th>Awal Pulang (menit)</th>
														<th>PKLN</th>
														<th>PKLL</th>
														<th>ACTION</th>
													</thead>
													<tbody>
														<?php
															$no = 1;
															$arrno='';
															$arruserid='';
															$arrbadgenumber='';
															$arrname='';
															$arrdeptid='';
															$arrdeptname='';
															$arrtgl='';
															$arrpa='';
															$arrin='';
															$arrout='';
															$arrstdin='';
															$arrstdout='';
															$arrstdmin='';
															$arrjk='';
															$arrtelat='';
															$arrtelatp='';
															$arrpkln='';
															$arrpkll='';
															foreach ($absenl as $absen)
															{
																
																 $in=' ';
																 $int=' ';
																 $out=' ';
																 $outt=' ';
																 $stdint=' ';
																 $stdoutt=' ';
																 $stdmin=0;
																 $jk=0;
																 $jkt=' ';
																 $telat=0;
																 $telatt=' ';
																 $pa=0;
																 $PKLN=0;
																 $PKLL=0;
																if(!empty($absen->CheckIn_I))
																{
																	$in=date('Y-m-d H:i',strtotime($absen->CheckIn_I));
																	$int=date('H:i',strtotime($in));
																	$shift=$this->Transaksi->std_inout_userid($tgl,$absen->USERID)->row();
																	if(count($shift)>0)
																	{
																		
																		$stdint=date('H:i',strtotime($shift->jam_in));
																		$stdoutt=date('H:i',strtotime($shift->jam_out));
																		
																		if($stdint>$stdoutt)
																		{
																			$stdin=$tgl.' '.$stdint;
																			$stdout=$tgl2.' '.$stdoutt;
																		}
																		else
																		{
																			$stdin=$tgl.' '.$stdint;
																			$stdout=$tgl.' '.$stdoutt;
																		}
																		$jam=strtotime($stdout)-strtotime($stdin);
																		$jamstd    =$jam / (60 * 60);
																		$jamstd=FLOOR($jamstd/0.5)*0.5;
																		$stdmin=$jamstd*60;
																		if($in>$stdin)
																		{
																			$telat=round((strtotime($in)-strtotime($stdin))/60);
																			$telatt=$telat;
																		}
																		else
																		{
																			$telat=0;
																			$telatt=' ';
																		}
																	}
																	else
																	{
																		$stdint=' ';
																		$stdoutt=' ';
																		$telat=0;
																		$telatt=' ';
																	}
																}
																else
																{
																	$in=' ';
																	$int=' ';
																	$stdin=' ';
																	$stdout=' ';
																	$stdint=' ';
																	$stdoutt=' ';
																}
																if(!empty($absen->CheckIn_I) and !empty($absen->CheckIn_1))
																{
																	if($absen->CheckOut_O_2 < $absen->CheckIn_I_2)
																	{
																		$diff = ((strtotime($absen->CheckOut_0_2) - strtotime($absen->CheckIn_I)) + (strtotime($absen->CheckOut_O_2) - strtotime($absen->CheckIn_1)));
																		$out=date('Y-m-d H:i',strtotime($absen->CheckOut_O_2));
																		$outt=date('H:i',strtotime($out));
																		$jam    =$diff / (60 * 60);
																		$jk=FLOOR($jam/0.5)*0.5;
																		$jkt=$jk;
																		
																	}
																	else 
																	{
																		$diff = ((strtotime($absen->CheckOut_0_2) - strtotime($absen->CheckIn_I)) + (strtotime($absen->CheckOut_O_1_2) - strtotime($absen->CheckIn_1)));
																		$out = date('Y-m-d H:i',strtotime($absen->CheckOut_O_1_2));
																		$outt=date('H:i',strtotime($out));
																		$jam    =$diff / (60 * 60);
																		$jk=FLOOR($jam/0.5)*0.5;
																		$jkt=$jk;
																	}
																}		
																else 
																{
																	if (($absen->CheckOut_O < $absen->CheckIn_I) && !empty($absen->CheckOut_O_1_2)){
																		$diff = strtotime($absen->CheckOut_O_1_2) - strtotime($absen->CheckIn_I);
																		$out = date('Y-m-d H:i',strtotime($absen->CheckOut_O_1_2));
																		$outt = date('H:i',strtotime($out));
																		$jam    =$diff / (60 * 60);
																		$jk=FLOOR($jam/0.5)*0.5;
																		$jkt=$jk;
																		
																	}
																	else{//in dan out dihari yang sama (normal)
																		
																		if (!empty($absen->CheckOut_O) && !empty($absen->CheckIn_I)) {
																			if ($absen->CheckIn_I < $absen->CheckOut_O){//yang dirubah (02 des 2019)
																				$diff = (strtotime($absen->CheckOut_O) - strtotime($absen->CheckIn_I));
																				$out = date('Y-m-d H:i',strtotime($absen->CheckOut_O));
																				$outt = date('H:i',strtotime($out));
																				$jam    =$diff / (60 * 60);
																				$jk=FLOOR($jam/0.5)*0.5;
																				$jkt=$jk;
																			}
																			
																		}
																		
																	}
																}
																if(!empty($stdout))
																{
																	if($out<$stdout)
																	{
																		$telatp=(strtotime($stdoutt)-strtotime($outt))/60;
																		//$telatp=round((strtotime($stdout)-strtotime($out))/60);
																		$telatpt=$telatp;
																		
																	}
																	else
																	{
																		$telatp=0;
																		$telatpt=' ';
																	}
																}
																else
																{
																	$telatp=0;
																		$telatpt=' ';
																}
																if(empty($absen->PA))
																{
																	$pa=0;
																}
																else
																{
																	$pa=$absen->PA;	
																}
																if(empty($absen->PKLN))
																{
																	$PKLN=0;
																}
																else
																{
																	$PKLN=$absen->PKLN;	
																}
																if(empty($absen->PKLL))
																{
																	$PKLL=0;
																}
																else
																{
																	$PKLL=$absen->PKLL;	
																}
																if($jkt>24)
																{
																	
																	$out=' ';
																	$outt=' ';
																	$jk=0;
																	$jkt=' ';
																}
																$cuti=$this->Transaksi->cuti_terpakai($absen->USERID,$tgl,$tgl)->row();
																IF(count($cuti)>0)
																{
																	$stdin=$cuti->REPORTSYMBOL;
																	$stdint=$cuti->REPORTSYMBOL;
																	$stdout=$cuti->REPORTSYMBOL;
																	$stdoutt=$cuti->REPORTSYMBOL;
																	$jk=$cuti->lama;
																	$jkt=' ';
																}
																echo '<tr>';
																echo '<td>'.$no++.'</td>';
																echo '<td>'.$absen->Badgenumber.'</td>';
																echo '<td>'.$absen->Name.'</td>';
																echo '<td>'.$absen->DEPTNAME.'</td>';
																echo '<td>'.$absen->PA.'</td>';
																echo '<td>'.$int.'</td>';
																echo '<td>'.$outt.'</td>';
																echo '<td>'.$stdint.'</td>';
																echo '<td>'.$stdoutt.'</td>';
																echo '<td>'.$jkt.'</td>';
																echo '<td>'.$telatt.'</td>';
																echo '<td>'.$telatpt.'</td>';
																echo '<td>'.$absen->PKLN.'</td>';
																echo '<td>'.$absen->PKLL.'</td>';
																$arrno.=$no.',';
																$arruserid.=$absen->USERID.',';
																$arrbadgenumber.=$absen->Badgenumber.',';
																$arrname.=$absen->Name.',';
																$arrdeptid.=$absen->DEPTID.',';
																$arrdeptname.=$absen->DEPTNAME.',';
																$arrtgl.=$tgl.',';
																$arrpa.=$pa.',';
																$arrin.=$int.',';
																$arrout.=$outt.',';
																$arrstdin.=$stdint.',';
																$arrstdout.=$stdoutt.',';
																$arrstdmin.=$stdmin.',';
																$arrjk.=$jk.',';
																$arrtelat.=$telat.',';
																$arrtelatp.=$telatp.',';
																$arrpkln.=$PKLN.',';
																$arrpkll.=$PKLL.',';
														?>
														<td>
														  <div class="btn-group">
															<button type="button" data-toggle="modal" data-target="#modal_edit_<?echo $absen->USERID?>" class="btn btn-default"><i class="fas fa-edit"></i></button>
														  </div>
														</td>
														<?php
														echo '</tr>';
														?>
														<div class="modal fade" id="modal_edit_<?echo $absen->USERID?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content" style="color:black;">
																<div class="modal-header">
																  <h4 class="modal-title">Koreksi Check Lock - <?php echo $tgl ?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo base_url(). 'absen/edit_absen'; ?>" method="post">
																	<input type="hidden" name="USERID" value="<?php echo $absen->USERID ?>">
																	<input type="hidden" name="idDept" value="<?php echo $absen->DEPTNAME ?>">
																	<input type="hidden" name="date" value="<?php echo $tgl ?>">
																	<input type="hidden" name="status" value="koreksi">
																	
																	<div class="form-group row">
																		<div class="col-sm-3">
																			Department
																		</div>
																		<div class="col-sm-1">: </div>
																		<div class="col-sm-8">
																			<?php echo $absen->DEPTNAME; ?>
																		</div>
																	</div>
																	<div class="form-group row">
																		<div class="col-sm-3">
																			Nama User
																		</div>
																		<div class="col-sm-1">: </div>
																		<div class="col-sm-8">
																			<?php echo $absen->Name; ?>
																		</div>
																	</div>
																	<?php
																	$tgl4 = date("Y-m-d", strtotime($tgl));
																	$tgl5 = date("Y-m-d", strtotime('+1 day', strtotime($tgl)));
																	
																	$koreksi = $this->Transaksi->absen_user($absen->USERID,$tgl,$tgl)->result();
																	?>
																	<p>Pilih/masukan waktu Check Out</p>
																	<div class="form-group row">
																		<div class="col-sm-3">
																			Data Check Lock
																		</div>
																		<div class="col-sm-1">: </div>
																		<div class="col-sm-8">
																		<ul>
																		<input type="hidden" value="<?php echo $tgl?>" name="tgl">
																		<?php
																		if(count($koreksi)>0)
																		{
																		foreach ($koreksi as $koreksi){
																			
																			?>
																			<li>
																					<?php echo date('d-m-Y - H:i', strtotime($koreksi->CHECKTIME)).' -> '.$koreksi->CHECKTYPE; 
																					?> 
																					
																					<input type="hidden" value="<?php echo $koreksi->USERID?>" name="USERID[]">
																					<input type="hidden" value="<?php echo $koreksi->CHECKTIME?>" name="CHECKTIME[]">
																					<select name="type_absen[]"> 
																						<option <?php echo $koreksi->CHECKTYPE == 'I' ? 'selected="selected"' : '' ?> value="I">I</option>
																						<option <?php echo $koreksi->CHECKTYPE == 'O' ? 'selected="selected"' : '' ?> value="O">O</option>
																						<option <?php echo $koreksi->CHECKTYPE == '1' ? 'selected="selected"' : '' ?> value="1">1</option>
																						<option <?php echo $koreksi->CHECKTYPE == '0' ? 'selected="selected"' : '' ?> value="0">0</option>
																					</select> 
																			</li>
																		<?php	
																		}
																		}
																		?>
																		<li>
																			Custom date <br>
																			<input type="hidden" value="<?php echo $absen->USERID?>" name="USER">
																			<input type="datetime-local" name="dateCustom" id="dateCustom">
																			<select name="type_custom"> 
																				<option value="I">I</option>
																				<option value="O">O</option>
																				<option value="1">1</option>
																				<option value="0">0</option>
																			</select> 
																		</li>
																		
																		</ul> 
																		</div>
																	</div>
																	
																	  <div class="modal-footer justify-content-between">
																		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		 
																		  <input type="submit" name="updateCheck" value="Simpan" class="btn btn-primary" id="simpanCheck">
																		 
																		</div>
																	
																</form>
																</div>
																
															  </div>
															  <!-- /.modal-content -->
															</div>
															<!-- /.modal-dialog -->
														  </div>
					
														<?php
													}
														

													?>
						</tbody>
						</table>
												<form class="form-horizontal" action="<?php echo base_url(). 'absen/approved'; ?>" method="post">
													<input type="hidden" value="<?php echo rtrim($arrno,',');  ?>" name="arrno"></input>
													<input type="hidden" name="arruserid" value="<?php echo rtrim($arruserid,','); ?>"/>
													<input type="hidden" name="arrbadgenumber" value="<?php echo rtrim($arrbadgenumber,','); ?>"/>
													<input type="hidden" name="arrname" value="<?php echo rtrim($arrname,','); ?>"/>
													<input type="hidden" name="arrdeptid" value="<?php echo rtrim($arrdeptid,','); ?>"/>
													<input type="hidden" name="arrdeptname" value="<?php echo rtrim($arrdeptname,','); ?>"/>
													<input type="hidden" name="arrtgl" value="<?php echo rtrim($arrtgl,','); ?>"/>
													<input type="hidden" name="arrpa" value="<?php echo rtrim($arrpa,','); ?>"/>
													<input type="hidden" name="arrin" value="<?php echo rtrim($arrin,','); ?>"/>
													<input type="hidden" name="arrout" value="<?php echo rtrim($arrout,','); ?>"/>
													<input type="hidden" name="arrstdin" value="<?php echo rtrim($arrstdin,','); ?>"/>
													<input type="hidden" name="arrstdout" value="<?php echo rtrim($arrstdout,','); ?>"/>
													<input type="hidden" name="arrstdmin" value="<?php echo rtrim($arrstdmin,','); ?>"/>
													<input type="hidden" name="arrjk" value="<?php echo rtrim($arrjk,','); ?>"/>
													<input type="hidden" name="arrtelat" value="<?php echo rtrim($arrtelat,','); ?>"/>
													<input type="hidden" name="arrtelatp" value="<?php echo rtrim($arrtelatp,','); ?>"/>
													<input type="hidden" name="arrpkln" value="<?php echo rtrim($arrpkln,','); ?>"/>
													<input type="hidden" name="arrpkll" value="<?php echo rtrim($arrpkll,','); ?>"/>
													<button type="submit" class="btn btn-success" name="btn" value="approved">Approved</button>
												</form>
												<?php
												}
												else
												{
												?>
												<table id="example1" class="table table-bordered table-striped table-hover">
													<thead>
														<th>No</th>
														<th>Badgenumber</th>
														<th>Nama</th>
														<th>Departemen</th>
														<th>PA</th>
														<th>IN</th>
														<th>OUT</th>
														<th>STD IN</th>
														<th>STD OUT</th>
														<th>JAM KERJA</th>
														<th>Telat Masuk (menit)</th>
														<th>Awal Pulang (menit)</th>
														<th>PKLN</th>
														<th>PKLL</th>
													</thead>
													<tbody>
														<?php
															$no = 1;
															$arrno='';
															$arruserid='';
															$arrtgl='';
															foreach ($absenl as $absen)
															{
																if($absen->PA==0)
																{
																	$PA='';
																}
																else
																{
																	$PA=$absen->PA;
																}
																if($absen->JK==0)
																{
																	$JK='';
																}
																else
																{
																	$JK=$absen->JK;
																}
																if(empty($absen->XIN))
																{
																	$JK='';
																}
																if(empty($absen->XOUT))
																{
																	$JK='';
																}
																if($absen->TELAT==0)
																{
																	$TELAT='';
																}
																else
																{
																	$TELAT=$absen->TELAT;
																}
																if($absen->TELATP==0)
																{
																	$TELATP='';
																}
																else
																{
																	$TELATP=$absen->TELATP;
																}
																if($absen->PKLN==0)
																{
																	$PKLN='';
																}
																else
																{
																	$PKLN=$absen->PKLN;
																}
																if($absen->PKLL==0)
																{
																	$PKLL='';
																}
																else
																{
																	$PKLL=$absen->PKLL;
																}
																echo '<tr>';
																echo '<td>'.$no++.'</td>';
																echo '<td>'.$absen->BADGENUMBER.'</td>';
																echo '<td>'.$absen->NAME.'</td>';
																echo '<td>'.$absen->DEPTNAME.'</td>';
																echo '<td>'.$PA.'</td>';
																echo '<td>'.$absen->XIN.'</td>';
																echo '<td>'.$absen->XOUT.'</td>';
																echo '<td>'.$absen->STDIN.'</td>';
																echo '<td>'.$absen->STDOUT.'</td>';
															
																echo '<td>'.$JK.'</td>';
																echo '<td>'.$TELAT.'</td>';
																echo '<td>'.$TELATP.'</td>';
																echo '<td>'.$PKLN.'</td>';
																echo '<td>'.$PKLL.'</td>';
																
														?>
														
														<?php
														echo '</tr>';
																$arruserid.=$absen->USERID.',';
																$arrtgl.=$absen->TGL.',';
														?>
														<?php
															}
														//print_r($arr);

													?>
													</tbody>
												</table>
												<form class="form-horizontal" action="<?php echo base_url(). 'absen/unapproved'; ?>" method="post">
													<input type="hidden" name="arruserid" value="<?php echo rtrim($arruserid,','); ?>"/>
													<input type="hidden" name="arrtgl" value="<?php echo rtrim($arrtgl,','); ?>"/>
													<button type="submit" class="btn btn-danger" name="btn" value="Unapproved">Unapproved</button>
												</form>
												
												<?php
												
												}
												
												
												?>
											
											</div>
									   
										</div>
									  <!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								  <!-- ./card-body -->
								<div class="card-footer">
								</div>
							</div>

						</div><!-- /.col -->
					</div><!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php $this->load->view('include/footer'); ?>
</div>
<!-- ./wrapper -->

<?php $this->load->view('include/jquery'); ?>
</body>
</html>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

