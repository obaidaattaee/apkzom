@extends('layouts.site')
@section('title')
    {{ ucwords(__('common.search')) }}
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-sm-8" x-data="searchApps()">
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                <h2 class="panel-title p-title">Top Adventure Games</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="btn-group">
                                            <a href="{{ route('search', ['sort' => __('search.download')]) }}"
                                                type="button" class="btn btn-info">{{ __('search.download') }}</a>
                                            <a href="{{ route('search', ['sort' => __('search.arival')]) }}" type="button"
                                                class="btn btn-default">{{ __('search.arival') }}</a>
                                            <a href="{{ route('search', ['sort' => __('search.rating')]) }}" type="button"
                                                class="btn btn-default">{{ __('search.rating') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach ($apps as $app)
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="row">
                                                <div class="p-panel text-center c-games">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <a href="">
                                                            <img src="{{ $app->image_file }}" class="img-responsive"
                                                                alt="{{ $app->translation('title', app()->getLocale()) }}" />
                                                        </a>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="download-details-container">
                                                            <a href="{{ route('apps.details', ['app' => $app->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()))]) }}"
                                                                class="download-details">
                                                                <div>
                                                                    <h4 class="p-head-details">
                                                                        {{ $app->translation('title', app()->getLocale()) }}
                                                                    </h4>
                                                                    <div class="ratings">
                                                                        @component('admin.vendors.rate', ['rate' =>
                                                                            $app->rate])

                                                                        @endcomponent
                                                                    </div>
                                                                    <span class="btn btn-info p-btn">Download APK</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <template x-for="app in apps" :key="app.id">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="row">
                                                <div class="p-panel text-center c-games">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <a href="">
                                                            <img x-bind:src="app.image_file" class="img-responsive" />
                                                        </a>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="download-details-container">
                                                            <a x-bind:href="'{{ url('details/') . '/' }}'+ app.id + '/' +app.title_translation"
                                                                class="download-details">
                                                                <div>
                                                                    <h4 class="p-head-details" x-text="app.title_translation">
                                                                    </h4>
                                                                    <div class="ratings">
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="far fa-star"></i>

                                                                    </div>
                                                                    <a x-bind:href="'{{ url('details/') . '/' }}'+ app.id + '/' +app.title_translation"
                                                                     class="btn btn-info p-btn">Download APK</a>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                </div>
                                <div class="row">
                                    <template x-if="showLoadMore">
                                        <button class="btn btn-info p-btn "
                                            style="display: flex;justify-content: center;margin: auto"
                                            x-on:click="getApps()">{{ ucwords(__('common.load_more')) }}</button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @component('site.components.sidebar_site')

            @endcomponent
        </div>
    </div>
    <script>
        function searchApps() {
            return {
                apps: [],
                nextPage: {{ $apps->currentPage() }} + 1,
                showLoadMore: true,
                getApps: function() {
                    axios.get('{{ $apps->path() }}', {
                        params: {
                            page: this.nextPage
                        }
                    }).then((response) => {
                        this.nextPage = response.data.current_page + 1;
                        this.showLoadMore = response.data.next_page_url ? true : false;
                        this.apps = this.apps.concat(response.data.data);
                    });
                }
            }
        }

    </script>
@endsection
