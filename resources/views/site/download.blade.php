@extends('layouts.site')


@section('content')

    <div class="container" x-data="download()" x-init="increment()">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="slider mt-30">
                            <div class="row mt-40">
                                <div class="col-md-12 col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading panel-container">
                                            <h2 class="panel-title p-title">{{ ucwords(__('common.download_the_app')) }}</h2>
                                        </div>
                                        <div class="panel-body text-center">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h3>
                                                        {{ ucwords(__('common.downloading')) }}
                                                    </h3>
                                                    <h3 x-text="counter" x-show="counter !== 10">

                                                    </h3>
                                                    <h4 class="d-size">
                                                        {{ $app->versions()->first()->title }}
                                                        ({{ $app->versions()->first()->size }})
                                                    </h4>
                                                    <h4>
                                                    </h4>
                                                    <p x-show="counter == 10">
                                                        If the download doesn't start, <a href="{{$app->versions()->first()->original_link}}" title="{{$app->versions()->first()->title}}">click here</a>
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="download-box">
                                                    <div class="col-md-2 col-sm-4">
                                                        <img src="{{ $app->image_file }}" class="img-responsive"
                                                             alt="{{ $app->translation('title' , app()->getLocale()) }}"
                                                             title="{{ $app->translation('title' , app()->getLocale()) }}"/>
                                                    </div>
                                                    <div class="col-md-7 col-sm-8">
                                                        <h3>
                                                            {{ $app->translation('title' , app()->getLocale()) }}
                                                        </h3>
                                                        <p class="des">Download APK, faster, free and saving data!</p>
                                                    </div>
                                                    <template x-if="counter == 10">
                                                        <div class="col-md-3 col-sm-12">
                                                            <a href="{{ $app->versions()->first()->original_link }}"
                                                               title="{{ $app->versions()->first()->title }}"
                                                               class="btn btn-info p-large-btn">
                                                                <i class="fa fa-download"></i>
                                                                DOWNLOAD
                                                            </a>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
                @php
                    $section = section(\App\Models\Section::SECTIONS[0]['id'])->load(['apps'])
                @endphp
                @if(($apps = $section->apps)->count() > 0)

                    <div class="row mt-40">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">{{ $section->translation('title' , app()->getLocale()) }}</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        @component('site.components.section' , ['apps' => $apps])
                                        @endcomponent
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                <h2 class="panel-title p-title">{{ section(\App\Models\Section::SECTIONS[1]['id'])->translation('title' , app()->getLocale()) }}</h2>
                            </div>
                            <div class="panel-body">

                                <!--  -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab"
                                                          href="#p01">{{ section(\App\Models\Section::SECTIONS[2]['id'])->translation('title' , app()->getLocale()) }}</a>
                                    </li>
                                    <li><a data-toggle="tab"
                                           href="#p02">{{ section(\App\Models\Section::SECTIONS[1]['id'])->translation('title' , app()->getLocale()) }}</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-20">
                                    @php
                                        $section = section(\App\Models\Section::SECTIONS[2]['id'])->load(['apps'])
                                    @endphp
                                    @if(($apps = $section->apps)->count() > 0)
                                        <div id="p01" class="tab-pane fade in active">
                                            <div class="row">

                                                @component('site.components.section' , ['apps' => $apps])

                                                @endcomponent
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $section = section(\App\Models\Section::SECTIONS[1]['id'])->load(['apps'])
                                    @endphp
                                    @if(($apps = $section->apps)->count() > 0)

                                        <div id="p02" class="tab-pane fade">
                                            <div class="row">

                                                @component('site.components.section' , ['apps' => $apps])

                                                @endcomponent
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!--  -->


                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $section = section(\App\Models\Section::SECTIONS[3]['id'])->load(['apps'])
                @endphp
                @if(($apps = $section->apps)->count() > 0)
                    <div class="row mt-40">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">{{ $section->translation('title' , app()->getLocale()) }}</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        @component('site.components.comming_soon' , ['apps' => $apps])
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @component('site.components.sidebar_site' )
            @endcomponent
        </div>
    </div>

    <script !src="">
        function download() {
            return {
                counter: 0,
                increment: function () {
                    let interval = setInterval((e) => {
                        this.counter++;
                        if (this.counter == 10){
                            clearInterval(interval)
                            {{--window.location = '{{ $app->versions()->first()->original_link }}'--}}
                        }
                    }, 1000)
                }
            }
        }
    </script>
@endsection
