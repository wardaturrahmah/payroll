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
							<h1 class="m-0 text-dark">Master User</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Master User</li>
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
							<?php if($this->session->flashdata('msg_user')){ ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_user'); ?>
							</div>
							<?php }?>
							<?php if($this->session->flashdata('msg_user_fail')){ ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<strong>Notification!</strong> <?php echo $this->session->flashdata('msg_user_fail'); ?>
							</div>
							<?php }?>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Input New User</h5>
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
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama User :</label>
													<div class="col-sm-9">
														<input type="text" class="form-control form-control-sm" id="inputName" placeholder="Username" name="username" required="">
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Group :</label>
													<div class="col-sm-9">
														<select class="form-control form-control-sm select2" style="width: 100%;" name="grup" id="grup">
															<option value="Admin">Admin</option>
															<option value="User">User</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Password :</label>
													<div class="col-sm-9">
														<input type="password" class="form-control form-control-sm" id="inputName" placeholder="Password" name="password" required="">
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
									<h5 class="card-title">User List</h5>
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
														<th>Nama</th>
														<th>Group</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php
															$no = 1;
															foreach ($userl as $user)
															{
																echo '<tr>';
																echo '<td>'.$no++.'</td>';
																echo '<td>'.$user->nama.'</td>';
																echo '<td>'.$user->grup.'</td>';		
														?>
														<td>
														  <div class="btn-group">
														  
															<button type="button" data-toggle="modal" data-target="#modal_edit_<?echo $user->nama?>" class="btn btn-default"><i class="fas fa-edit"></i></button>
															<button type="button" data-toggle="modal" data-target="#modal_reset_<?echo $user->nama?>" class="btn btn-default"><i class="fas fa-undo"></i></button>
															<button type="button" data-toggle="modal" data-target="#modal_delete_<?echo $user->nama?>" class="btn btn-default"><i class="fas fa-trash-alt"></i></button>
														  </div>
														</td>
														<?php
														echo '</tr>';
														?>
														<div class="modal fade" id="modal_edit_<?echo $user->nama?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Edit User <?php echo $user->nama;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form2; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $user->nama ?>" name="nama"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Nama User</label>
																		<div class="col-sm-9">
																			<input type="text" value="<?php echo $user->nama; ?>" class="form-control form-control-sm" id="inputName" placeholder="Name" name="username" readonly required="">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-3 col-form-label" style="text-align: right;">Group</label>
																		<div class="col-9">
																			<select class="form-control form-control-sm select2" style="width: 100%;" name="grup" id="grup">
																				<option <?php echo $user->grup == 'Admin' ? 'selected="selected"' : '' ?> value="Admin">Admin</option>
																				<option <?php echo $user->grup == 'User' ? 'selected="selected"' : '' ?> value="User">User</option>
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
														  <div class="modal fade" id="modal_delete_<?echo $user->nama?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Delete User <?php echo $user->nama;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form3; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $user->nama ?>" name="username"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Nama Username</label>
																		<div class="col-sm-6">
																			<label class="col-sm-6 col-form-label"><?php echo $user->nama; ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Grup</label>
																		<div class="col-6">
																			<label class="col-sm-9 col-form-label"><?php echo $user->grup; ?></label>
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
														  <div class="modal fade" id="modal_reset_<?echo $user->nama?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
															<div class="modal-dialog">
															  <div class="modal-content">
																<div class="modal-header">
																  <h4 class="modal-title">Reset Password User <?php echo $user->nama;?></h4>
																  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																  </button>
																</div>
																<div class="modal-body">
																  <form class="form-horizontal" action="<?php echo $form4; ?>" method="post" id="form1">
																	<input type="hidden" value="<?php echo $user->nama ?>" name="username"></input>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Nama Username</label>
																		<div class="col-sm-6">
																			<label class="col-sm-6 col-form-label"><?php echo $user->nama; ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="inputName" class="col-sm-6 col-form-label" style="text-align: right;">Grup</label>
																		<div class="col-6">
																			<label class="col-sm-9 col-form-label"><?php echo $user->grup; ?></label>
																		</div>
																	</div>
																	
																	<div class="col-3">
																	  </div>
																	  <div class="modal-footer justify-content-between">
																		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		  <input type="submit" name="save" value="Reset" class="btn btn-primary">
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

