@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-4-12">
            <div class="card ">
                <div class="card-body">

                    <h4 class="text-center textCenter">{{ $title }} <span><i class="fa fa-info"></i></span></h4>
                    <div class="vehicle-details">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Müraciət Tarixi:</div>
                                    <div class="detail-value">{{ $item->application_date }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Müştəri Adı:</div>
                                    <div class="detail-value">{{ $item->customer_name }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Telefon:</div>
                                    <div class="detail-value">{{ $item->phone }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Mənbə:</div>
                                    <div class="detail-value">{{ $item->source?->title }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Zəng Statusu :</div>
                                    <div class="detail-value">{{ $item->callStatus?->title }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Sifariş Statusu :</div>
                                    <div class="detail-value">{{ $item->orderStatus?->title }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Zəng Tarixi:</div>
                                    <div class="detail-value">{{ $item->call_date }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Istək :</div>
                                    <div class="detail-value">{{ $item->request }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Qiymət Təklifi :</div>
                                    <div class="detail-value">{{ $item->price_offer }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="detail-row">
                                    <div class="detail-label">Qeyd:</div>
                                    <div class="detail-value">{{ $item->note }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-outline-primary " href="{{ $route  }}">Geriyə qayıt</a>
                    </div>


                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->


    </div><!--end row-->
@endsection

