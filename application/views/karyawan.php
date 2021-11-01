<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/css'); ?>
<script type="text/javascript">
											/* Fungsi formatRupiah */
											function myFunction(){
												
												var angka=$( this ).val();
												alert(angka);
											/* 	var prefix='';
												var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split   		= number_string.split(','),
												sisa     		= split[0].length % 3,
												rupiah     		= split[0].substr(0, sisa),
												ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

												// tambahkan titik jika yang di input sudah menjadi angka ribuan
												if(ribuan){
													separator = sisa ? '.' : '';
													rupiah += separator + ribuan.join('.');
												}

												rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
												return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : ''); */
											}
										</script>
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
							<h1 class="m-0 text-dark">Master Karyawan</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Master Karyawan</li>
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
							<?php if($this->session->flashdata('msg_karyawan')){ ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_karyawan'); ?>
							</div>
							<?php }?>
							<?php if($this->session->flashdata('msg_karyawan_fail')){ ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_karyawan_fail'); ?>
							</div>
							<?php }?>
							
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Karyawan List</h5>
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
																$this->session->set_userdata('deptfal_kary',$deptfal);

															
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
													<div class="col-3">
														<button type="submit" class="btn btn-primary" name="btn" value="cariData">Cari</button>
													</div>
												</div>
											</form>
										</div>
										<div class="col-md-12">
										
	

	
											<div  class="table-responsive">
												<table id="example1" class="table table-bordered table-striped table-hover">
													<thead>
														<th>No</th>
														<th>Badgenumber</th>
														<th>Nama</th>
														<th>Deptname</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php
															$no = 1;
															foreach ($karyawanl as $kar)
															{
																echo '<tr>';
																echo '<td>'.$no++.'</td>';
																echo '<td>'.$kar->Badgenumber.'</td>';
																echo '<td>'.$kar->Name.'</td>';		
																echo '<td>'.$kar->DEPTNAME.'</td>';		
														?>
														<td>
														  <div class="btn-group">
															<button type="button" data-toggle="modal" data-target="#modal_view_<?echo $kar->USERID?>" class="btn btn-info"><i class="fas fa-eye"></i></button>
															<button type="button" data-toggle="modal" data-target="#modal_edit_<?echo $kar->USERID?>" class="btn btn-success"><i class="fas fa-edit"></i></button>
															<button type="button" data-toggle="modal" data-target="#modal_delete_<?echo $kar->USERID?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
														  </div>
														</td>
														<?php
														echo '</tr>';
														?>
														<div class="modal fade" id="modal_view_<?echo $kar->USERID?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog modal-lg">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Lihat Karyawan <?php echo $kar->Name;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1" enctype="multipart/form-data">
																	<input type="hidden" value="<?php echo $kar->USERID ?>" name="userid"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">Badgenumber</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo $kar->Badgenumber; ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">Nama</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo $kar->Name; ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">Department</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo $kar->DEPTNAME; ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">Gender</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo $kar->Gender; ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">Tanggal Lahir</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo date('d/m/Y',strtotime($kar->BIRTHDAY)); ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">Tanggal Masuk</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo date('d/m/Y',strtotime($kar->HIREDDAY)); ?></label>

																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">Alamat</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo $kar->street; ?></label>

																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">No KTP</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo $kar->CardNo; ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">No HP</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo $kar->PAGER; ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">UPAH</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo number_format(ROUND($kar->UPAH),0,',','.'); ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">PREMI</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo number_format(ROUND($kar->PREMI),0,',','.'); ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">BPJS KESEHATAN</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo number_format(ROUND($kar->BPJS_KESEHATAN),0,',','.'); ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">BPJS KETENAGAKERJAAN</label>
																		<label for="inputName" class="col-sm-6" style="text-align: left;"><?php echo number_format(ROUND($kar->BPJS_KTN),0,',','.'); ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3" style="text-align: left;">CUTI</label>
																		<label for="inputName" class="col-sm-3" style="text-align: left;"><?php echo $kar->OPHONE; ?></label>
																	</div>
																	<!--
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Photo</label>
																			<img src="data:image/jpeg;base64,<?php echo base64_encode($kar->PHOTO);?>"/>
																	</div>
																	-->
																	<div class="col-3">
																	</div>
																	<div class="modal-footer justify-content-between">
																	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	</div>
																	
																</form>
																</div>
									
															  </div>
															  <!-- /.modal-content -->
															</div>
															<!-- /.modal-dialog -->
														  </div>
														
														<div class="modal fade" id="modal_edit_<?echo $kar->USERID?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog modal-lg">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Edit Karyawan <?php echo $kar->Name;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1" enctype="multipart/form-data">
																	<input type="hidden" value="<?php echo $kar->USERID ?>" name="userid"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Badgenumber</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo $kar->Badgenumber; ?>" class="form-control form-control-sm" id="inputName" placeholder="Badgenumber" name="badgenumber" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo $kar->Name; ?>" class="form-control form-control-sm" id="inputName" placeholder="Name" name="nama" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Department</label>
																		<div class="col-6">
																			<select class="form-control form-control-sm select2" style="width: 100%;" name="deptid">
																				<?php 
																				foreach ($deptl as $dept){
																					if ($dept->DEPTID == $kar->DEFAULTDEPTID){
																						?><option selected="selected" value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option><?php
																					}
																					else{
																						?><option value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option><?php
																					}
																				}?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Gender</label>
																		<div class="col-6">
																			<select class="form-control form-control-sm select2" style="width: 100%;" name="gender">
																				<option <?php echo $kar->Gender == 'Female' ? 'selected="selected"' : '' ?> value="Female">Female</option>
																				<option  <?php echo $kar->Gender == 'Male' ? 'selected="selected"' : '' ?> value="Male">Male</option>
																					
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal Lahir</label>
																		<div class="col-3">
																			<input type="date" class="form-control" name="birthday" value="<?php echo date('Y-m-d',strtotime($kar->BIRTHDAY)); ?>"></input>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal Masuk</label>
																		<div class="col-3">
																			<input type="date" class="form-control" name="hiredday" value="<?php echo date('Y-m-d',strtotime($kar->HIREDDAY)); ?>"></input>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Alamat</label>
																		<div class="col-6">
													                        <textarea class="form-control" rows="2" placeholder="" name="street"><?php echo $kar->street ?></textarea>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No KTP</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo $kar->CardNo; ?>" class="form-control form-control-sm" id="inputName" placeholder="NO KTP" name="CardNo" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">No HP</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo $kar->PAGER; ?>" class="form-control form-control-sm" id="inputName" placeholder="NO HP" name="PAGER" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">UPAH</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo number_format(ROUND($kar->UPAH),0,',','.'); ?>" class="form-control form-control-sm" id="UPAH" placeholder="UPAH" name="UPAH" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">PREMI</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo number_format(ROUND($kar->PREMI),0,',','.'); ?>" class="form-control form-control-sm" id="PREMI" placeholder="PREMI" name="PREMI" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">BPJS KESEHATAN</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo number_format(ROUND($kar->BPJS_KESEHATAN),0,',','.'); ?>" class="form-control form-control-sm" id="BPJS_KESEHATAN" placeholder="" name="BPJS_KESEHATAN" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">BPJS KETENAGAKERJAAN</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo number_format(ROUND($kar->BPJS_KTN),0,',','.'); ?>" class="form-control form-control-sm" id="BPJS_KTN" placeholder="" name="BPJS_KTN" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">CUTI</label>
																		<div class="col-sm-6">
																			<input type="text" value="<?php echo $kar->OPHONE; ?>" class="form-control form-control-sm" id="CUTI" placeholder="CUTI" name="CUTI" required="">
																		</div>
																	</div>
																
																	<!--
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Photo</label>
																			<img src="data:image/jpeg;base64,<?php echo base64_encode($kar->PHOTO);?>"/>
																	</div>
																	-->
																	<div class="col-3">
																	  </div>
																	  <div class="modal-footer justify-content-between">
																		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		  <input type="submit" name="save" value="update" class="btn btn-primary">
																		</div>
																	
																</form>
																</div>
									
															  </div>
															  <!-- /.modal-content -->
															</div>
															<!-- /.modal-dialog -->
														  </div>
														
														<div class="modal fade" id="modal_delete_<?echo $kar->USERID?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Delete Karyawan <?php echo $kar->Name;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form3; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo  $kar->USERID ?>" name="userid"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Badgenumber</label>
																		<div class="col-sm-9">
																			<label class="col-sm-12 col-form-label"><?php echo $kar->Badgenumber; ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama</label>
																		<div class="col-sm-9">
																			<label class="col-sm-12 col-form-label"><?php echo $kar->Name; ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Department</label>
																		<div class="col-sm-9">
																			<label class="col-sm-12 col-form-label"><?php echo $kar->DEPTNAME; ?></label>
																		</div>
																	</div>
																	
																	<div class="col-3">
																	  </div>
																	  <div class="modal-footer justify-content-between">
																		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		  <input type="submit" name="save" value="delete" class="btn btn-primary">
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
						<!--<form class="form-horizontal" action="<?php echo base_url(). 'Cont_settingData/eksportDepartment'; ?>" method="post" id="form1">
							<button type="submit" class="btn btn-success" name="btn" value="approved">Export Excel <i class="fas fa-file-export"></i></button>
						</form>-->
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

