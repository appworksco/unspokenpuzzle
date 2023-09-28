<?php

session_start();
ob_start();

$invalid = array();
$success = array();
$info = array();

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Appworks Co.">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
  <title>Unspoken Puzzle</title>
  <!-- User links -->
  <link href="./assets/libs/flot/css/float-chart.css" rel="stylesheet">
  <link href="./dist/css/custom-style.css" rel="stylesheet">
  <link href="./dist/css/style.min.css" rel="stylesheet">
  <!-- Admin links -->
  <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
  <link href="../assets/extra-libs/multicheck/multicheck.css" rel="stylesheet">
  <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="../dist/css/custom-style.css" rel="stylesheet">
  <link href="../dist/css/style.min.css" rel="stylesheet">
</head>
<body>