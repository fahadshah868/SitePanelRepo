<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>    
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script> <!--jquery for datepicker-->
    <script src="{{asset('js/jquery.validate.js')}}"></script> <!--jquery for validate forms-->
    <script src="{{asset('js/bootstrap-multiselect.js')}}"></script> <!--jquery for multiselect dropdown-->
    <!-- Popper.JS -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script> <!--jquery for bootstrap-->
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script> <!--jquery for single select with search box-->

    <div class="body-main-content" id="body-main-content">
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Site Panel</h3>
                    <strong>SP</strong>
                </div>
                <ul class="list-unstyled components">
                    @if(Auth::User()->role == "admin")
                    <li>
                        <a href="#adminsuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-user"></i>
                            Admin
                        </a>
                        <ul class="collapse list-unstyled" id="adminsuboptions">
                            <li>
                                <a href="/adduser" class="sidebar-suboption">Add User</a>
                            </li>
                            <li>
                                <a href="/allusers" class="sidebar-suboption">View Users</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li>
                        <a href="#networksuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-sitemap"></i>
                            Network
                        </a>
                        <ul class="collapse list-unstyled" id="networksuboptions">
                            <li>
                                <a href="/addnetwork" class="sidebar-suboption">Add Network</a>
                            </li>
                            <li>
                                <a href="/allnetworks" class="sidebar-suboption">View Networks</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#categorysuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-tag"></i>
                            Category
                        </a>
                        <ul class="collapse list-unstyled" id="categorysuboptions">
                            <li>
                                <a href="/addcategory" class="sidebar-suboption">Add Category</a>
                            </li>
                            <li>
                                <a href="/todayallcategories" class="sidebar-suboption">View Today's Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#storesuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-store-alt"></i>
                            Store
                        </a>
                        <ul class="collapse list-unstyled" id="storesuboptions">
                            <li>
                                <a href="/addstore" class="sidebar-suboption">Add Store</a>
                            </li>
                            <li>
                                <a href="/todayallstores" class="sidebar-suboption">View Today's Stores</a>
                            </li>
                            <li>
                                <a href="/allstorecategories" class="sidebar-suboption">View Store Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#offersuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-code"></i>
                            Offer
                        </a>
                        <ul class="collapse list-unstyled" id="offersuboptions">
                            <li>
                                <a href="/addoffer" class="sidebar-suboption">Add Offer</a>
                            </li>
                            <li>
                                <a href="/todayalloffers" class="sidebar-suboption">View Today's Offers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#carouseloffersuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-shopping-bag"></i>
                            Carousel Offer
                        </a>
                        <ul class="collapse list-unstyled" id="carouseloffersuboptions">
                            <li>
                                <a href="/addcarouseloffer" class="sidebar-suboption">Add Carousel Offer</a>
                            </li>
                            <li>
                                <a href="/todayallcarouseloffers" class="sidebar-suboption">View Today Carousel Offers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#blogsuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-shopping-bag"></i>
                            Blog
                        </a>
                        <ul class="collapse list-unstyled" id="blogsuboptions">
                            <li>
                                <a href="/addblog" class="sidebar-suboption">Add Blog</a>
                            </li>
                            <li>
                                <a href="/allblogs" class="sidebar-suboption">View Blogs</a>
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
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#topnavbar" aria-controls="topnavbar" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="topnavbar">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/updateprofile" id="updateprofile"><i class="fa fa-user"></i>Update Profile</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="/logout"><i class="fa fa-sign-out-alt"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="panel-body-container" style="padding: 20px;">
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            //by default active first link and sub-link
            $("#sidebar ul a:first").addClass("activelink");
            $("#sidebar ul ul a:first").addClass("activesublink");
            
            if('{{Auth::User()->role}}' == "admin"){
                $("#panel-body-container").load("/adduser");
            }
            else{
                $("#panel-body-container").load("/addnetwork");
            }

            //when resize browser window
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            //active link and sub-link when click on sidebar link
            $("#sidebar ul ul a, #topnavbar ul a:first").click(function(event){
                event.preventDefault();
                if($(this).hasClass("sidebar-suboption")){
                    $("#topnavbar ul a").removeClass("activelink");
                    $("#sidebar ul ul a").removeClass("activesublink");
                    $("#sidebar ul a").removeClass("activelink");
                    $(this).addClass("activesublink");
                    $(this).parent().parent().siblings().addClass("activelink");
                    $("#panel-body-container").load($(this).attr('href'));
                }
                else{
                    $("#sidebar ul a").removeClass("activelink");
                    $("#topnavbar ul a").removeClass("activelink");
                    $("#sidebar ul ul a").removeClass("activesublink");
                    $(this).addClass("activelink");
                    $("#panel-body-container").load($(this).attr('href'));
                }
            });
        });
    </script>
</body>
</html>