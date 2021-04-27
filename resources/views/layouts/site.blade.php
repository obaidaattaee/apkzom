<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web</title>
    <link href="{{ asset('bower_components/web_design/css/custom.css') }}" rel="stylesheet">
    <!-- Bootstrap css -->
    <link href="{{ asset('bower_components/web_design/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Font Awesome Library for icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous"/>
</head>
<body >
<div x-data="data()">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="img/logo.jpg" class="img-responsive logo-style" alt="img"/>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
@php
    $gameAppCategories = Cache::remember('gameAppCategories', 3600, function (){
            return App\Models\Category::find([App\Models\Category::CATEGORIES[0]['id'] , App\Models\Category::CATEGORIES[1]['id']]);
        });
@endphp
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('search' , ['ci' => 1 , 'title' => str_replace(' ' , '-' , $gameAppCategories->find(App\Models\Category::CATEGORIES[0]['id'])->translation('title' , app()->getLocale()))]) }}">
                                    <i class="{{ $gameAppCategories->find(App\Models\Category::CATEGORIES[0]['id'])->icon }} menu-icons"></i>
                                    {{ $gameAppCategories->find(App\Models\Category::CATEGORIES[0]['id'])->translation('title' , app()->getLocale()) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('search' , ['ci' => 2 , 'title' => str_replace(' ' , '-' , $gameAppCategories->find(App\Models\Category::CATEGORIES[1]['id'])->translation('title' , app()->getLocale()))]) }}">
                                    <i class="{{ $gameAppCategories->find(App\Models\Category::CATEGORIES[1]['id'])->icon }} menu-icons"></i>
                                    {{ $gameAppCategories->find(App\Models\Category::CATEGORIES[1]['id'])->translation('title' , app()->getLocale()) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('search' , ['sort' => __('search.download')]) }}">
                                    <i class="fa fa-download menu-icons"></i>
                                    Downloads
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false"> <i class="fa fa-cogs menu-icons"></i>
                                    Products <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user-o menu-icons"></i>
                                    Contact
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="clear-div"></div>

    @yield('content')

    <div class="clear-div"></div>
    <div class="footer-container">
        <div class="footer-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <h3 class="f02">Solutions</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="">
                                    Order Lookup
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Messenger APK Sols
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Request
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Order Lookup
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Messenger APK
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Request Refund
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h3 class="f02">Top Developers</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="">
                                    Order Lookup
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Alpha Lite
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Request Refund
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Order Lookup
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Facebook Lite
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Youtube Apk
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h3 class="f02">Legal</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Terms & Conditions
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Privacy
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Terms & Conditions
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Privacy
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h3 class="f02">Contact Us</h3>
                        <ul class="footer-list">
                            <li>
                                Some text Here..
                            </li>
                            <li>
                                Abc Road, Xyz New City
                            </li>
                            <li class="mt-10">
                                <i class="fa fa-envelope"></i>
                                abc@web.com
                            </li>
                            <li class="mt-10">
                                <i class="fa fa-phone"></i>
                                (92) 12 12 102
                            </li>
                            <li class="footer-social-list mt-10">
                                <a href="">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-telegram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script !src="">
    function data() {
        return {
            searchItems: [],
            searchValue: '',
            search: function (event){
                this.searchValue = event.target.value;
            }
        }
    }
</script>
<!--JQUERY AND BOOTSTRAP JS REFERENCE LINK-->
<script src="{{ asset('bower_components/web_design/js/jquery.js') }}"></script>
<script src="{{ asset('bower_components/web_design/js/bootstrap.min.js') }}"></script>
</body>
</html>
