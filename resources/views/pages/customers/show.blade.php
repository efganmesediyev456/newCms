@extends('layouts.layout')

@section('content')

<style>
.card {
    border: none;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.card-header {
    background-color: white;
    border-bottom: 2px solid var(--border-color);
    padding: 15px 20px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.card-header h4 {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 0;
}

.table {
    border-radius: 0px;
    overflow: hidden;
}

.table th {
    background-color: var(--primary-color);
    color: white;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
}

.table td {
    vertical-align: middle;
    border-color: var(--border-color);
}

.table-bordered th,
.table-bordered td {
    border: 1px solid var(--border-color);
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease;
}



.btn-outline-secondary {
    border-color: var(--border-color);
    color: var(--text-dark);
}

.btn-outline-secondary:hover {
    background-color: var(--border-color);
    color: var(--text-dark);
}

.actions .btn {
    margin-left: 10px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.actions .btn i {
    margin-right: 5px;
}

#existing-images .card {
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
}

#existing-images .card:hover {
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.alert {
    border-radius: 8px;
    padding: 12px 20px;
}

.alert-warning {
    background-color: rgba(255, 193, 7, 0.1);
    border-color: rgba(255, 193, 7, 0.2);
    color: #856404;
}

.alert-info {
    background-color: rgba(23, 162, 184, 0.1);
    border-color: rgba(23, 162, 184, 0.2);
    color: #0c5460;
}

@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        align-items: flex-start !important;
    }

    .actions .btn {
        margin-top: 10px;
        margin-left: 0;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--background-light);
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: darken(var(--primary-color), 10%);
}

</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Müştəri Məlumatları</h4>
                <div class="actions">
                    <a href="{{ route('customers.edit', $item->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Düzəliş et
                    </a>
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Geri qayıt
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mb-3">Əsas Məlumatlar</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Voen</th>
                                <td>{{ $item->voen ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                            <tr>
                                <th>Fin Kod</th>
                                <td>{{ $item->fin_code ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                            <tr>
                                <th>Şirkət Adı</th>
                                <td>{{ $item->company_name ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                            <tr>
                                <th>Domenlər</th>
                                <td>{{ $item->domen_names ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                            <tr>
                                <th>Direktor</th>
                                <td>{{ $item->director ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                            <tr>
                                <th>Müştəri Əlaqə Nömrəsi</th>
                                <td>{{ $item->customer_phone ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                            <tr>
                                <th>Məsul Şəxslər</th>
                                <td>{{ $item->responsible_persons ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                            <tr>
                                <th>Müştəri Növü</th>
                                <td>
                                        @foreach($customerTypeEnums as $customerTypeEnum)
                                            @if($customerTypeEnum->value == $item->customer_type)
                                                {{ $customerTypeEnum->toString() }}
                                            @endif
                                        @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Mənbə</th>
                                <td>{{ $item->customerSource->title ?? 'Qeyd edilməyib' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-6">
                        <h5 class="mb-3">Rekvizit Məlumatları</h5>
                        @if($item->requisite)
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Rekvizit Vöen</th>
                                    <td>{{ $item->requisite->voen ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Hüquqi Ünvan</th>
                                    <td>{{ $item->requisite->legal_address ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Faktiki Ünvan</th>
                                    <td>{{ $item->requisite->actual_address ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Bank</th>
                                    <td>{{ $item->requisite->bank ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Bank Vöen</th>
                                    <td>{{ $item->requisite->bank_voen ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Kod</th>
                                    <td>{{ $item->requisite->code ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Hesablaşma Hesabı</th>
                                    <td>{{ $item->requisite->settlement_account ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Müxbir Hesab</th>
                                    <td>{{ $item->requisite->correspondent_account ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>SWIFT</th>
                                    <td>{{ $item->requisite->swift ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                                <tr>
                                    <th>Rekvizit Direktor</th>
                                    <td>{{ $item->requisite->director ?? 'Qeyd edilməyib' }}</td>
                                </tr>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                Rekvizit məlumatları qeyd edilməyib.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <h5 class="mb-3">Müqavilələr</h5>
                        @if($item->media->count() > 0)
                            <div class="row" id="existing-images">
                                @foreach($item->media as $media)
                                    <div class="col-lg-3 mb-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <span class="d-block mb-2" style="word-break: break-all;">
                                                    {{ basename($media->file_path) }}
                                                </span>
                                                <div class="btn-group" role="group">
                                                    <a target="_blank" 
                                                       href="{{ asset('/storage/'.$media->file_path) }}" 
                                                       class="btn btn-success btn-sm">
                                                        <i class="fas fa-eye"></i> Bax
                                                    </a>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                Müqavilə faylları yüklənməyib.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
</style>
@endpush
