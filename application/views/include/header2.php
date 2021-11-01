<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
	
     <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $this->session->userdata("nama_sta"); ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			<div class="dropdown-divider"></div>
			<a href="<?php echo base_url(). 'c_user/pass'; ?>" class="dropdown-item">
				<i class="fas fa-user"></i>  Ganti Password
				<span class="float-right text-muted text-sm"></span>
			</a>
          <?php
		  if($this->session->userdata('group_sta') == "Admin"){
		  ?>
         
          <div class="dropdown-divider"></div>
		  <a href="<?php echo base_url(). 'c_user'; ?>" class="dropdown-item">
            <i class="fas fa-user-plus"></i>  Membuat User
            <span class="float-right text-muted text-sm"></span>
          </a>
		  <?php 
		  }
		  ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('login/process_logout'); ?>" class="dropdown-item dropdown-footer">Logout</a>
        </div>
      </li>
    </ul>
  </nav>