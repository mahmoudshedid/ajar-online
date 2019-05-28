@extends('administrator.layouts.app')

@section('title', @$data['module_title'])

@section('description', @$data['module_title'])

@section('module-title', @$data['module_title'])

@section('module-sub-title', 'Display')

@section('css-before')
    <!-- page specific plugin styles -->

@stop

@section('content')
    {{Form::open(['id'=>'validation-form','url'=>'#', 'class'=>'form-horizontal validate'])}}

    @include('administrator.' . $data['module'].'.show-form')

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