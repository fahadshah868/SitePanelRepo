<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
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
                        <a href="#storesuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-store-alt"></i>
                            Stores
                        </a>
                        <ul class="collapse list-unstyled" id="storesuboptions">
                            <li>
                                <a href="/addstore" class="sidebar-suboption">Add Store</a>
                            </li>
                            <li>
                                <a href="/allstores" class="sidebar-suboption">View Stores</a>
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
                                <a href="/addcategory" class="sidebar-suboption">Add Category</a>
                            </li>
                            <li>
                                <a href="/allcategories" class="sidebar-suboption">View Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#offertypesuboptions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-list-alt"></i>
                            Offer Type
                        </a>
                        <ul class="collapse list-unstyled" id="offertypesuboptions">
                            <li>
                                <a href="/addoffertype" class="sidebar-suboption">Add OfferType</a>
                            </li>
                            <li>
                                <a href="/alloffertypes" class="sidebar-suboption">View OfferTypes</a>
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
                                <a href="/alloffers" class="sidebar-suboption">View Offers</a>
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
                                <a href="/addproduct" class="sidebar-suboption">Add Product</a>
                            </li>
                            <li>
                                <a href="/allproducts" class="sidebar-suboption">View Products</a>
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
                <div id="panel-body-container" style="padding: 20px 30px;">
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
                $("#panel-body-container").load("/addstore");
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