@extends('layouts.site')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="slider mt-30">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    @foreach($sliders as $key => $slider)
                                        <li data-target="#myCarousel" data-slide-to="{{ $key }}"
                                            class="{{ $key == 0 ? "active" : "" }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($sliders as $key => $slider)
                                        <div class="item {{ $key == 0 ? "active" : "" }}">
                                            <img src="{{  $slider->image_file }}" alt="{{ $slider->translation('image_alt' , app()->getLocale()) }}"
                                            title="{{ $slider->translation('image_title' , app()->getLocale()) }}"     class="img-responsive center-all">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                <h2 class="panel-title p-title">Discover</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    @foreach($games as $game)
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="p-panel">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <img
                                                            src="{{ asset('uploads/' . $game->images()->first()->path) }}"
                                                            class="img-responsive p-img"
                                                            alt="img"/>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                        <h4 class="p-head">{{ $game->translation('title' , app()->getLocale())}}</h4>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <p class="p-date">
                                                            {{ $game->published_at }}
                                                        </p>
                                                        <p>
                                                            <a href="" class="btn btn-info p-btn">Download</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                <h2 class="panel-title p-title">{{ __('common.popular_apps') }}</h2>
                            </div>
                            <div class="panel-body">

                                <!--  -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#p01">{{ __('common.popular_games') }}</a></li>
                                    <li><a data-toggle="tab" href="#p02">{{ __('common.popular_apps') }}</a></li>
                                </ul>

                                <div class="tab-content mt-20">
                                    <div id="p01" class="tab-pane fade in active">
                                        <div class="row">
                                            @foreach($games as $game)
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="p-panel">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <img
                                                                    src="{{ asset('uploads/' . $game->images()->first()->path) }}"
                                                                    class="img-responsive p-img"
                                                                    alt="img"/>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                                <h4 class="p-head">{{ $game->translation('title' , app()->getLocale() )}}</h4>
                                                                <div class="ratings">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                </div>
                                                                <p class="p-date">
                                                                    {{ $game->published_at }}
                                                                </p>
                                                                <p>
                                                                    <a href="" class="btn btn-info p-btn">Download</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="p02" class="tab-pane fade">
                                        <div class="row">
                                            @foreach($apps as $app)
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="p-panel">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <img
                                                                    src="{{ asset('uploads/' . $app->images()->first()->path) }}"
                                                                    class="img-responsive p-img"
                                                                    alt="img"/>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                                <h4 class="p-head">{{ $app->translation('title' , app()->getLocale()) }}</h4>
                                                                <div class="ratings">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                </div>
                                                                <p class="p-date">
                                                                    {{ $app->published_at }}
                                                                </p>
                                                                <p>
                                                                    <a href="" class="btn btn-info p-btn">Download</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <!--  -->


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                <h2 class="panel-title p-title">Coming Soon Games/Apps</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                         alt="img"/>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                    <h4 class="p-head">Snoppy Spot</h4>
                                                    <p class="p-text-sm">
                                                        Some text here
                                                    </p>
                                                    <p class="coming-soon">
                                                        COMING SOON</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                         alt="img"/>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                    <h4 class="p-head">Snoppy Spot</h4>
                                                    <p class="p-text-sm">
                                                        Some text here
                                                    </p>
                                                    <p class="coming-soon">
                                                        COMING SOON
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                         alt="img"/>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                    <h4 class="p-head">Snoppy Spot</h4>
                                                    <p class="p-text-sm">
                                                        Some text here
                                                    </p>
                                                    <p class="coming-soon">
                                                        COMING SOON
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                         alt="img"/>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                    <h4 class="p-head">Snoppy Spot</h4>
                                                    <p class="p-text-sm">
                                                        Some text here
                                                    </p>
                                                    <p class="coming-soon">
                                                        COMING SOON
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                         alt="img"/>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                    <h4 class="p-head">Snoppy Spot</h4>
                                                    <p class="p-text-sm">
                                                        Some text here
                                                    </p>
                                                    <p class="coming-soon">
                                                        COMING SOON
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                         alt="img"/>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                    <h4 class="p-head">Snoppy Spot</h4>
                                                    <p class="p-text-sm">
                                                        Some text here
                                                    </p>
                                                    <p class="coming-soon">
                                                        COMING SOON
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box">
                            <div class="form-group search-field-container">
                                <input type="text" class="form-control search-field" placeholder="Search" name="search">
                                <i class="fa fa-search s-icon"></i>
                            </div>
                            <div>

                                <a href="" class="btn btn-default btn-links">crossfire legends</a>
                                <a href="" class="btn btn-default btn-links">whatsapp</a>
                                <a href="" class="btn btn-default btn-links">editions</a>
                                <a href="" class="btn btn-default btn-links">Pocket legends</a>

                                <a href="" class="btn btn-default btn-links">crossfire legends</a>
                                <a href="" class="btn btn-default btn-links">whatsapp</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box">
                            <div class="p-panel">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <img src="img/placeholder-01.png" class="img-responsive p-img" alt="img"/>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                    <h4 class="p-head">Digital World</h4>
                                    <div class="ratings">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <p class="p-text">
                                        Consectetur adipiscing elit. Cras iaculis eros vel tellus.
                                    </p>

                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p>
                                        <a href="" class="btn btn-info p-large-btn">Download (82Mb)</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box p-0">
                            <div class="panel panel-default p-0">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">Discover</h2>
                                </div>
                                <div class="panel-body text-center">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <a href="">
                                                <i class="fa fa-facebook social-icon icon-fb"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <a href="">
                                                <i class="fa fa-twitter social-icon icon-tw"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <a href="">
                                                <i class="fa fa-instagram social-icon icon-in"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <a href="">
                                                <i class="fa fa-linkedin social-icon icon-li"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box p-0">
                            <div class="panel panel-default p-0">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">{{ __('common.developers') }}</h2>
                                </div>
                                <div class="panel-body text-center p-0">
                                    <div class="row">
                                        @foreach($users as $user)
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <p>
                                                    <a href="">
                                                        <i class="{{ $user->image }}"></i>
                                                        <span>
                                                        {{ $user->name }}
                                                    </span>
                                                    </a>
                                                </p>
                                            </div>

                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box p-0">
                            <div class="panel panel-default p-0">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">Top Trending Games/Apps</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="p-panel">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                             alt="img">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                        <h4 class="p-head">Digital World Alpha 9 Legends</h4>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <p class="p-date">
                                                            26-08-2018
                                                        </p>
                                                        <p>
                                                            <a href="" class="btn btn-info p-btn">Download</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="p-panel">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                             alt="img">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                        <h4 class="p-head">Digital World Alpha 9 Legends</h4>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <p class="p-date">
                                                            26-08-2018
                                                        </p>
                                                        <p>
                                                            <a href="" class="btn btn-info p-btn">Download</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="p-panel">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <img src="img/placeholder-01.png" class="img-responsive p-img"
                                                             alt="img">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                                                        <h4 class="p-head">Digital World Alpha 9 Legends</h4>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <p class="p-date">
                                                            26-08-2018
                                                        </p>
                                                        <p>
                                                            <a href="" class="btn btn-info p-btn">Download</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box p-0">
                            <div class="panel panel-default p-0">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">{{ ucwords(__('site.popular_categories')) }}</h2>
                                </div>
                                <div class="panel-body c-columns">
                                    <div class="row">

                                        @foreach($categories as $category)
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <p>
                                                    <a href="">
                                                        <i class="{{ $category->icon }}"></i>
                                                        <span>
                                                        {{ $category->translation('title' , app()->getLocale()) }}
                                                    </span>
                                                    </a>
                                                </p>
                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box p-0">
                            <div class="panel panel-default p-0">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">Topics</h2>
                                </div>
                                <div class="panel-body text-center">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="">
                                                <img src="img/placeholder2.png" class="img-responsive img-space"
                                                     alt="img">
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="">
                                                <img src="img/placeholder2.png" class="img-responsive img-space"
                                                     alt="img">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="">
                                                <img src="img/placeholder2.png" class="img-responsive img-space"
                                                     alt="img">
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="">
                                                <img src="img/placeholder2.png" class="img-responsive img-space"
                                                     alt="img">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
