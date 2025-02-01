@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    <form action="{{ $routePost }}" method="POST" id="saveForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="" class="mb-1">Başlıq</label>
                                <input type="text" name="title" class="form-control" value="{{ $item->title }}">
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


    </div>
@endsection

