    <?php 
          include "inc/header.php";
    ?>
  <body id="mimin" class="dashboard">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="index.html" class="navbar-brand"> 
                 <b>BOOKING</b>
                </a>

              <ul class="nav navbar-nav search-nav">
                <li>
                   <div class="search">
                    <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                    <div class="form-group form-animate-text">
                      <input type="text" class="form-text" required>
                      <span class="bar"></span>
                      <label class="label-search"><b>Search</b> </label>
                    </div>
                  </div>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right user-nav">
              <?php 
                  $pinjams = $client->get_collection('pinjams');
                  $total = 0;
                  while ($pinjams->has_next_entity()) {             
                    $pinjam = $pinjams->get_next_entity();
                    $total++;
                  }
              ?>
                  <li><a href="?page=approval-queue">Menunggu Konfirmasi <span class="badge badge-primary"><?=$total?></span></a></li>
                  <li class="user-name"><span>Alif Farhan Arizkia</span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-power-off "></span></a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li ><a href="#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
          <!-- start:Left Menu -->
            <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <li class="time">
                      <h1 class="animated fadeInLeft">21:00</h1>
                      <p class="animated fadeInRight">Sat,October 1st 2029</p>
                    </li>
                    <li class="<?=$aktif[0]?> ripple">
                      <a href="?page=dashboard"><span class="icon-home fa"></span> Dashboard</a>
                    </li>
                    <li class="<?=$aktif[1]?> ripple">
                      <a class="tree-toggle nav-header">
                        <span class="icon-calendar fa"></span> Jadwal
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li class="<?=$aktifsub[0]?> "><a href="?page=calendar"><span class="fa-calendar fa"></span> Kalender</a></li>
                        <li class="<?=$aktifsub[1]?>"><a href="?page=list-booking"><span class="fa-calendar-check-o fa"></span> List booking</a></li>
                        <li class="<?=$aktifsub[2]?>"><a href="?page=search-room"><span class="fa-search fa"></span> Cari ruangan</a></li>
                        <li class="<?=$aktifsub[3]?>"><a href="?page=approval-queue"><span class="fa-book fa"></span> Approval queue</a></li>
                      </ul>
                    </li>
                    <li class="<?=$aktif[2]?> ripple"><a class="tree-toggle nav-header">
                        <span class="icon-notebook fa"></span> Manage
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li class="<?=$aktifsub[4]?>"><a href="?page=building"><span class="fa-cube fa"></span> Gedung</a></li>
                        <li class="<?=$aktifsub[4]?>"><a href="?page=meeting-rooms"><span class="fa-cube fa"></span> Ruangan</a></li>
                        <li class="<?=$aktifsub[5]?>"><a href="?page=meeting-type"><span class="fa-suitcase fa"></span> Meeting type</a></li>
                        <li class="<?=$aktifsub[6]?>"><a href="?page=resource"><span class="fa-tasks fa"></span> Ketersediaan</a></li>
                        <li class="<?=$aktifsub[7]?>"><a href="?page=location"><span class="fa-map-marker fa"></span> Lokasi</a></li>
                        <li class="<?=$aktifsub[8]?>"><a href="?page=users"><span class="fa-users fa"></span> Users</a></li>
                      </ul>
                    </li>
                    <li class="<?=$aktif[3]?> ripple">
                        <a href="?page=reports"><span class="icon-chart"></span> Reports </a>
                    </li>
                    <li class="<?=$aktif[4]?> ripple"><a href="?page=help"><span class="icon-question"></span> Helps</a></li>
                  </ul>
                </div>
            </div>
          <!-- end: Left Menu -->
          <?php
              include $include;
          ?>
            <!-- end: Javascript -->
  </body>
</html>