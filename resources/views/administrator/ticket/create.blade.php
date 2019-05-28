@extends('administrator.layouts.app')

@section('title', @$data['module_title'])

@section('description', @$data['module_title'])

@section('module-title', @$data['module_title'])

@section('module-sub-title', 'Create')

@section('css-before')
    <!-- page specific plugin styles -->

@stop

@section('error')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-block alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-exclamation"></i>
                {{ $error }}
            </div>
        @endforeach
    @endif
@stop

@section('content')
    {{Form::open(['id'=>'validation-form','url'=>'/'.$data['module'].'/create', 'class'=>'form-horizontal validate'])}}

    @include('administrator.' . $data['module'].'.form')

    {{ Form::close() }}
@stop

@section('js')
    <script src="{{ asset('public/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/js/jquery.number.min.js') }}"></script>
@stop

@section('script')
    <script type="text/javascript">
        $('.price-validator').number(true, 2);
        $(document).on("focus", ".price-validator", function () {
            $(this).number(true, 2);
        });
    </script>
@stop