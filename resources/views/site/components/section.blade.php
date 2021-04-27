@foreach($apps as $app)
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="row">
            <div class="p-panel">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <img
                        src="{{ $app->image_file  }}"
                        class="img-responsive p-img"
                        title="{{ $app->translation('title' , app()->getLocale()) }}"
                        alt="{{ $app->translation('title' , app()->getLocale()) }}"/>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 clr-left">
                    <h4 class="p-head">{{ $app->translation('title' , app()->getLocale())}}</h4>
                    <div class="ratings">
                        @component('admin.vendors.rate' , ['rate' => $app->rate])

                        @endcomponent
                    </div>
                    <p class="p-date">
                        {{ $app->published_at }}
                    </p>
                    <p>
                        <a href="{{ route('apps.details' , ['app' => $app->id , 'title' => $app->translation('title' , app()->getLocale())]) }}" class="btn btn-info p-btn">Download</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endforeach

