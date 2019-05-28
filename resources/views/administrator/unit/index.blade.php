@extends('administrator.layouts.app')

@section('title', @$data['module_titles'])

@section('description', @$data['module_titles'])

@section('module-title', @$data['module_titles'])

@section('module-sub-title', 'Manager')

@section('css-before')
    <!-- page specific plugin styles -->

@stop

@section('content')

    <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Unit Name</th>
                <th>Landlord</th>
                <th>Last Name</th>
                <th>Tenant</th>
                <th>Last Name</th>
            </tr>
            </thead>
        </table>
    </div>
@stop

@section('js')
    <script src="{{ asset('public/js/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/js/dataTables/jquery.dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('public/js/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}"></script>
@stop

@section('script')
    <script type="text/javascript">



        let oTable = $('#dynamic-table').dataTable(
            {
                'processing': true,
                'serverSide': true,
                'ajax': {
                    'url': '{!! @$data['modules'] !!}/json',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                'columns': [
                    {'data': 'name'},
                    {'data': 'landlord_first_name'},
                    {'data': 'landlord_last_name'},
                    {'data': 'tenant_first_name'},
                    {'data': 'tenant_last_name'},
                ],
                bAutoWidth: false,
                'columnDefs': [
                    {
                        'targets': 1,
                        'render': function (data, type, row) {
                            //console.log(data);
                            let str = row.landlord_first_name + ' ' + row.landlord_last_name;

                            if (str.length > 20) str = str.slice(0, 50) + ' ...';

                            return str;
                        }
                    },
                    {
                        'targets': 2,
                        'visible': false
                    },
                    {
                        'targets': 3,
                        'render': function (data, type, row) {
                            //console.log(data);
                            let str = row.tenant_first_name + ' ' + row.tenant_last_name;

                            if (str.length > 20) str = str.slice(0, 50) + ' ...';

                            return str;
                        }
                    },
                    {
                        'targets': 4,
                        'visible': false
                    },
                ],

                //,
                //"sScrollY": "200px",
                //"bPaginate": false,

                //"sScrollX": "100%",
                //"sScrollXInner": "120%",
                //"bScrollCollapse": true,
                //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                //"iDisplayLength": 50
            }
        );
    </script>
@stop