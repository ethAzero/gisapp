<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <title><?php echo $title ?></title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="icon" href="<?php echo base_url() ?>assets/admin/icon.png" sizes="32x32">
   <link href="<?php echo base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/select2/select2.css" rel="stylesheet" />
   <link href="<?php echo base_url() ?>assets/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/growl/jquery.growl.css" rel="stylesheet" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/datepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
   <script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/admin/plugins/select2/select2.full.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
   <script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/admin/js/latae.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/admin/plugins/growl/jquery.growl.js"></script>
   <style>
      #map {
         height: 100% !important;
         width: 100% !important;
      }

      .icon-apill {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/traffic-light.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }

      .icon-cermin {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/cermin.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }

      .icon-delinator {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/delinator.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }

      .icon-flash {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/flash.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }

      .icon-guardrail {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/guardrail.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }

      .icon-pju {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/pju.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }

      .icon-rambu {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/rambu.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }

      .icon-rppj {
         width: 75px;
         height: 75px;
         background: #eee;
         background: url("<?= base_url('assets/theme/img/rppj.png') ?>   ");
         float: left;
         background-size: 100% auto;
         /*extra fluff*/
         margin: 7px;
         border-radius: 5px;
      }
   </style>
</head>

<body class="skin-blue fixed sidebar-mini">
   <div class="wrapper">