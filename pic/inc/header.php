<?php
    include 'config/config.php';
    isset($_GET["page"]) ? $page = $_GET["page"] : $page="";
      /*Main menu active*/
      $aktif[0]="";
      $aktif[1]="";
      $aktif[2]="";
      $aktif[3]="";
      $aktif[4]="";

      /*Sub menu active*/
      $aktifsub[0]="";
      $aktifsub[1]="";
      $aktifsub[2]="";
      $aktifsub[3]="";
      $aktifsub[4]="";
      $aktifsub[5]="";
      $aktifsub[6]="";
      $aktifsub[7]="";
      $aktifsub[8]="";
      $aktifsub[9]="";

      switch ($page) { 
          default : $include = "page/dashboard.php";
          /*Dashbord*/
          case "dashboard" : 
                $include = "page/dashboard.php"; 
                $aktif[0]="active"; 
                $current="Dashboard";
                $css = '<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css"/>';
                $js = '<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>';
          break;
          /*Schedule*/
          case "calendar" : 
                $include = "page/calendar.php";
                $aktif[1]="active";
                $aktifsub[0]="active";
                $current="Calendar";
                $css = '<link rel="stylesheet" type="text/css" href="asset/css/plugins/fullcalendar.min.css"/>';
                $js = '<script src="asset/js/plugins/fullcalendar.min.js"></script>';
          break;
          case "list-booking" : $include = "page/list-booking.php"; $aktif[1]="active";$aktifsub[1]="active"; $current="Dashboard"; break;
          case "search-room" : $include = "page/search-room.php"; $aktif[1]="active";$aktifsub[2]="active"; $current="Dashboard"; break;
          case "approval-queue" : 
                $include = "page/approval-queue.php"; 
                $aktif[1]="active";
                $aktifsub[3]="active"; 
                $current="Dashboard"; 
                $css = '<link rel="stylesheet" type="text/css" href="asset/css/plugins/datatables.bootstrap.min.css"/>';
                $js = '<script src="asset/js/plugins/jquery.datatables.min.js"></script>';
                $js.= '<script src="asset/js/plugins/datatables.bootstrap.min.js"></script>';
          break;

          /*Manage*/
          case "building" : 
                $include = "page/building.php"; 
                $aktif[2]="active";
                $aktifsub[4]="active";
                $current="Dashboard"; 
                $css = '<link rel="stylesheet" type="text/css" href="asset/css/plugins/datatables.bootstrap.min.css"/>';
                $js = '<script src="asset/js/plugins/jquery.datatables.min.js"></script>';
                $js.= '<script src="asset/js/plugins/datatables.bootstrap.min.js"></script>';
          break;
          case "meeting-rooms" : 
                $include = "page/meeting-rooms.php"; 
                $aktif[2]="active";
                $aktifsub[5]="active"; 
                $current="Dashboard"; 
                $css = '<link rel="stylesheet" type="text/css" href="asset/css/plugins/datatables.bootstrap.min.css"/>';
                $css = '<link rel="stylesheet" type="text/css" href="asset/css/plugins/select2.min.css"/>';
                $js = '<script src="asset/js/plugins/jquery.datatables.min.js"></script>';
                $js.= '<script src="asset/js/plugins/datatables.bootstrap.min.js"></script>';
                $js.= '<script src="asset/js/plugins/select2.full.min.js"></script>';
          break;
          case "meeting-type" : $include = "page/meeting-type.php"; $aktif[2]="active";$aktifsub[6]="active"; $current="Dashboard"; break;
          case "resource" : $include = "page/resource.php"; $aktif[2]="active";$aktifsub[7]="active"; $current="Dashboard"; break;
          case "location" : $include = "page/location.php"; $aktif[2]="active";$aktifsub[8]="active"; $current="Dashboard"; break;
          case "users" : $include = "page/users.php"; $aktif[2]="active";$aktifsub[9]="active"; $current="Dashboard"; break;

          /*Reports*/
          case "reports" : $include = "page/reports.php"; $aktif[3]="active"; $current="Dashboard"; break;

          /*Helps*/
          case "help" : $include = "page/help.php"; $aktif[4]="active"; $current="Dashboard"; break;
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Miminium Admin Template v.1">
	<meta name="author" content="Isna Nur Azis">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

      <!-- plugins -->
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
	    <link href="asset/css/style.css" rel="stylesheet">
      <?=@$css?>
	<!-- end: Css -->

	<link rel="shortcut icon" href="asset/img/logomi.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>