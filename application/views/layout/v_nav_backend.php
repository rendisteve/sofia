<?php
$CI = &get_instance();
$CI->load->model('Permission_model');
$role_id = $CI->session->userdata('role_id');
$permissions = $CI->Permission_model->get_user_permissions($role_id);
$permissions = explode(',', $permissions[0]);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>dashboard" class="brand-link">
      <img src="<?= base_url() ?>assets/img/logo_sofia_nn.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: #F8F9F9; padding: 2px;">
      <span class="brand-text font-weight-light"><b>SOFIA</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <!-- <marquee class="brand-text font-weight-light">Selamat Datang, <?= $this->session->userdata('nama_user') ?> </marquee> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if (in_array('users', $permissions)) : ?>
            <li class="nav-item">
              <a href="<?= base_url('users')?>" class="nav-link <?php if ($this->uri->segment(1) == 'users' and $this->uri->segment(2) == ''){ echo "active";} ?>">
                <i class="nav-icon fas fa-users"></i>
                <p> Users </p>
              </a>
            </li>
          <?php endif; ?>
          <?php if (in_array('dashboard', $permissions)) : ?>
            <li class="nav-item">
              <a href="<?= base_url('dashboard')?>" class="nav-link <?php if ($this->uri->segment(1) == 'dashboard' and $this->uri->segment(2) == ''){ echo "active";} ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Dashboard </p>
              </a>
            </li>
          <?php endif; ?>
          <?php if (in_array('logistik', $permissions)) : ?>
            <li class="nav-header"><hr class="bg-light"></hr>LOGISTIK</li>
              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == 'logistik'  && ($this->uri->segment(2) == 'gudang' || $this->uri->segment(2) == 'masuk' || $this->uri->segment(2) == 'keluar')){ echo "menu-open";} ?>">
                  <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'logistik'  && ($this->uri->segment(2) == 'gudang' || $this->uri->segment(2) == 'masuk' || $this->uri->segment(2) == 'keluar')){ echo "active";} ?>">
                  <i class="nav-icon bi bi-house-gear-fill"></i>
                  <p>
                      Gudang
                      <i class="fas fa-angle-left right"></i>
                  </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <?php if (in_array('gudang', $permissions)) : ?>
                      <li class="nav-item">
                        <a href="<?= base_url('logistik/gudang')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'gudang'){ echo "active";} ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p> Stok Barang Gudang </p>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if (in_array('masuk', $permissions)) : ?>
                      <li class="nav-item">
                        <a href="<?= base_url('logistik/masuk')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'masuk'){ echo "active";} ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p> Barang Masuk </p>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if (in_array('keluar', $permissions)) : ?>
                      <li class="nav-item">
                        <a href="<?= base_url('logistik/keluar')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'keluar'){ echo "active";} ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p> Barang Keluar </p>
                        </a>
                      </li>
                    <?php endif; ?>
                    

                    
                    
                    
                  </ul>
              </li>

              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == 'logistik'  && ($this->uri->segment(2) == 'lokasi_gudang' || $this->uri->segment(2) == 'penyimpanan' || $this->uri->segment(2) == 'kategori' || $this->uri->segment(2) == 'jenis' ||$this->uri->segment(2) == 'satuan')){ echo "menu-open";} ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'logistik'  && ($this->uri->segment(2) == 'lokasi_gudang' || $this->uri->segment(2) == 'penyimpanan' || $this->uri->segment(2) == 'kategori' || $this->uri->segment(2) == 'jenis' ||$this->uri->segment(2) == 'satuan')){ echo "active";} ?>">
                <i class="nav-icon bi bi-grid-1x2-fill"></i>
                <p>
                    Element
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('logistik/lokasi_gudang')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'lokasi_gudang'){ echo "active";} ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Lokasi Gudang </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url('logistik/penyimpanan')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'penyimpanan'){ echo "active";} ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Penyimpanan </p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="<?= base_url('logistik/kategori')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'kategori'){ echo "active";} ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Kategori </p>
                    </a>
                  </li>

                  <!-- <li class="nav-item">
                    <a href="<?= base_url('logistik/jenis')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'jenis'){ echo "active";} ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Jenis </p>
                    </a>
                  </li> -->

                  <li class="nav-item">
                    <a href="<?= base_url('logistik/satuan')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'satuan'){ echo "active";} ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Satuan </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == 'logistik'  && $this->uri->segment(2) == 'barang'){ echo "menu-open";} ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'logistik'  && $this->uri->segment(2) == 'barang'){ echo "active";} ?>">
                <i class="nav-icon bi bi-database-fill"></i>
                <p>
                    Master Data
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('logistik/barang')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'barang'){ echo "active";} ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Barang </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == 'logistik'  && $this->uri->segment(2) == 'barang_masuk'){ echo "menu-open";} ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'logistik'  && $this->uri->segment(2) == 'barang_masuk'){ echo "active";} ?>">
                <i class="nav-icon bi bi-boxes"></i>
                <p>
                    Transaksi
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('logistik/barang_masuk')?>" class="nav-link <?php if ($this->uri->segment(1) == 'logistik' && $this->uri->segment(2) == 'barang_masuk'){ echo "active";} ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Barang Masuk</p>
                    </a>
                  </li>
                </ul>
              </li>
          <?php endif; ?>
          
          <li class="nav-header"><hr class="bg-light"></hr>KENDARAAN</li>

          <!-- <li class="nav-item">
            <a href="<?= base_url('kategori')?>" class="nav-link <?php if ($this->uri->segment(1) == 'kategori'){ echo "active";} ?>">
              <i class="nav-icon fas fa-list"></i>
              <p> Kategori </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview <?php if (($this->uri->segment(1) == 'kendaraan' || $this->uri->segment(1) == 'kendaraan_truck')  && $this->uri->segment(2) == ''){ echo "menu-open";} ?>">
              <a href="#" class="nav-link <?php if (($this->uri->segment(1) == 'kendaraan' || $this->uri->segment(1) == 'kendaraan_truck')  && $this->uri->segment(2) == ''){ echo "active";} ?>">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                  Kendaraan
                  <i class="fas fa-angle-left right"></i>
              </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('kendaraan')?>" class="nav-link <?php if ($this->uri->segment(1) == 'kendaraan' && $this->uri->segment(2) == ''){ echo "active";} ?>">
                      <i class="nav-icon fas fa-car"></i>
                      <p> Mobil & Motor </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url('kendaraan_truck')?>" class="nav-link <?php if ($this->uri->segment(1) == 'kendaraan_truck' && $this->uri->segment(2) == ''){ echo "active";} ?>">
                      <i class="nav-icon fas fa-truck-pickup"></i>
                      <p> Truck</p>
                    </a>
                  </li>
              </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="<?= base_url('kendaraan')?>" class="nav-link <?php if ($this->uri->segment(1) == 'kendaraan' && $this->uri->segment(2) == ''){ echo "active";} ?>">
              <i class="nav-icon fas fa-car"></i>
              <p> Kendaraan </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('kendaraan_truck')?>" class="nav-link <?php if ($this->uri->segment(1) == 'kendaraan_truck' && $this->uri->segment(2) == ''){ echo "active";} ?>">
              <i class="nav-icon fas fa-truck-pickup"></i>
              <p> Kendaraan Truck</p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?= base_url('p2h')?>" class="nav-link <?php if ($this->uri->segment(1) == 'p2h'){ echo "active";} ?>">
              <i class="nav-icon fas fa-list"></i>
              <p> P2H </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kendaraan/service')?>" class="nav-link <?php if ($this->uri->segment(1) == 'kendaraan' && $this->uri->segment(2) == 'service'){ echo "active";} ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p> Service </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if (($this->uri->segment(1) == 'transaksi' || $this->uri->segment(1) == 'transaksi_truck')  && $this->uri->segment(2) == ''){ echo "menu-open";} ?>">
              <a href="#" class="nav-link <?php if (($this->uri->segment(1) == 'transaksi' || $this->uri->segment(1) == 'transaksi_truck')  && $this->uri->segment(2) == ''){ echo "active";} ?>">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                  Transaksi
                  <i class="fas fa-angle-left right"></i>
              </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('transaksi')?>" class="nav-link <?php if ($this->uri->segment(1) == 'transaksi' && $this->uri->segment(2) == ''){ echo "active";} ?>">
                      <i class="nav-icon fas fa-car"></i>
                      <p> Transaksi Mobil & Motor </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url('transaksi_truck')?>" class="nav-link <?php if ($this->uri->segment(1) == 'transaksi_truck' && $this->uri->segment(2) == ''){ echo "active";} ?>">
                      <i class="nav-icon fas fa-truck-pickup"></i>
                      <p> Transaksi Truck</p>
                    </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('transaksi')?>" class="nav-link <?php if ($this->uri->segment(1) == 'transaksi'){ echo "active";} ?>">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p> Transaksi </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="<?= base_url('barang')?>" class="nav-link <?php if ($this->uri->segment(1) == 'barang'){ echo "active";} ?>">
              <i class="nav-icon fas fa-cubes"></i>
              <p> Barang </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('gambar_barang')?>" class="nav-link <?php if ($this->uri->segment(1) == 'gambar_barang'){ echo "active";} ?>">
              <i class="nav-icon fas fa-image"></i>
              <p> Gambar Barang </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/pesanan_masuk')?>" class="nav-link <?php if ($this->uri->segment(1) == 'admin' AND $this->uri->segment(2) == 'pesanan_masuk'){ echo "active";} ?>">
              <i class="nav-icon fas fa-download"></i>
              <p> Pesanan Masuk </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/setting')?>" class="nav-link <?php if ($this->uri->segment(1) == 'admin' AND $this->uri->segment(2) == 'setting'){ echo "active";} ?>">
              <i class="nav-icon fas fa-asterisk"></i>
              <p>Setting</p>
            </a>
          </li> -->

          <!-- <li class="nav-item">
            <a href="<?= base_url('user')?>" class="nav-link <?php if ($this->uri->segment(1) == 'user'){ echo "active";} ?>">
              <i class="nav-icon fas fa-users"></i>
              <p> User </p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="<?= base_url('laporan')?>" class="nav-link <?php if ($this->uri->segment(1) == 'laporan'){ echo "active";} ?>">
              <i class="nav-icon fas fa-paperclip"></i>
              <p>Laporan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('auth/logout_user')?>" class="nav-link">
              <i class="nav-icon fas fa-sign"></i>
              <p> Logout </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">