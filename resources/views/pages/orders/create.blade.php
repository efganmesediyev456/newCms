@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    <form action="{{ $routePost }}" method="POST" id="saveForm">
                        @csrf

                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="application_date" class="mb-1">Müraciət Tarixi</label>
                                    <input type="date" name="application_date" class="form-control">
                                </div>
                            </div>
                           <div class="col-lg">
                               <div class="form-group mb-3">
                                   <label for="customer_name" class="mb-1">Müştəri Adı</label>
                                   <input type="text" name="customer_name" class="form-control">
                               </div>
                           </div>
                           <div class="col-lg">
                               <div class="form-group mb-3">
                                   <label for="phone" class="mb-1">Telefon</label>
                                   <input type="text" name="phone" class="form-control">
                               </div>
                           </div>
                        </div>

                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="source" class="mb-1">Mənbə</label>
                                    <select name="source_id" id="" class="form-select select2">
                                        <option value="">Seçin</option>
                                        @foreach($sources as $source)
                                            <option value="{{ $source->id }}">{{ $source->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="call_status_id" class="mb-1">Zəng Statusu</label>
                                    <select name="call_status_id" class="form-control select2">
                                        <option value="">Seçin</option>
                                        @foreach($callStatuses as $callStatus)
                                            <option value="{{ $callStatus->id }}">{{ $callStatus->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="order_status_id" class="mb-1">Sifariş Statusu</label>
                                    <select name="order_status_id" class="form-select select2">
                                        <option value="">Seçin</option>
                                        @foreach($orderStatuses as $orderStatus)
                                            <option value="{{ $orderStatus->id }}">{{ $orderStatus->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="call_date" class="mb-1">Zəng Tarixi</label>
                                    <input type="date" name="call_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="request" class="mb-1">Istək</label>
                                    <textarea name="request" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="price_offer" class="mb-1">Qiymət Təklifi</label>
                                    <textarea name="price_offer" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group mb-3">
                                    <label for="note" class="mb-1">Qeyd</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group d-flex justify-content-end gap-2">
                                    <a type="submit" class="btn btn-outline-danger" href="{{ $route }}"><i class="fa fa-arrow-left"></i> Geri qayıt </a>
                                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Yadda saxla </button>
                            </div>
                        </div>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->


    </div><!--end row-->

@endsection

