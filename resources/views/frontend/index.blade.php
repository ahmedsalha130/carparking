<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.dashboardpack.com/adminty-html/default/sample-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 12 Mar 2022 17:48:52 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>Customer Dashboard</title>


    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">

    <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../files/assets/scss/partials/menu/_pcmenu.html">
<body>
@include('layouts.flash')

<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">


                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Hello Customer </h5>
                                    <span>{{auth()->user()->name}}</span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i>
                                            </li>
                                            <li><i class="feather icon-trash-2 close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <p>
                                        <b>"You can return to the application and enter the new password
                                        If there is any problem, you can send a message to technical support<br>
                                        Email :admin@carparking.tech"<b>
                                    </p>
                                    <button href="{{ route('admin.logout')}}') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="feather icon-log-out"></i> Logout
                                    </button>
                                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="../files/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<script type="text/javascript" src="../files/bower_components/modernizr/modernizr.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

<script type="text/javascript" src="../files/bower_components/i18next/i18next.min.js"></script>
   
<script type="text/javascript" src="../files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
   
<script type="text/javascript" src="../files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
   
<script type="text/javascript" src="../files/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
<script src="../files/assets/js/pcoded.min.js"></script>
<script src="../files/assets/js/vartical-layout.min.js"></script>
<script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript" src="../files/assets/js/script.js"></script>
</body>
