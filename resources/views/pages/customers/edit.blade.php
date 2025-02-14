@extends('layouts.layout')

@section('content')

<style>

.image-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    width: 200px;
    height: 120px;
    padding: 8px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: #f9f9f9;
    transition: all 0.3s ease-in-out;
}

.image-box:hover {
    background: #eef5ff;
    border-color: #007bff;
}

.image-box a {
    text-decoration: none;
    width: 100%;
    text-align: center;
}

.image-box .delete-image {
    width: 100%;
}

#existing-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}


</style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    <form action="{{ $routePost }}" method="POST" id="saveForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Voen</label>
                                    <input type="text" name="voen" class="form-control" value="{{ $item->voen ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Fin kod</label>
                                    <input type="text" name="fin_code" class="form-control" value="{{ $item->fin_code ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Şirkət adı</label>
                                    <input type="text" name="company_name" class="form-control" value="{{ $item->company_name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Domenlər</label>
                                    <input type="text" name="domen_names" class="form-control" value="{{ $item->domen_names ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Direktor</label>
                                    <input type="text" name="director" class="form-control" value="{{ $item->director ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Müştəri əlaqə nömrəsi</label>
                                    <input type="text" name="customer_phone" class="form-control" value="{{ $item->customer_phone ?? '' }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Məsul şəxslər</label>
                                    <input type="text" name="responsible_persons" class="form-control" value="{{ $item->responsible_persons ?? '' }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">Müştəri növü</label>
                                    <select name="customer_type" id="" class="form-select form-control">
                                        <option value="">Seçin</option>
                                        @foreach($customerTypeEnums as $customerTypeEnum)
                                            <option value="{{ $customerTypeEnum->value }}" {{ isset($item) && $item->customer_type == $customerTypeEnum->value ? 'selected' : '' }}>
                                                {{ $customerTypeEnum->toString() }}
                                            </option>
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
                                            <option value="{{ $customerSource->id }}" {{ isset($item) && $item->customer_source_id == $customerSource->id ? 'selected' : '' }}>
                                                {{ $customerSource->title }}
                                            </option>
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
                            <div class="col-lg-12 mb-3">
                                <label class="mb-1">Mövcud Fayllar</label>
                                <div class="row" id="existing-images">
                                    @foreach($item->media as $media)
                                        <div class="image-box text-center" data-id="{{ $media->id }}">
                                            <span style="word-break: break-all;">{{ basename($media->file_path) }}</span>
                                            <a target="_blank" href="{{ asset('/storage/'.$media->file_path) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-eye"></i> Bax
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm delete-image">
                                                <i class="fas fa-trash"></i> Sil
                                            </button>
                                        </div>
                                    @endforeach
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




@push('js')
<script>
  $(document).ready(function() {
    $(".delete-image").click(function() {
        let button = $(this);
        let imageBox = button.closest(".image-box");
        let imageId = imageBox.data("id");

        Swal.fire({
            title: "Əminsiniz?",
            text: "Bu faylı silmək istədiyinizə əminsiniz?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Bəli, sil!",
            cancelButtonText: "İmtina"
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                $.ajax({
                    url: "{{ route('media.delete') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: imageId
                    },
                    success: function(response) {
                        hideLoading();
                        if (response.success) {
                            imageBox.fadeOut(300, function() {
                                $(this).remove();
                            });

                            Swal.fire({
                                title: "Silindi!",
                                text: "Şəkil uğurla silindi.",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: "Xəta!",
                                text: "Şəkil silinərkən xəta baş verdi.",
                                icon: "error",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    }
                });
            }
        });
    });
});

</script>
@endpush