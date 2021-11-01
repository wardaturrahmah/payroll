<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
		<h3 class="nav-link">Barcode</h3>
      </li>
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
	
     <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $this->session->userdata("nama"); ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php
		  if($this->session->userdata('statusUser') == "Admin"){
		  ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(). 'Cont_SettingUser/getUser'; ?>" class="dropdown-item">
            <i class="fas fa-user-cog"></i>  Setting User
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
		  <a href="<?php echo base_url(). 'c_user/viewUser'; ?>" class="dropdown-item">
            <i class="fas fa-user-plus"></i>  Create User
            <span class="float-right text-muted text-sm"></span>
          </a>
		  <?php 
		  }
		  ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('login/logout'); ?>" class="dropdown-item dropdown-footer">Logout</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>