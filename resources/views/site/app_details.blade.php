@extends('layouts.site')
@section('title')
    {{ ucwords($app->translation('title', app()->getLocale())) }}
@endsection
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
                                        <h1 class="app-head">
                                            {{ $app->translation('title', app()->getLocale()) }}
                                        </h1>
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
                                                    <a href="{{ route('download', ['version' => $app->versions()->first()->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()))]) }}"
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
                            <h2 class="panel-title p-title">{{ ucwords(__('common.app') . ' ' . __('common.versions')) }}
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @foreach (object_get($app, 'versions', [[]]) as $version)
                                @php
                                    $version = $version->load(['app' ,'app.owner' , 'OSVersion'])
                                @endphp
                                    <div class="col-md-4 col-sm-12 col-xs-12 ">
                                        <div class="row" style="padding: 10px">
                                            <div class="p-panel" style="background-color: #ecebeb; border-radius: 2px">

                                                <div class="col-md-12 col-sm-12 col-xs-12 clr-left"
                                                    style="margin-left: 10px">
                                                    <h2 class="p-head">
                                                        {{ $version->title }}
                                                        <i class="fas fa-align-justify" style="float: right;" onclick="showDetails(
                                                                {{$version}}
                                                            )"></i>
                                                    </h2>

                                                    <p class="p-text-sm extension-margin">
                                                        <span class="extension">
                                                            {{ $version->extension }}
                                                        </span>
                                                    </p>
                                                    <p class="p-text-sm">
                                                        {{ $app->translation('title', app()->getLocale()) }}
                                                    </p>
                                                    <p class="p-text-sm">
                                                        {{ $version->published_at->format('Y-m-d') }}
                                                    </p>
                                                    <p class="coming-soon">
                                                        {{ $version->size }}
                                                        <span style="float: right">
                                                            <a
                                                                href="{{ route('download', ['version' => $version->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()) . ' ' . $version->title)]) }}">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                        </span>
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
        </div>
        @component('site.components.sidebar_site')

        @endcomponent
    </div>

        <!-- Modal -->
        <div class="modal fade" id="appVersionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ver-info-m">
                        <p>
                            <strong>{{ ucwords(__('common.publish_date')) }} : </strong>
                            <span id="versionPublishedDate"></span>
                        </p>


                        <p>
                            <strong>{{ ucwords(__('common.vendor')) }} : </strong>
                            <span id="versionVendor"></span>
                        </p>


                        <p>
                            <strong>{{ ucwords(__('common.os_version')) }} :  </strong>
                            <span id="versionOsVersion"></span>
                        </p>
                        <p>
                            <strong>{{ ucwords(__('common.signature')) }} : </strong>
                            <span id="versionSignature"></span>

                        </p>
                        <p>
                            <strong> {{ ucwords(__('common.screen_dpi')) }} : </strong>
                            <span id="versionScreenDpi"></span>
                        </p>
                        <p>
                            <strong>{{ ucwords(__('common.architecture')) }} : </strong>
                            <span id="versionArchitecture"></span>
                        </p>

                        <p>
                            <strong> {{ ucwords(__('common.file_hash')) }} : </strong>
                            <span id="versionFileHash"></span>
                        </p>
                        <p>
                            <strong>{{ ucwords(__('common.size')) }} : </strong>
                            <span id="versionSize"></span>
                        </p>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-info" id="versionLink">{{ ucwords(__('common.download')) }}</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#appVersionModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        function showDetails(version) {
            let route = '{{ url('download' ) }}' + '/' +version.id + '/' + version.app.title_translation + ` ( ${version.title} ) `;
            $('#appVersionModal').modal('toggle');
            $('#versionPublishedDate').text(version.published_at);
            $('#versionVendor').text(version.app.owner.name);
            $('#versionOsVersion').text(version.o_s_version.version);
            $('#versionSignature').text(version.signature);
            $('#versionScreenDpi').text(version.screen_dpi);
            $('#versionArchitecture').text(version.architecture);
            $('#versionFileHash').text(version.file_hash);
            $('#versionSize').text(version.size);
            $('#exampleModalLongTitle').text(version.app.title_translation + ` ( ${version.title} ) `);
            $('#versionLink').attr( 'href' , route);

        }

    </script>
@endsection
