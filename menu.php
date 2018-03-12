<?php
ini_set('display_errors',on); 
error_reporting(-1);

include ("Settings.php");
include ("restHttpCaller.php");
include ('WDTicketPaymentFormRequest.php');
include ('Helper.php');
include ('BaseModel.php');
include ('CCProxySaleRequest.php');
include ('MarketPlaceAddSubPartnerOrUpdateRequest.php');
include ('MarketPlaceDeactiveSubPartnerRequest.php');
include ('MarketPlaceSale3DSecOrMpSaleRequest.php');
include ('MarketPlaceReleasePaymentRequest.php');
include ('MarketPlaceMpSaleRequest.php');
include ('CCProxySale3DSecureRequest.php');
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WireCard Developer Portal</title>
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../Assets/css/jquery.mCustomScrollbar.min.css" rel="stylesheet" />
    <!-- Our Custom CSS -->
    <link href="../Assets/css/style.css" rel="stylesheet" />
    <link rel="icon" href="~/favicon.ico">
    <!-- Scrollbar Custom CSS -->
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="/"><img src="../Assets/img/logo.png" width="130" height="26" /></a>
                
            </div>
            <ul class="list-unstyled components">
            <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Sms Ödeme Servisleri</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="index.php">Basic Api </a></li>
                <li><a href="ProApi.php">Pro Api</a></li>
                <li><a href="ApiPlus.php">Api Plus</a></li>
                <li><a href="SendInformationSmsService.php">Bilgi Sms Gönderim Servisi</a></li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Abonelik Servisleri</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="SelectSubscriber.php">Abonelik Listeleme</a></li>
                <li><a href="SelectSubscriberDetail.php">Abonelik Detay</a></li>
                <li><a href="DeactivateSubscriber.php">Abone Sil</a></li>
            </ul>
        </li>
        <li>
            <a href="#paymentForm" data-toggle="collapse" aria-expanded="false">Ödeme Formu</a>
            <ul class="collapse list-unstyled" id="paymentForm">
                <li><a href="CCProxySale3DSecure.php">3D Secure İle Ödeme</a></li>
                <a href="CCProxySale.php">3d Secure Olmadan Ödeme Formu</a>
               
            </ul>
        </li>
        <li>
          
            
        </li>
        <li>
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false">Ortak Ödeme Formu</a>
            <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li><a href="WDTicketSale3DURLProxy.php">3D Secure İle ödeme</a></li>
                <li><a href="WDTicketSaleURLProxy.php">3D Secure Olmadan Ödeme</a></li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false">Mağaza Servisleri</a>
            <ul class="collapse list-unstyled" id="pageSubmenu3">
                <li><a href="MarketPlaceAddSubPartner.php">Mağaza Oluştur</a></li>
                <li><a href="MarketPlaceUpdateSubPartner.php">Mağaza Güncelle</a></li>
                <li><a href="MarketPlaceDeactiveSubPartner.php">Mağaza Sil</a></li>
                <li><a href="MarketPlaceSale3DSec.php">3D Secure ile Ödeme </a></li>
                <li><a href="MarketPlaceMPSale.php">3D Secure olmadan Ödeme </a></li>
                <li><a href="MarketPlaceReleasePayment.php">Ödeme Onay Servisi </a></li>
            </ul>
        </li>
        <li>
            <a href="#transactionQuery" data-toggle="collapse" aria-expanded="false">İşlem Sorgulama</a>
            <ul class="collapse list-unstyled" id="transactionQuery">
                <li><a href="TransactionQueryOrder.php">Sipariş Numarası ile İşlem Sorgulama</a></li>
                <li><a href="TransactionQueryMPay.php">MPAY ile İşlem Sorgulama</a></li>
            </ul>
        </li>
            </ul>  
        </nav>
        <div id="content">
            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                        </button>
                    </div>
                </div>
            </nav>