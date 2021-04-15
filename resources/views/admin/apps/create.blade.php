@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.os_version'))
@section('page-title' , __('common.add_new') . ' ' . __('common.os_version'))

@section('header-css')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
    {{--    @include('layouts.admin_components.message')--}}
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('apps.store') }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group col-md-6">
                                <label for="title">{{__('common.title') }} ( {{  $properties['native'] }} )</label>
                                <input type="text" class="form-control" id="title-{{ $localeCode }}"
                                       name="title[{{$localeCode}}]"
                                       value="{{old('title.'.$localeCode)}}"
                                       placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>
                                @error('title.'.$localeCode)
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group col-md-6">
                                <label for="title">{{__('common.description') }} ( {{  $properties['native'] }}
                                    )</label>
                                <textarea class="form-control" id="description-{{ $localeCode }}"
                                          name="description[{{$localeCode}}]"
                                          placeholder="{{__('common.description')}}  ( {{  $properties['native'] }} )"> {{old('description.'.$localeCode)}} </textarea>
                                @error('description.'.$localeCode)
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="extention">{{ __('common.extension') }}</label>
                            <input type="text" required name="extension" id="extension" class="form-control"
                                   placeholder="{{ __('common.extension') }}"
                                   value="{{ old('extension') }}">
                            @error('extension')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="original_link">{{ __('common.original_link') }}</label>
                            <input type="url" required name="original_link" id="original_link" class="form-control"
                                   placeholder="{{ __('common.original_link') }}"
                                   value="{{ old('original_link') }}">
                            @error('original_link')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="published_at">{{ __('common.published_at') }}</label>
                            <input type="date" required name="published_at" id="published_at" class="form-control"
                                   placeholder="{{ __('common.published_at') }}"
                                   value="{{ old('published_at') }}">
                            @error('published_at')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="size">{{ __('common.size') }}</label>
                            <input type="text" required name="size" id="size" class="form-control"
                                   placeholder="{{ __('common.size') }}"
                                   value="{{ old('size') }}">
                            @error('size')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group required col-md-6">
                            <label for="category_id">{{ __('common.category') }}</label>
                            <select class="form-control" name="category_id" id="category_id">

                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.tags') }}</label>
                            <select class="form-control" required multiple name="tags[]" id="tags">

                            </select>
                            @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="os_type_id">{{ __('common.os_type') }}</label>
                            <select required name="os_type_id" id="os_type_id" class="form-control">

                            </select>
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="os_version_id">{{ __('common.os_version') }}</label>
                            <select required name="os_version_id" id="os_version_id" class="form-control">

                            </select>
                            @error('os_version_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="owner_id">{{ __('common.owner') }}</label>
                            <select name="owner_id" required id="owner_id" class="form-control"></select>
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="os_type_id">{{ __('common.images') }}</label>
                            <input type="file" required name="images[]" id="images" class="form-control" multiple>
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr class="list-seperator">
                    <h4 class="font-weight-bolder">{{ __('common.parts') }}</h4>
                    <div class="parts">
                        <div data-repeater-list="parts">
                            @foreach(old('parts' , [[  "size" => null,
                                                      "original_link" => null,
                                                      "extension" => null ,
                                                      ]]) as $key => $part)
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="part_size">{{  __('common.size') }}</label>
                                            <input type="text" class="form-control" name="size" id="part-size" required
                                                   placeholder="{{ __('common.size') }}" value="{{ $part['size'] }}"/>
                                            @error('parts.' . $key . '.size')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="part_original_link">{{ __('common.original_link') }}</label>
                                            <input type="url" class="form-control" name="original_link" required
                                                   id="part_original_link"
                                                   value="{{ $part['original_link'] }}"
                                                   placeholder="{{ __('common.original_link') }}"/>
                                            @error('parts.' . $key . '.original_link')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="part_extension">{{ __('common.extension') }}</label>
                                            <input type="text" class="form-control" name="extension" id="part_extension"
                                                   required
                                                   value="{{ $part['extension'] }}"
                                                   placeholder="{{ __('common.extension') }}"/>
                                            @error('parts.' . $key . '.extension')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input data-repeater-delete type="button" class="btn btn-danger float-right"
                                                   value="Delete"/>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input data-repeater-create type="button" class="btn btn-success float-right" value="Add"/>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('apps.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

@endsection

@section('footer-js')
    <script src="{{ asset('bower_components/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script !src="">
        $('#category_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.category') }}",
            ajax: {
                url: '{{route('category')}}',
                dataType: 'json',
                data: function (params) {
                    return {category: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title.{{app()->getLocale()}},
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#tags').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.tags') }}",
            ajax: {
                url: '{{route('tags')}}',
                dataType: 'json',
                data: function (params) {
                    return {tag: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title.{{app()->getLocale()}},
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#os_type_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.os_type') }}",
            ajax: {
                url: '{{route('os_types.search')}}',
                dataType: 'json',
                data: function (params) {
                    return {type: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title.{{app()->getLocale()}},
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#owner_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.owner') }}",
            ajax: {
                url: '{{route('users.json')}}',
                dataType: 'json',
                data: function (params) {
                    return {type: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#os_version_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.os_version') }}",
            ajax: {
                url: '{{route('os_versions')}}',
                dataType: 'json',
                data: function (params) {
                    return {version: params.term, type: $('#os_type_id').val()}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.version,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
    </script>
    <script src="{{ asset('bower_components/jquery.repeater/jquery-1.11.1.js') }}"></script>

    <script src="{{ asset('bower_components/jquery.repeater/jquery.repeater.js') }}"></script>
    <script>
        'use strict';

        $('.parts').repeater({
            defaultValues: {
                'textarea-input': 'foo',
                'text-input': 'bar',
                'select-input': 'B',
                'checkbox-input': ['A', 'B'],
                'radio-input': 'B'
            },
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {

            }
        });

    </script>
@endsection
