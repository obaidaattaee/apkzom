@extends('layouts.admin')
@section('title' , __('common.edit') . ' ' . __('common.user'))
@section('page-title' , __('common.edit') . ' ' . __('common.user') . " : " .$user->name)
@section('header-css')
    {{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">--}}
    <link rel="stylesheet"
          href="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('bower_components/admin-lte/plugins/dropzone/min/dropzone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')

    <div class="card card-default">
        <div class="card-body">
            <form id="form" action="{{ route('users.update' , ['user' => $user->id]) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="name">{{ __('common.name') }}</lable>
                            <input type="text" class="form-control" name="name" required
                                   value="{{ old('name') ?? $user->name }}"
                                   id="name" placeholder="{{ __('common.name') }}" autocomplete="">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="email">{{ __('auth.email') }}</lable>
                            <input type="email" class="form-control" name="email" required
                                   value="{{ old('email') ?? $user->email }}"
                                   id="email" placeholder="{{ __('auth.email') }}" autocomplete="">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <lable for="name">{{ __('common.roles') }}</lable>
                            <select name="roles[]" id="roles" multiple class="form-control">
                                @foreach($user->roles as $role)
                                    <option value="{{$role->id}}" selected>{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
            {{--            <div class="row">--}}
            {{--                <div id="actions" class="row">--}}
            {{--                    <div class="col-lg-6">--}}
            {{--                        <div class="btn-group w-100">--}}
            {{--                      <span class="btn btn-success col fileinput-button">--}}
            {{--                        <i class="fas fa-plus"></i>--}}
            {{--                        <span>Add files</span>--}}
            {{--                      </span>--}}
            {{--                            <button type="reset" class="btn btn-warning col cancel">--}}
            {{--                                <i class="fas fa-times-circle"></i>--}}
            {{--                                <span>Cancel upload</span>--}}
            {{--                            </button>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-6 d-flex align-items-center">--}}
            {{--                        <div class="fileupload-process w-100">--}}
            {{--                            <div id="total-progress" class="progress progress-striped active" role="progressbar"--}}
            {{--                                 aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">--}}
            {{--                                <div class="progress-bar progress-bar-success" style="width:0%;"--}}
            {{--                                     data-dz-uploadprogress></div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="table table-striped files" id="previews">--}}
            {{--                    <div id="template" class="row mt-2">--}}
            {{--                        <div class="col-auto">--}}
            {{--                            <span class="preview"><img src="data:," alt="" data-dz-thumbnail/></span>--}}
            {{--                        </div>--}}
            {{--                        <div class="col d-flex align-items-center">--}}
            {{--                            <p class="mb-0">--}}
            {{--                                <span class="lead" data-dz-name></span>--}}
            {{--                                (<span data-dz-size></span>)--}}
            {{--                            </p>--}}
            {{--                            <strong class="error text-danger" data-dz-errormessage></strong>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-4 d-flex align-items-center">--}}
            {{--                            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0"--}}
            {{--                                 aria-valuemax="100" aria-valuenow="0">--}}
            {{--                                <div class="progress-bar progress-bar-success" style="width:0%;"--}}
            {{--                                     data-dz-uploadprogress></div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-auto d-flex align-items-center">--}}
            {{--                            <div class="btn-group">--}}
            {{--                                <button class="btn btn-primary start">--}}
            {{--                                    <i class="fas fa-upload"></i>--}}
            {{--                                    <span>Start</span>--}}
            {{--                                </button>--}}
            {{--                                <button data-dz-remove class="btn btn-warning cancel">--}}
            {{--                                    <i class="fas fa-times-circle"></i>--}}
            {{--                                    <span>Cancel</span>--}}
            {{--                                </button>--}}
            {{--                                <button data-dz-remove class="btn btn-danger delete">--}}
            {{--                                    <i class="fas fa-trash"></i>--}}
            {{--                                    <span>Delete</span>--}}
            {{--                                </button>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-success" form="form">{{ __('common.save') }}</button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>

        </div>
    </div>
@endsection
@section('footer-js')
    <script src="{{ asset('bower_components/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script !src="">
        $('#roles').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.roles') }}",
            ajax: {
                url: '{{route('roles')}}',
                dataType: 'json',
                data: function (params) {
                    return {role: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.display_name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
    </script>
@endsection
{{--@section('footer-js')--}}
{{--    <script src="{{ asset('bower_components/admin-lte/plugins/dropzone/min/dropzone.min.js') }}"></script>--}}
{{--    <script !src="">--}}
{{--        // DropzoneJS Demo Code Start--}}
{{--        Dropzone.autoDiscover = false--}}

{{--        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument--}}
{{--        var previewNode = document.querySelector("#template")--}}
{{--        previewNode.id = ""--}}
{{--        var previewTemplate = previewNode.parentNode.innerHTML--}}
{{--        previewNode.parentNode.removeChild(previewNode)--}}

{{--        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone--}}
{{--            url: "/target-url", // Set the url--}}
{{--            thumbnailWidth: 80,--}}
{{--            thumbnailHeight: 80,--}}
{{--            parallelUploads: 20,--}}
{{--            previewTemplate: previewTemplate,--}}
{{--            autoQueue: false, // Make sure the files aren't queued until manually added--}}
{{--            previewsContainer: "#previews", // Define the container to display the previews--}}
{{--            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.--}}
{{--        })--}}

{{--        myDropzone.on("addedfile", function (file) {--}}
{{--            // Hookup the start button--}}
{{--            file.previewElement.querySelector(".start").onclick = function () {--}}
{{--                myDropzone.enqueueFile(file)--}}
{{--            }--}}
{{--        })--}}

{{--        // Update the total progress bar--}}
{{--        myDropzone.on("totaluploadprogress", function (progress) {--}}
{{--            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"--}}
{{--        })--}}

{{--        myDropzone.on("sending", function (file) {--}}
{{--            // Show the total progress bar when upload starts--}}
{{--            document.querySelector("#total-progress").style.opacity = "1"--}}
{{--            // And disable the start button--}}
{{--            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")--}}
{{--        })--}}

{{--        // Hide the total progress bar when nothing's uploading anymore--}}
{{--        myDropzone.on("queuecomplete", function (progress) {--}}
{{--            document.querySelector("#total-progress").style.opacity = "0"--}}
{{--        })--}}

{{--        // Setup the buttons for all transfers--}}
{{--        // The "add files" button doesn't need to be setup because the config--}}
{{--        // `clickable` has already been specified.--}}
{{--        document.querySelector("#actions .start").onclick = function () {--}}
{{--            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))--}}
{{--        }--}}
{{--        document.querySelector("#actions .cancel").onclick = function () {--}}
{{--            myDropzone.removeAllFiles(true)--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}
