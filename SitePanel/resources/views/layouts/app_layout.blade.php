<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    
    <div class="body-main-content">
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Site Panel</h3>
                    <strong>SP</strong>
                </div>
                <ul class="list-unstyled components">
                    <li>
                        <a href="#adminsuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-user"></i>
                            Admin
                        </a>
                        <ul class="collapse list-unstyled" id="adminsuboptions">
                            <li>
                                <a href="/adduser" id="addstore">Add User</a>
                            </li>
                            <li>
                                <a href="/viewallusers" id="viewstore">View Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#storesuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-store-alt"></i>
                            Stores
                        </a>
                        <ul class="collapse list-unstyled" id="storesuboptions">
                            <li>
                                <a href="/addstore" id="addstore">Add Store</a>
                            </li>
                            <li>
                                <a href="/viewallstores" id="viewstore">View Stores</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#categorysuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-tag"></i>
                            Categoies
                        </a>
                        <ul class="collapse list-unstyled" id="categorysuboptions">
                            <li>
                                <a href="/addcategory">Add Category</a>
                            </li>
                            <li>
                                <a href="/viewallcategories">View Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#couponsuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-code"></i>
                            Coupon
                        </a>
                        <ul class="collapse list-unstyled" id="couponsuboptions">
                            <li>
                                <a href="/addcoupon">Add Coupons</a>
                            </li>
                            <li>
                                <a href="/viewallcoupons">View Coupons</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#productsuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-shopping-bag"></i>
                            Product
                        </a>
                        <ul class="collapse list-unstyled" id="productsuboptions">
                            <li>
                                <a href="/addproduct">Add Product</a>
                            </li>
                            <li>
                                <a href="#">View Products</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">

                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/updateprofile"><i class="fa fa-user"></i>Update Profile</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="#"><i class="fa fa-sign-out-alt"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="panel-body-container" style="padding: 20px 30px;">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
        $(document).ready(function () {
            //by default active first link and sub-link
            $("#sidebar ul a:first").addClass("sidebar-activelink");
            $("#sidebar ul ul a:first").addClass("sidebar-activesublink");
            //when resize browser window
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            //active link and sub-link when click on sidebar link
            $("#sidebar ul ul a").click(function(){
                $("#sidebar ul ul a").removeClass("sidebar-activesublink");
                $(this).addClass("sidebar-activesublink");
                $("#sidebar ul a").removeClass("sidebar-activelink");
                $(this).parent().parent().siblings().addClass("sidebar-activelink");
            });
        });

    </script>
</body>
</html>