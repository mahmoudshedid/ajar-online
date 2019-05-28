@extends('administrator.layouts.app')

@section('title', @$data['module_titles'])

@section('description', @$data['module_titles'])

@section('module-title', @$data['module_titles'])

@section('module-sub-title', 'Manager')

@section('css-before')
    <!-- page specific plugin styles -->

@stop

@section('button-action')
    <div class="clearfix">
        <div class="pull-left">

        </div>
        <div class="pull-right">
            <div class="btn-toolbar inline middle no-margin">
                <a class="pull-right" href="{{ url('/'.$data['module'].'/create') }}">
                    <span class="btn btn-sm btn-success">
                        <i class="ace-icon fa fa-plus bigger-130"></i>
                        <span class="bigger-110">Add Ticket</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Ticket Name</th>
                <th>Unit Name</th>
                <th>Tenant (From)</th>
                <th>Last Name</th>
                <th>Landlord (To)</th>
                <th>Last Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>type</th>
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
    <script src="{{ asset('public/js/jquery.number.min.js') }}"></script>
@stop

@section('script')
    <script type="text/javascript">

        let nonRentPayments = {!! json_encode(@$data['nonRentPayments']) !!};
        let ticketStatus = {!! json_encode(@$data['ticketStatus']) !!};
        let ticketStatusStyle = ['label-info arrowed arrowed-righ', 'label-success arrowed arrowed-righ', 'label-inverse arrowed-in', 'label-warning arrowed-in'];
        let userType = {!! json_decode(Auth::user()->type) !!};

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
                    {'data': 'unit_name'},
                    {'data': 'tenant_first_name'},
                    {'data': 'tenant_last_name'},
                    {'data': 'landlord_first_name'},
                    {'data': 'landlord_last_name'},
                    {'data': 'amount'},
                    {'data': 'status'},
                    {'data': 'type'},
                ],
                "initComplete": function(settings, json) {
                    $('.rate-number').number(true, 2)
                },
                bAutoWidth: false,
                'columnDefs': [
                    {
                        'targets': 0,
                        'render': function (data, type, row) {
                            //console.log(data);

                            if(userType === 1) return '<a href="{{ @$data['module'] }}/' + row.id + '">' + row.name + '</a>';
                            else return '<a href="{{ @$data['module'] }}/show/' + row.id + '">' + row.name + '</a>';

                        }
                    },
                    {
                        'targets': 2,
                        'render': function (data, type, row) {
                            //console.log(data);
                            let str = row.tenant_first_name + ' ' + row.tenant_last_name;

                            if (str.length > 20) str = str.slice(0, 50) + ' ...';

                            return str;
                        }
                    },
                    {
                        'targets': 2,
                        'render': function (data, type, row) {
                            //console.log(data);
                            let str = row.tenant_first_name + ' ' + row.tenant_last_name;

                            if (str.length > 20) str = str.slice(0, 50) + ' ...';

                            return str;
                        }
                    },
                    {
                        'targets': 3,
                        'visible': false
                    },
                    {
                        'targets': 4,
                        'render': function (data, type, row) {
                            //console.log(data);
                            let str = row.landlord_first_name + ' ' + row.landlord_last_name;

                            if (str.length > 20) str = str.slice(0, 50) + ' ...';

                            return str;
                        }
                    },
                    {
                        'targets': 5,
                        'visible': false
                    },
                    {
                        'targets': 6,
                        'render': function (data, type, row) {
                            //console.log(data);

                            return '<span class="rate-number">' + row.amount + '</span>';
                        }
                    },
                    {
                        'targets': 7,
                        'render': function (data, type, row) {
                            //console.log(data);

                            return '<span class="label label-sm ' + ticketStatusStyle[row.status] + '">' + ticketStatus[row.status] + '</span>';
                        }
                    },
                    {
                        'targets': 8,
                        'render': function (data, type, row) {
                            //console.log(data);

                            return nonRentPayments[row.type];
                        }
                    },
                ],
            }
        );
    </script>
@stop