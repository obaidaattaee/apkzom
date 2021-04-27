@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="col-md-8 col-sm-8">

            <div class="row mt-40">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-container">
                            <h2 class="panel-title p-title">{{ __('common.app_detailes') }}</h2>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="app-details">
                                    <div class="col-md-3 col-sm-4">
                                        <img src="{{ $app->image_file }}" class="img-responsive"
                                            title="{{ $app->translation('title', app()->getLocale()) }}"
                                            alt="{{ $app->translation('title', app()->getLocale()) }}" />
                                    </div>
                                    <div class="col-md-9 col-sm-8">
                                        <h3 class="app-head">
                                            {{ $app->translation('title', app()->getLocale()) }}
                                        </h3>
                                        <p class="des">Download APK, faster, free and saving data!</p>
                                        <div class="ratings">
                                            @component('admin.vendors.rate', ['rate' => $app->rate])

                                            @endcomponent
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="app-data">
                                                    <h4>{{ __('common.owner') }}</h4>
                                                    <p> {{ object_get($app, 'owner.name') }} </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="app-data">
                                                    <h4>{{ ucwords(__('common.last_version')) }}</h4>
                                                    <p>{{ $app->versions()->first()->title }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="app-data">
                                                    <h4>{{ __('common.published_at') }}</h4>
                                                    <p>{{ $app->versions()->first()->published_at->format('Y-m-d') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div>
                                                    <a href="{{ route('download', ['app' => $app->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()))]) }}"
                                                        class="btn btn-info btn-large">
                                                        Download APK ({{ $app->versions()->first()->size }})
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
            <div class="row mt-40">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-container">
                            <h2 class="panel-title p-title">{{ ucwords(__('common.app') . ' ' . __('common.images')) }}
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="img-carousel" class="carousel slide" data-interval="4000">
                                        <div class="carousel-inner">
                                            @foreach ($app->images()->get()->chunk(4)
        as $key => $images)
                                                <div class="item {{ $key == 0 ? 'active' : '' }}">
                                                    <div class="row">
                                                        @foreach ($images as $image)
                                                            <div class="col-md-3 col-sm-3">
                                                                <img src="{{ $image->image_file }}"
                                                                    class="img-responsive ap-img"
                                                                    title="{{ $image->translation('image_title', app()->getLocale()) }}"
                                                                    alt="{{ $image->translation('image_alt', app()->getLocale()) }}" />
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="left carousel-control" href="#img-carousel" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#img-carousel" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    {{ $app->translation('description', app()->getLocale()) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-container">
                            <h2 class="panel-title p-title">{{ ucwords(__('common.app' . ' ' . __('common.versions'))) }}
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @foreach (object_get($app, 'versions', [[]]) as $version)

                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">

                                                <div class="col-md-12 col-sm-12 col-xs-12 clr-left">
                                                    <h4 class="p-head">
                                                        {{ $app->translation('title', app()->getLocale()) }}</h4>
                                                    <p class="p-text-sm">
                                                        Some text here
                                                    </p>
                                                    <p class="coming-soon">
                                                        COMING SOON</p>

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
                            <h2 class="panel-title p-title">High Quality & Latest Technology</h2>
                        </div>
                        <div class="panel-body app-collapse-details">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading p-0">
                                                <h4 class="panel-title p-0">
                                                    <a class="accordion-toggle" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseOne">
                                                        <span class="faqs-panel-icon"><i
                                                                class="fa fa-map-o white-text"></i></span>
                                                        Free Gaming Booster Technology
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            Version:
                                                        </span>
                                                        2.1.0.0720 (139) for Android 4.0+ (Ice Cream Sandwich, API 14)
                                                    </p>
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            Updated On:
                                                        </span>
                                                        2018-08-07
                                                    </p>
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            New Features
                                                        </span>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading p-0">
                                                <h4 class="panel-title p-0">
                                                    <a class="accordion-toggle" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseTwo">
                                                        <span class="faqs-panel-icon"><i
                                                                class="fa fa-map-o white-text"></i></span>
                                                        Development News
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            Version:
                                                        </span>
                                                        2.1.0.0720 (139) for Android 4.0+ (Ice Cream Sandwich, API 14)
                                                    </p>
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            Updated On:
                                                        </span>
                                                        2018-08-07
                                                    </p>
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            New Features
                                                        </span>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading p-0">
                                                <h4 class="panel-title p-0">
                                                    <a class="accordion-toggle" data-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseThree">
                                                        <span class="faqs-panel-icon"><i
                                                                class="fa fa-map-o white-text"></i></span>
                                                        Markert Emeerging New Games
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            Version:
                                                        </span>
                                                        2.1.0.0720 (139) for Android 4.0+ (Ice Cream Sandwich, API 14)
                                                    </p>
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            Updated On:
                                                        </span>
                                                        2018-08-07
                                                    </p>
                                                    <p class="col-details">
                                                        <span class="t-bold">
                                                            New Features
                                                        </span>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
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
        </div>
        @component('site.components.sidebar_site')

        @endcomponent
    </div>
@endsection
