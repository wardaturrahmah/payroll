<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/css'); ?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse pace-primary" onload="get_user();">
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
							<h1 class="m-0 text-dark">Perhitungan Gaji</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Perhitungan Gaji</li>
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
							<?php if($this->session->flashdata('msg_gaji')){ ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_gaji'); ?>
							</div>
							<?php }?>
							<?php if($this->session->flashdata('msg_gaji_fail')){ ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_gaji_fail'); ?>
							</div>
							<?php }?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Proses Data</h5>
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
													<div class="col-9">
														<select class="form-control form-control-sm select2" style="width: 100%;" name="dept" id="dept">
															<?php 
															//$deptfal=$this->session->flashdata('dept_gaji');
															foreach ($deptl as $dept)
															{
																$deptf=isset($deptfal) ? $deptfal : '';
																//echo  isset($default['id_item']) ? $default['id_item'] : ''
																if ($deptf == $dept->DEPTID)
																{
																	?>
																	<option selected="selected" value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option><?php
																}
																else
																{
																?>
																<option value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option>
																<?php
																}
																
															}?>
															
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal</label>
													<div class="col-3">
														<input type="text" class="form-control float-left" id="tgl" name="tgl" value="<?php echo  isset($tgl) ? $tgl : ''; ?>">
													</div>
												</div>
												
												<div class="card-footer">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;"></label>

													<button type="submit" class="btn btn-primary" name="btn" value="cariData">Hitung</button>
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
									<h5 class="card-title">List Gaji</h5>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<!--<form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
											
											<div class="form-group row">
												<div class="col-sm-9">
													
													<input type="text" class="form-control float-left" id="reservation" name="tgl_cari" value="<?php echo $this->session->userdata('tgl1_gaji'); ?>">
													
												</div>
												<input type="submit" class="btn btn-primary col-sm-3" value="cari">
											</div>
										</form>-->
										<div class="col-md-12">
										
											<div  class="table-responsive">
											<?php
											if(count($gajil)!=0)
											{
											?>
												<table id="example1" class="table table-bordered table-striped table-hover">
													<thead>
														<th>No</th>
														<th>Badgenumber</th>
														<th>Nama</th>
														<th>Departemen</th>
														<th>Upah</th>
														<th>Lembur</th>
														<th>PREMI</th>
														<th>BPJS KESEHATAN</th>
														<th>BPJS KETENAGAKERJAAN</th>
														<th>Total</th>
														
													</thead>
													<tbody>
														<?php
														$no=0;
														
														
														
															foreach($gajil as $gaji)
															{
																
																$upah=ROUND($gaji->upah);
																$lembur=ROUND($gaji->lembur);
																$premi=ROUND($gaji->premi);
																$bpjs_kes=ROUND($gaji->bpjs_kes);
																$bpjs_ktn=ROUND($gaji->bpjs_ktn);
																$total=$upah+$lembur-$bpjs_kes-$bpjs_ktn+$premi;
																$totalt=number_format(ROUND($total),0,',','.');
																$upaht=number_format(ROUND($upah),0,',','.');
																$lemburt=number_format(ROUND($lembur),0,',','.');
																$premit=number_format(ROUND($premi),0,',','.');
																$bpjs_kest=number_format(ROUND($bpjs_kes),0,',','.');
																$bpjs_ktnt=number_format(ROUND($bpjs_ktn),0,',','.');
																$no++;
																?>
																<tr>
																<td><?php echo $no;?></td>
																<td><?php echo $gaji->badgenumber;?></td>
																<td><?php echo $gaji->name;?></td>
																<td><?php echo $gaji->deptname;?></td>
																<td><?php echo $upaht;?></td>
																<td><?php echo $lemburt;?></td>
																<td><?php echo $premit;?></td>
																<td><?php echo $bpjs_kest;?></td>
																<td><?php echo $bpjs_ktnt;?></td>
																<td><?php echo $totalt;?></td>
																
																</tr>
															<?php
															}?>
														
													</tbody>
												</table>
												<?php
												if($cek==0)
												{
												?>
												<form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
													<input type="hidden" class="form-control float-left" id="tgl_unapprove" name="tgl_approve" value="<?php echo  isset($tgl) ? $tgl : ''; ?>">
													<input type="hidden" class="form-control float-left" id="dept_unapprove" name="dept_approve" value="<?php echo  isset($deptfal) ? $deptfal : ''; ?>">
													<button type="submit" class="btn btn-success" name="btn" value="approved">Approve Gaji</button>
												</form>
												<?php
												}
												else
												{?>
													
												<form class="form-horizontal" action="<?php echo $form3; ?>" method="post" id="form1">
													<input type="hidden" class="form-control float-left" id="tgl_unapprove" name="tgl_unapprove" value="<?php echo  isset($tgl) ? $tgl : ''; ?>">
													<input type="hidden" class="form-control float-left" id="dept_unapprove" name="dept_unapprove" value="<?php echo  isset($deptfal) ? $deptfal : ''; ?>">
													<button type="submit" class="btn btn-danger" name="btn" value="unapproved">Unapprove Gaji</button>
												</form>
												<?php
												}
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

