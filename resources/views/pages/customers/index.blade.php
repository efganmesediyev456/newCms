@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ $routeCreate }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Əlavə et</a>
                    </div>
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vöen</th>
                            <th>Fin Kod</th>
                            <th>Şirkət adı</th>
                            <th>Domenlər</th>
                            <th>Direktor</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                    </table>
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
                { data: 'voen', name: 'voen' },
                { data: 'fin_code', name: 'fin_code' },
                { data: 'company_name', name: 'company_name' },
                { data: 'domen_names', name: 'domen_names' },
                { data: 'director', name: 'director' },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        return `
                            <div class="form-check form-switch">
                                <input data-route="{{ route('general.statusChange') }}" data-model='\\App\\Models\\Customer' data-row="${row.id}"  class="form-check-input statusChange" type="checkbox" id="statusSwitch-${row.id}" ${data == 1 ? 'checked' : ''}>
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
            }
            ,
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>
@endpush
