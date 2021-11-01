<!DOCTYPE html>
<html lang="en">
<script>
	function get_user(){
		var dept=$( "#dept option:selected" ).val();
			
			if(dept!='')
			{
				$.ajax({
					url:'<?php echo base_url();?>cuti/get_user',
					method:'post',
					data:{
							dept:dept,
						},
					success:function(data)
					{
							
							var html = '<thead><th></th><th>Badgenumber</th><th>Nama</th><th>Departemen</th></thead>';
							var i=0;
							var obj = jQuery.parseJSON(data);
							//loop opsi
							for(i=0; i<obj.length; i++){
								cek='<input type="checkbox" name="pilihan[]" value="'+obj[i].USERID+'"  />';
								html += '<tr><td>'+cek+'</td><td>'+obj[i].Badgenumber+'</td><td>'+obj[i].Name+'</td><td>'+obj[i].DEPTNAME+'</td></tr>';
							}
							$('#table_kar').html(html);//mengembalikan nilai option pada id kode			
							

					}
				});	
			}
			else//jika unit kosong, pilihan kembali kosong
			{
				 html = '<option> - </option>';
				 $('#item').html(html);	
			}
			
		}  
		function get_lama(){
		var type=$( "#type option:selected" ).val();
			
			if(type==5)
			{
				html = 'Lama waktu (jam)';
				html2='<input type="text" class="form-control form-control-sm" id="lama" name="lama" required="">';				
				document.getElementById('lama').innerHTML = html;
				$('#lama2').html(html2);
				

				
			}
			else//jika unit kosong, pilihan kembali kosong
			{
				html = '';
				html2='<input type="text" class="form-control form-control-sm" id="lama" name="lama" value="8" hidden>';				
				$('#lama').html(html);	
				$('#lama2').html(html2);
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
							<h1 class="m-0 text-dark">Transaksi Standart Jam Kerja</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Transaksi Standart Jam Kerja</li>
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
							<?php if($this->session->flashdata('msg_std_inout')){ ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_std_inout'); ?>
							</div>
							<?php }?>
							<?php if($this->session->flashdata('msg_std_inout_fail')){ ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_std_inout_fail'); ?>
							</div>
							<?php }?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Input Standart Jam Kerja</h5>
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
															$deptfal=$this->session->flashdata('dept_cuti');
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
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal</label>
													<div class="col-3">
														<input type="text" class="form-control float-left" id="tgl" name="tgl">
													</div>
												</div>
												
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Jam In</label>
													<div class=" col-sm-3 input-group date  " id="timepicker" data-target-input="nearest">
													  <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" name="in"/>
													  <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
														  <div class="input-group-text"><i class="far fa-clock"></i></div>
													  </div>
													</div>
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Jam Out</label>
													<div class=" col-sm-3 input-group date  " id="timepicker2" data-target-input="nearest">
													  <input type="text" class="form-control datetimepicker-input" data-target="#timepicker2" name="out"/>
													  <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
														  <div class="input-group-text"><i class="far fa-clock"></i></div>
													  </div>
													</div>
													<!-- /.input group -->
												</div>
												<table id="table_kar" class="table table-bordered table-striped table-hover">
												
												</table>
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
									<h5 class="card-title">Standart Jam Kerja List</h5>
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
													
														<input type="date" class="form-control" name="tgl2" value="<?php echo date('Y-m-d',strtotime($tgl2)); ?>"></input>
													
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
														<th>Tanggal Awal</th>
														<th>Tanggal Akhir</th>
														<th>Jam In</th>
														<th>Jam Out</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php
															$no = 1;
													if(count($stdl)>0)
													{
														foreach ($stdl as $stdl)
															{
																echo '<tr>';
																echo '<td>'.$no++.'</td>';
																echo '<td>'.$stdl->Badgenumber.'</td>';
																echo '<td>'.$stdl->Name.'</td>';		
																echo '<td>'.$stdl->tgl1.'</td>';		
																echo '<td>'.$stdl->tgl2.'</td>';		
																echo '<td>'.date('H:i',strtotime($stdl->jam_in)).'</td>';		
																echo '<td>'.date('H:i',strtotime($stdl->jam_out)).'</td>';
																
														?>
														<td>
															<?php
															if(!empty($stdl->Badgenumber))//nanti diganti
															{
																?>
															 <div class="btn-group">
																<button type="button" data-toggle="modal" data-target="#modal_edit_<?echo $stdl->id?>" class="btn btn-default"><i class="fas fa-edit"></i></button>
																<button type="button" data-toggle="modal" data-target="#modal_delete_<?echo $stdl->id?>" class="btn btn-default"><i class="fas fa-trash-alt"></i></button>
															</div>
															<?php
																}
															?>
														</td>
														<?php
														echo '</tr>';
														?>
														<div class="modal fade" id="modal_edit_<?echo $stdl->id?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Edit Standart</h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $stdl->id ?>" name="id"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Badgenumber</label>
																		<label class="col-sm-6 col-form-label"><?php echo $stdl->Badgenumber; ?></label>
																	</div>
																	
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama</label>
																		<label class="col-sm-6 col-form-label"><?php echo $stdl->Name; ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal</label>
																		<div class="col-6">
																			<input type="text" class="form-control float-left tgl_range" name="tgl" value="<?php echo date('m/d/Y',strtotime($stdl->tgl1)).' - '.date('m/d/Y',strtotime($stdl->tgl2)); ?>">
																		</div>
																	</div>
																	
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Jam In</label>
																		<div class=" col-sm-3 input-group date timepicker3" data-target-input="nearest">
																		  <input type="text" class="form-control datetimepicker-input" data-target=".timepicker3" name="in" value="<?php echo date('H:i',strtotime($stdl->jam_in))?>"/>
																		  <div class="input-group-append" data-target=".timepicker3" data-toggle="datetimepicker">
																			  <div class="input-group-text"><i class="far fa-clock"></i></div>
																		  </div>
																		</div>
																		</div>
																	<div class="form-group row">	
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Jam Out</label>
																		<div class=" col-sm-3 input-group date  timepicker4" data-target-input="nearest">
																		  <input type="text" class="form-control datetimepicker-input" data-target=".timepicker4" name="out"  value="<?php echo date('H:i',strtotime($stdl->jam_out))?>"/>
																		  <div class="input-group-append" data-target=".timepicker4" data-toggle="datetimepicker">
																			  <div class="input-group-text"><i class="far fa-clock"></i></div>
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
															</div>
															<!-- /.modal-dialog -->
														  </div>
														  <div class="modal fade" id="modal_delete_<?echo $stdl->id?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Delete Standart</h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form3; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $stdl->id ?>" name="id"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Badgenumber</label>
																		<label class="col-sm-6 col-form-label"><?php echo $stdl->Badgenumber; ?></label>
																	</div>
																	
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Nama Karyawan</label>
																		<label class="col-sm-6 col-form-label"><?php echo $stdl->Name; ?></label>
																		
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Tanggal</label>
																		<label class="col-sm-6 col-form-label"><?php echo $stdl->tgl1.'-'.$stdl->tgl2; ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Jam In</label>
																		<label class="col-sm-6 col-form-label"><?php echo date('H:i',strtotime($stdl->jam_in)); ?></label>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Jam Out</label>
																		<label class="col-sm-6 col-form-label"><?php echo date('H:i',strtotime($stdl->jam_out)); ?></label>
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

