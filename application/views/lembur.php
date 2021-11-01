<!DOCTYPE html>
<html lang="en">
<script>
	function get_user(){
		var dept=$( "#dept option:selected" ).val();
			
			if(dept!='')
			{
				$.ajax({
					url:'<?php echo base_url();?>lembur/get_user',
					method:'post',
					data:{
							dept:dept,
						},
					success:function(data)
					{
							
							var html = '';
							var i=0;
							var obj = jQuery.parseJSON(data);
							//loop opsi
							for(i=0; i<obj.length; i++)
							{
								html += '<option value="'+obj[i].USERID+'">'+obj[i].Name+'</option>';
							}
							$('#kary').html(html);//mengembalikan nilai option pada id kode			
							

					}
				});	
			}
			else//jika unit kosong, pilihan kembali kosong
			{
				 html = '<option> - </option>';
				 $('#item').html(html);	
			}
			
		}  
		
</script>
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
							<h1 class="m-0 text-dark">Transaksi Lembur</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Transaksi Lembur</li>
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
							<?php if($this->session->flashdata('msg_lembur')){ ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_lembur'); ?>
							</div>
							<?php }?>
							<?php if($this->session->flashdata('msg_lembur_fail')){ ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_lembur_fail'); ?>
							</div>
							<?php }?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Input Lembur</h5>
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
														<select class="form-control form-control-sm select2" style="width: 100%;" name="dept" id="dept" onchange="get_user();">
															<?php 
															$deptfal=$this->session->flashdata('dept_lembur');
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
																<option value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option>
																<?php
																}
																
															}?>
															
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Karyawan</label>
													<div class="col-9">
														<select class="form-control form-control-sm select2" style="width: 100%;" name="karyawan" id="kary">
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal</label>
													<div class="col-3">
														<input type="date" class="form-control" name="tgl" value="<?php echo date('Y-m-d',strtotime($tgl)); ?>"></input>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Jenis Lembur</label>
													<div class="col-9">
														<select class="form-control form-control-sm select2" style="width: 100%;" name="jenis" id="jenis">
															<option value="PKLN">PKLN</option>
															<option value="PKLL">PKLL</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Lama Waktu (jam) </label>
													<div class="col-sm-9">
														<input type="text" class="form-control form-control-sm" id="lama" name="lama" required="">
													</div>
												</div>
													<div class="card-footer">
														<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;"></label>

														<button type="submit" class="btn btn-primary" name="btn" value="cariData">Simpan</button>
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
									<h5 class="card-title">Lembur List</h5>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<form class="form-horizontal" action="<?php echo $form4; ?>" method="post" id="form1">
											
											<div class="form-group row">
												<div class="col-sm-9">
													
													<input type="text" class="form-control float-left" id="reservation" name="tgl_cari" value="<?php echo $this->session->userdata('tgl1_lembur'); ?>">
													
												</div>
												<input type="submit" class="btn btn-primary col-sm-3" value="cari">
											</div>
										</form>
										<div class="col-md-12">
										
											<div  class="table-responsive">
												<table id="example1" class="table table-bordered table-striped table-hover">
													<thead>
														<th>No</th>
														<th>Badgenumber</th>
														<th>Nama</th>
														<th>Tanggal</th>
														<th>Jenis Lembur</th>
														<th>Lama Waktu(jam)</th>
														<th>Upah Lembur</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php
															$no = 1;
															foreach ($lemburl as $lembur)
															{
																$total=0;
																$ln1=$lembur->ln1;
																$ln2=$lembur->ln2;
																$ll1=$lembur->ll1;
																$ll2=$lembur->ll2;
																$ll3=$lembur->ll3;
																$n_ln1=$lembur->n_ln1;
																$n_ln2=$lembur->n_ln2;
																$n_ll1=$lembur->n_ll1;
																$n_ll2=$lembur->n_ll2;
																$n_ll3=$lembur->n_ll3;
																$total=($ln1*$n_ln1)+($ln2*$n_ln2)+($ll1*$n_ll1)+($ll2*$n_ll2)+($ll3*$n_ll3);
																echo '<tr>';
																echo '<td>'.$no++.'</td>';
																echo '<td>'.$lembur->Badgenumber.'</td>';
																echo '<td>'.$lembur->Name.'</td>';		
																echo '<td>'.$lembur->tanggal.'</td>';		
																echo '<td>'.$lembur->jenis.'</td>';		
																echo '<td>'.$lembur->lama.'</td>';		
																echo '<td>'.$total.'</td>';		
														?>
														<td>
														<?php
															if(empty($lembur->status))
															{
																?>
														  <div class="btn-group">
															<button type="button" data-toggle="modal" data-target="#modal_edit_<?echo $lembur->id?>" class="btn btn-default"><i class="fas fa-edit"></i></button>
															<button type="button" data-toggle="modal" data-target="#modal_delete_<?echo $lembur->id?>" class="btn btn-default"><i class="fas fa-trash-alt"></i></button>
														  </div>
														  <?php
															}
															?>
														</td>
														<?php
														echo '</tr>';
														?>
														<div class="modal fade" id="modal_edit_<?echo $lembur->id?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Edit Lembur</h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $lembur->id ?>" name="id"></input>
																	<input type="hidden" value="<?php echo $lembur->USERID ?>" name="karyawan"></input>
																	
																	
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Badgenumber</label>
																		<label class="col-sm-6 col-form-label"><?php echo $lembur->Badgenumber; ?></label>
																	</div>
																	
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Nama Karyawan</label>
																		<label class="col-sm-6 col-form-label"><?php echo $lembur->Name; ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Tanggal</label>
																		<div class="col-6">
																			<input type="date" class="form-control" name="tgl" value="<?php echo date('Y-m-d',strtotime($lembur->tanggal)); ?>"></input>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Jenis</label>
																		<div class="col-6">
																			<select class="form-control form-control-sm select2" style="width: 100%;" name="jenis" id="jenis">
																				<option <?php echo $lembur->jenis == 'PKLN' ? 'selected="selected"' : '' ?> value="PKLN">PKLN</option>
																				<option <?php echo $lembur->jenis == 'PKLL' ? 'selected="selected"' : '' ?> value="PKLL">PKLL</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Lama Waktu</label>
																		<div class="col-6">
																			<input type="text" class="form-control form-control-sm" id="lama" name="lama" value="<?php echo $lembur->lama;?>" required="">
																		</div>
																	</div>
																	
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
														  <div class="modal fade" id="modal_delete_<?echo $lembur->id?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Delete Lembur</h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form3; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $lembur->id ?>" name="id"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Badgenumber</label>
																		<label class="col-sm-6 col-form-label"><?php echo $lembur->Badgenumber; ?></label>
																	</div>
																	
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Nama Karyawan</label>
																		<label class="col-sm-6 col-form-label"><?php echo $lembur->Name; ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Tanggal</label>
																		<label class="col-sm-6 col-form-label"><?php echo $lembur->tanggal; ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Jenis Lembur</label>
																		<label class="col-sm-6 col-form-label"><?php echo $lembur->jenis; ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Durasi</label>
																		<label class="col-sm-6 col-form-label"><?php echo $lembur->lama; ?></label>
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

<script>
    $('#reservation').daterangepicker()

  $("#link-lembur").click(function(){
	alert('a');
   /* $(".lembur").removeClass("nav-link");
    $(".lembur").addClass("nav-link active"); */
});
</script>
<?php $this->load->view('include/jquery'); ?>
</body>
</html>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

