<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-primary">
		<!--<img src="<?php echo base_url(); ?>assets/image/favicon.ico" class="brand-image img-circle elevation-3" style="opacity: .8">-->
		<span class="brand-text font-weight-light">Payroll</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?php echo base_url(); ?>assets/image/userimage.png" class="img-circle elevation-2">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?php echo $this->session->userdata("nama_sta"); ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<?php
					if($this->session->userdata('group_sta') == "Admin"){
				?>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-cogs"></i><p>Master<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='departemen')
							{
							?>
							<a href="<?php echo base_url().'dept'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'dept'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Master Department</p>
							</a>
						</li>
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='karyawan')
							{
							?>
							<a href="<?php echo base_url().'karyawan'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'karyawan'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Master Karyawan</p>
							</a>
						</li>
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='libur')
							{
							?>
							<a href="<?php echo base_url().'libur'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'libur'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Master Hari Libur</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-edit"></i><p>Transaksi<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='std_inout')
							{
							?>
							<a href="<?php echo base_url().'std_inout'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'std_inout'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Standart Jam Kerja</p>
							</a>
						</li>
						
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='cuti')
							{
							?>
							<a href="<?php echo base_url().'cuti'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'cuti'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Transaksi Waktu Jeda</p>
							</a>
						</li>
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='lembur')
							{
							?>
							<a href="<?php echo base_url().'lembur'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'lembur'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Transaksi Lembur</p>
							</a>
						</li>
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='absen')
							{
							?>
							<a href="<?php echo base_url().'absen'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'absen'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Absen Harian</p>
							</a>
						</li>
						<li class="nav-item">
							<?php 
							if($this->session->userdata('halaman')=='gaji')
							{
							?>
							<a href="<?php echo base_url().'gaji'; ?>" class="nav-link active">
							<?php
							}
							else
							{
							?>
							<a href="<?php echo base_url().'gaji'; ?>" class="nav-link">
							<?php
							}
							?>
								<i class="far fa-circle nav-icon"></i>
								<p>Transaksi Penggajian</p>
							</a>
						</li>
					</ul>
				</li>
		 
				<!--<li class="nav-item has-treeview">
					<a href="<?php echo base_url().'gaji'; ?>" class="nav-link">
						<i class="nav-icon fas fa-money-bill-alt"></i><p>Payroll</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url().'dept'; ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Penggajian</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url().'karyawan'; ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Master Karyawan</p>
							</a>
						</li>
					</ul>
				</li>-->
		 <?php
		  }
			  ?>
		  <br>
		  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  