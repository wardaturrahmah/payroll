<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/css'); ?>
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
							<h1 class="m-0 text-dark">Master Department</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Master Department</li>
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
							<?php if($this->session->flashdata('msg_dept')){ ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_dept'); ?>
							</div>
							<?php }?>
							<?php if($this->session->flashdata('msg_dept_fail')){ ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_dept_fail'); ?>
							</div>
							<?php }?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Input New Department</h5>
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
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama Department :</label>
													<div class="col-sm-9">
														<input type="text" class="form-control form-control-sm" id="inputName" placeholder="Department Name" name="deptname" required="">
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Department Parent</label>
													<div class="col-9">
														<select class="form-control form-control-sm select2" style="width: 100%;" name="supdeptid">
															<?php 
															foreach ($deptm as $dept){
																?><option value="<?php echo $dept->DEPTID ?>"><?php echo $dept->DEPTNAME ?></option><?php
															}?>
															
														</select>
													</div>
												</div>		
												<div class="card-footer">

													<div class="form-group row">
														<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;"></label>
														<div class="col-6">
															<button type="submit" class="btn btn-primary" name="btn" value="cariData">Submit</button>
														</div>
													</div>	
												</div>												
										</div>
									  <!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								  <!-- ./card-body -->
								
											</form>

							</div>
							
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Department List</h5>
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
												<table id="example1" class="table table-bordered table-striped table-hover">
													<thead>
														<th>No</th>
														<th>DEPARTMENT</th>
														<th>PARENT NAME</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php
															$no = 1;
															foreach ($deptl as $dept)
															{
																echo '<tr>';
																echo '<td>'.$no++.'</td>';
																echo '<td>'.$dept->DEPTNAME.'</td>';
																echo '<td>'.$dept->parent.'</td>';		
														?>
														<td>
														  <div class="btn-group">
															<button type="button" data-toggle="modal" data-target="#modal_edit_<?echo $dept->DEPTID?>" class="btn btn-default"><i class="fas fa-edit"></i></button>
															<button type="button" data-toggle="modal" data-target="#modal_delete_<?echo $dept->DEPTID?>" class="btn btn-default"><i class="fas fa-trash-alt"></i></button>
														  </div>
														</td>
														<?php
														echo '</tr>';
														?>
														<div class="modal fade" id="modal_edit_<?echo $dept->DEPTID?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Edit Department <?php echo $dept->DEPTNAME;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $dept->DEPTID ?>" name="deptid"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama Department</label>
																		<div class="col-sm-9">
																			<input type="text" value="<?php echo $dept->DEPTNAME; ?>" class="form-control form-control-sm" id="inputName" placeholder="Name" name="deptname" required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Parent Department</label>
																		<div class="col-9">
																			<select class="form-control form-control-sm select2" style="width: 100%;" name="supdeptid">
																				<?php 
																				foreach ($deptm as $dept2){
																					if ($dept2->DEPTID == $dept->SUPDEPTID){
																						?><option selected="selected" value="<?php echo $dept2->DEPTID ?>"><?php echo $dept2->DEPTNAME ?></option><?php
																					}
																					else{
																						?><option value="<?php echo $dept2->DEPTID ?>"><?php echo $dept2->DEPTNAME ?></option><?php
																					}
																				}?>
																			</select>
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
														  <div class="modal fade" id="modal_delete_<?echo $dept->DEPTID?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Delete Department <?php echo $dept->DEPTNAME;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form3; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $dept->DEPTID ?>" name="deptid"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Nama Department</label>
																		<div class="col-sm-6">
																			<label class="col-sm-6 col-form-label"><?php echo $dept->DEPTNAME; ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Department Parent</label>
																		<div class="col-6">
																			<label class="col-sm-9 col-form-label"><?php echo $dept->parent; ?></label>
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

