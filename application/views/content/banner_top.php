
<script type="text/javascript">
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
</script>
<style type="text/css">
/*  .enable-bootstrap .navbar-default{
    background: #5bc0de;
  }
  .enable-bootstrap .navbar-default .navbar-nav li a{
    color: white;
  }
  .enable-bootstrap .navbar-default .navbar-nav li a:hover{
    font-weight: bold;
    color:white;
  }
*/
.affix{
  top:0;
  width: 100%;
  z-index: 9999999 !important;
}
.enable-bootstrap.affix + #content{
  padding-top: 70px;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $('.navbar').affix({offset: {top: 148} }); 
     $(".navbar").on("affix.bs.affix", function() {
      alert("affixed");
    });
  })
</script>
<div class="enable-bootstrap">
  <div id="banner-top">
    <script type="text/javascript">
        function updateClock() {
            // Gets the current time
            var now = new Date();

            // Get the hours, minutes and seconds from the current time
            var day = now.getDate() + "/" + (parseInt(now.getMonth()) + 1) + "/" + now.getFullYear();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Format hours, minutes and seconds
            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }

            // Gets the element we want to inject the clock into
            var elem = document.getElementById('clock');

            // Sets the elements inner HTML value to our clock data
            elem.innerHTML = "Date/Time : " + day + " " + hours + ':' + minutes + ':' + seconds;
        }

    </script>
    
    <?php
        $appconfig = $app_config->row();
    ?>
    <h1><?php echo $appconfig->app_title; ?></h1>
    <p style="margin-left: 10px;">
        <?php
        $this->load->helper('date');
        $row = $result->row();

        if ($row->emp_role == 1 || $row->emp_role == 3) {
            echo $row->emp_firstname ;
        } else {
            echo $row->emp_firstname . " / " . $row->job_code . "-" . $row->id_emp . "/" . $row->org_code;
        }

        ?>
    </p>
    <p style="margin-left: 10px;" id="clock">
    </p>
</div> 

<nav class="navbar navbar-default" >

  <div class="container">
    <?php 
  $dat = $result->row();
        if ($dat->emp_role == 1) {
            ?>
      <ul  class="nav navbar-nav">
        <li><a href="<?php echo site_url("site/admin_dashboard") ?>">Dashboard</a></li>
        <li><a href="<?php echo site_url("site/admin_anggaran") ?>">Anggaran</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Organisasi <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("org") ?>">Daftar Organisasi</a></li>
            <li><a href="<?php echo site_url("org/add_org") ?>">Tambah Organisasi</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jabatan <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("jobs") ?>">Daftar Jabatan</a></li>
            <li><a href="<?php echo site_url("jobs/form_job") ?>">Tambah Jabatan</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pegawai<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("emp") ?>">Daftar Pegawai</a></li>
            <li><a href="<?php echo site_url("emp/add_emp") ?>">Tambah Pegawai</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Konfigurasi<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("sppd_config") ?>">Konfigurasi Flow SPPD</a></li>
            <li><a href="<?php echo site_url("notadinas/config") ?>">Konfigurasi Nomor Surat Dinas</a></li>
            <li><a href="<?php echo site_url("notadinas/kop") ?>">Konfigurasi Template Kop Surat</a></li>
            <li><a href="<?php echo site_url("admin") ?>">Konfigurasi Admin</a></li>
            <li><a href="<?php echo site_url("absensi/config") ?>">Konfigurasi Absensi</a></li>
            <li><a href="<?php echo site_url("cuti/config") ?>">Konfigurasi Apliaksi Cuti</a></li>
            <li><a href="<?php echo site_url("email/config") ?>">Konfigurasi Webmail</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li>
           <a href="#">Notifications</a> 
        </li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("utilities/change_password_view") ?>">Ganti Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url("login/signout") ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
      <?php }
else if ($dat->emp_role == 3) {
            ?>

<ul class="nav navbar-nav">
     <li ><a href="<?php echo base_url() ?>index.php/site/home_reservation" style="height:15px;line-height:15px;">Home</a></li>
     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Request Reservasi<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li ><a href="<?php echo base_url(); ?>index.php/reservation/view_all_reservation">Lihat Semua Request Perlu Diproses</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/reservation/finish_reservation">Lihat Semua Reservasi Selesai Diproses</a></li>
                    </ul>
                </li>
              
</ul>
 <ul class="nav navbar-nav navbar-right">
        <!-- <li>
           <a href="#">Notifications</a> 
        </li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("utilities/change_password_view") ?>">Ganti Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url("login/signout") ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
            <?php }
      else{
        ?>
    <ul  class="nav navbar-nav">
         <a href="<?php echo site_url() ?>" class="navbar-brand">Notifikasi</a>
           
             <li class="dropdown">
              <a href="<?php echo site_url("not_installed") ?>">SPPD</a>
            </li>
            <li >
              <a href="<?php echo site_url("notadinas/index") ?>">Surat Dinas </a>
            </li>
            <li class="dropdown">
              <a  href="<?php echo site_url("not_installed") ?>" >Cuti</a>
            </li>
            <li >
              <a href="<?php echo site_url("not_installed") ?>">Absen </a>
            </li>

            <li >
              <a  href="<?php echo site_url("not_installed") ?>">Email </a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <!-- <li>
           <a href="#">Notifications</a> 
        </li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("utilities/edit_profile_view") ?>">Edit Profile</a></li>
            <li><a href="<?php echo site_url("utilities/change_password_view") ?>">Ganti Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url("login/signout") ?>">Logout</a></li>
          </ul>
        </li>
      </ul>

      <?php

      } ?>
  </div>

</nav>
</div>
<?php //$this->load->view('content/sidemenu3'); ?> 