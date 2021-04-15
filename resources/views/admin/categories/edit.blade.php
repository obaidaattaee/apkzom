@extends('layouts.admin')
@section('header-css')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"/>
@endsection
@section('title' , __('common.edit') . ' ' . __('common.category'))
@section('content')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('categories.update' , ['category' => $category->id]) }}" method="post">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group col-md-6">
                                <label for="title">{{__('common.title') }} ( {{  $properties['native'] }} )</label>
                                <input type="text" class="form-control" required id="title"
                                       name="title[{{$localeCode}}]"
                                       value="{{old('title.'.$localeCode) ?? $category->getTranslation('title' , $localeCode , false)}}"
                                       placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>
                                @error('title.'.$localeCode)
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        <div class="form-group col-md-6">
                            <label for="icon">{{__('common.icon')}}</label>
                            <input type="text" class="form-control" name="icon"
                                   id="icon"
                                   value="{{ old('icon') ?? $category->icon }}"
                                   placeholder="{{__('common.icon')}}"/>
                            <div class="text-info" id="icon_error">pleas select one from
                                <a href="https://fontawesome.com/icons?d=gallery&p=2&m=free" class="mr-3" target="_blank">here</a>
                                @error('icon')
                                    <div class="text-danger">| {{ $message }}</div>
                                @enderror

                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">{{__('common.description')}}</label>
                            <textarea type="text" class="form-control" name="description"
                                      id="description"
                                      placeholder="{{__('common.description')}}">{{ old('description') ?? $category->description }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="is_active">{{__('common.status')}}</label>
                            <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group clearfix">
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="is_active" value="1" {{ old('is_active') == 1 ? 'checked' : ($category->is_active ? "checked" : "") }} id="active">
                                        <label for="active">
                                            {{ __('common.active') }}
                                        </label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="is_active" value="0" {{ old('is_active') == 0 ? 'checked' : ( !$category->is_active ? "checked" : "") }} id="in_active">
                                        <label for="in_active">
                                            {{ __('common.in_active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
