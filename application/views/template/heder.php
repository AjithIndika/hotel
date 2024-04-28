<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="LankaHall Hotel System">
        <meta name="author" content="Lanka Hall">
        <meta name="keywords" content="web base system,online system,hotel management">
        

        <!-- Title Page-->
        <title><?php echo $page_title ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('images/icon/logo.png') ?>" />

         <!---  numpad !--->
         <link rel="stylesheet" href="<?php echo base_url('vendor/numpad/jquery.numpad.css') ?>">
        <script type="text/javascript" src="<?php echo base_url('vendor/numpad/jquery.numpad.js') ?>"></script>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/main.css') ?>">
        <!-- Bootstrap js -->
        <script src="<?php echo base_url('js/bootstrap.min.js') ?>" ></script>
        <script src="<?php echo base_url('js/jquery-3.2.1.slim.min.js') ?>" ></script>
        <script src="<?php echo base_url('js/popper.min.js') ?>" ></script>
        <link rel="stylesheet" href="<?php echo base_url('fontawesome-free-5.13.0-web/css/all.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/4bootstrap.min.css') ?>">
        <!--- !-------->
        <script src="<?php // echo base_url('tabal/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('vendor/bootstrap-4.1/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('tabal/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('tabal/js/dataTables.bootstrap4.min.js') ?>"></script>
        
        <script src="<?php echo base_url('tabal/js/jquery-3.3.1.js') ?>"></script>
        <link href="<?php  echo base_url('tabal/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" media="all">
        
   
        <script src="<?php echo base_url('tabal/js/Tjquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('tabal/js/TdataTables.bootstrap4.min.js')?>"></script>
       
        
       
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>
        
        
        
        

    </head>
    <body onload="printContent()">
