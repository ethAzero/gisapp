<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js" lang="ID">
<head>
<title><?php echo $title ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php //echo $deskripsi ?>"/>
<meta name="robots" content="index, follow">
<meta name="author" content="<?php //echo $meta->nm_website ?>">
<meta name="keywords" content="<?php //echo $keyword ?>">
<meta name="author" content="<?php //echo $meta->nm_website ?>">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Copyright" content="<?php //echo $meta->nm_website ?>">
<meta name="revisit-after" content="3">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">
<meta property="og:locale" content="id_ID"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $title ?>"/>
<meta property="og:description" content="<?php //echo $deskripsi ?>"/>
<meta property="og:site_name" content="<?php //echo $meta->nm_website ?>"/>
<meta property="og:image" content="<?php //echo $image ?>"/>
<meta property="og:image:width" content="800"/>
<meta property="og:image:height" content="500"/>


<link rel="icon" href="<?php echo base_url() ?>assets/theme/img/icon.png" type="image/png">
<link href="<?php echo base_url() ?>assets/theme/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/theme/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/theme/css/style.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/theme/css/jquery.fancybox.min.css" rel="stylesheet">
<style>
   #map {
      height: 100%;
      width: 100%;
   }
</style>
</head>
<body>
	<div id="wrapper">