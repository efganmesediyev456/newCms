@extends('layouts.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    <form action="{{ $routePost }}" method="POST" id="saveForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Voen</label>
                                    <input type="text" name="voen" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Fin kod</label>
                                    <input type="text" name="fin_code" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Şirkət adı</label>
                                    <input type="text" name="company_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Domenlər</label>
                                    <input type="text" name="domen_names" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Direktor</label>
                                    <input type="text" name="director" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Müştəri əlaqə nömrəsi</label>
                                    <input type="text" name="customer_phone" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Məsul şəxslər</label>
                                    <input type="text" name="responsible_persons" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Müştəri növü</label>
                                    <select name="customer_type" id="" class="form-select form-control">
                                        <option value="">Seçin</option>
                                        @foreach($customerTypeEnums as $customerTypeEnum)
                                            <option value="{{ $customerTypeEnum->value }}">{{ $customerTypeEnum->toString() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Mənbə</label>
                                    <select name="customer_source_id" id="" class="form-select form-control">
                                         <option value="">Seçin</option>
                                         @foreach($customerSources as $customerSource)
                                            <option value="{{ $customerSource->id }}">{{$customerSource->title}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="images" class="mb-1">Yeni Fayllar əlavə et</label>
                                    <input type="file" name="files[]" class="form-control" multiple>
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

