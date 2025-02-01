@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('orders.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Əlavə et</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Müraciət Tarixi</th>
                                <th>Müştəri Adı</th>
                                <th>Telefon</th>
                                <th>Mənbə</th>
                                <th>Zəng Statusu </th>
                                <th>Sifariş Statusu </th>
                                <th>Aktiv/Deaktiv</th>
                                <th>Əməliyyatlar</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->


    </div><!--end row-->
@endsection




@push("js")
<script>



    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ $datatableRoute }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'application_date', name: 'application_date' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'phone', name: 'phone' },
                { data: 'sourceColumn', name: 'sourceColumn' },
                { data: 'callStatusColumn', name: 'callStatusColumn' },
                { data: 'orderStatusColumn', name: 'orderStatusColumn' },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        return `
                    <div class="form-check form-switch">
                        <input data-route="{{ route('general.statusChange') }}" data-model='\\App\\Models\\Order' data-row="${row.id}"  class="form-check-input statusChange" type="checkbox" id="statusSwitch-${row.id}" ${data == 1 ? 'checked' : ''}>
                    </div>
                `;
                    },
                    orderable: false,
                    searchable: false
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            language: {
                url: '{{ asset('assets/datatable/languages/az.json') }}'
            },
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            fixedColumns: true,
            autoWidth: false,
            scrollX: true,
            columnDefs: [
                { width: "200px", targets: 3 },
                { width: "200px", targets: 2 },
                { width: "150px", targets: 1 },
                {
                    'targets': -1,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        $(td).addClass('lastColumnRowsDatatable');
                    }
                }
            ]
        });

    });
</script>
@endpush
