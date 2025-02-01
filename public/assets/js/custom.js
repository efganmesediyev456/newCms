$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$('body').on("submit", "#saveForm", function(e) {
    e.preventDefault();
    let formdata = new FormData(this);
    showLoading();

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status === 'success') {
                hideLoading()
                $("#roadPassWithDrawModal").modal("hide");
                Swal.fire({
                    icon: 'success',
                    text: response.message,
                    timer: 1200,
                    showConfirmButton: false,
                    willClose:function(e){
                        console.log(response)
                        hideLoading();
                        window.location.href = response.route;

                    }
                });
            }
        },
        error: function(xhr, status, error) {
            hideLoading();

            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                for (let key in errors) {
                    errorMessages += errors[key].join('') + '<br>';
                }
                console.log(errorMessages)
                Swal.fire({
                    icon: 'error',
                    html: errorMessages,
                    showConfirmButton: true,
                    confirmButtonText: "Tamam"
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: xhr.responseJSON.message || 'Something went wrong!',
                    showConfirmButton: false,
                });
            }
        }
    });
});


//status change
$(document).on('change', '.statusChange', function() {
    var brandId = $(this).data('row');
    var status = $(this).prop('checked') ? 1 : 0;
    var model = $(this).attr('data-model');
    showLoading();
    $.ajax({
        url: $(this).data("route"),
        method: 'POST',
        data: {
            id: brandId,
            status: status,
            model:model,
        },
        success: function(response) {
            hideLoading()
            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    text: response.message,
                    showConfirmButton: false,
                    timer:2000
                });
            } else {
                $(`#statusSwitch-${brandId}`).prop('checked', !status);
            }
        },
        error: function(xhr) {

            hideLoading()
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                for (let key in errors) {
                    errorMessages += errors[key].join('') + '<br>';
                }
                console.log(errorMessages)
                Swal.fire({
                    icon: 'error',
                    html: errorMessages,
                    showConfirmButton: true,
                    confirmButtonText: "Tamam"

                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: xhr.responseJSON.message || 'Something went wrong!',
                    showConfirmButton: false,
                });
            }
            $(`#statusSwitch-${brandId}`).prop('checked', !status);
        }
    });
});


//datatble reload ajax

function reloadDatatable(queryParams = {}){
    let url = $('#datatable').DataTable().ajax.url();
    const queryString = $.param(queryParams);
    url += url.includes('?') ? '&' + queryString : '?' + queryString;

    $('#datatable').DataTable().ajax.url(url).load();
}


function showLoading(){
    $(".loading").css({
        'display':"flex"
    });
}

function hideLoading(){
    $(".loading").css({
        'display':"none"
    });
}

//delete items

$("body").on("click", ".deleteButton", function (e) {
    e.preventDefault();
    var href = $(this).attr('href');
    Swal.fire({
        icon: 'warning',
        text: 'Bu elementi silməyə əminsiniz?',
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText:"Xeyr, silmə!",
        confirmButtonText: 'Bəli, sil!',
        preConfirm: () => {
            showLoading()
            return $.ajax({
                url: href,
                method: "DELETE",
                type: "POST",
                success: function (response) {
                    hideLoading()
                    if (response.status) {
                        reloadDatatable();
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function (xhr) {
                    hideLoading()
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        for (let key in errors) {
                            errorMessages += errors[key].join('') + '<br>';
                        }
                        Swal.fire({
                            icon: 'error',
                            html: errorMessages,
                            showConfirmButton: true,
                            confirmButtonText: "Tamam"
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Xətası',
                            text: xhr.responseJSON.message || 'Nəsə səhv getdi!',
                            showConfirmButton: false,
                        });
                    }
                }
            });
        }
    });
});



//select2
if ($(".select2").length > 0) {
    $(".select2").select2();
}

if ($('#yearpicker').length > 0) {
    $('#yearpicker').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });
}

if ($('#yearpicker2').length > 0) {
    $('#yearpicker2').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });
}


$("input[type='date']").datepicker({
    format: "yyyy-mm-dd",
    autoclose: true
});

$('#brandVehicleSelect').on('change', function() {
    var selectedBrand = $(this).val();

    if (selectedBrand) {
        var $select2Element = $("#modelVehicleSelect");
        $select2Element.empty();
        $select2Element.trigger('change');

        showLoading()
        $.ajax({
            url: '/vehicles/brand/'+selectedBrand+'/models',
            type: 'post',
            data: {
                brand_id: selectedBrand,
            },
            success: function(response) {
                var $select2Element = $("#modelVehicleSelect");
                $select2Element.empty();
                $select2Element.append(response.data);
                $select2Element.trigger('change');
                hideLoading()
                $select2Element.prop('disabled', false);

            },
            error: function(xhr, status, error) {
                hideLoading()
                console.error('AJAX sorğusunda xəta baş verdi:', error);
            }
        });
    }
});



$('#vehicle_road_passes').on('change', function() {
    var selectedVehicle = $(this).val();

    if (selectedVehicle) {
        var $select2Element = $("#driver_road_passes");
        $select2Element.empty();
        $select2Element.trigger('change');

        $.ajax({
            url: '/road_passes/vehicles/'+selectedVehicle+'/driver',
            type: 'post',
            data: {
                vehicle_id: selectedVehicle,
            },
            success: function(response) {
                var $select2Element = $("#driver_road_passes");
                $select2Element.empty();
                $select2Element.append(response.data);
                $select2Element.trigger('change');
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX sorğusunda xəta baş verdi:', error);
            }
        });
    }
});






$("#roadPassType").on("change", function (){
    var val = $(this).val();
    if(val == 1 ){
        $("#roadPassBranchContainer").show();

        var $select2Element = $("#vehicle_road_passes");
        $select2Element.empty();
        $select2Element.append('<option>Seçin</option>')
        $select2Element.trigger('change');
    }else{
        $("#roadPassBranchContainer").hide();
    }
})

$("#equipmentPurchaseType").on("change", function (){
    var val = $(this).val();
    if(val == 0 ){
        $("#equipmentPurchaseProcurementsArea").show();
    }else{
        $("#equipmentPurchaseProcurementsArea").hide();
    }
    $("#equipmentProcurementSelect").val("").change();
})
$("#equipmentPurchaseAcquired").on("change", function (){
    var val = $(this).val();
    let selectedOption = $(this).find(':selected');
    let dataShow = selectedOption.data('show');
    $("#equipmentPurchaseAcquiredExtra").find("input").val("")
    if(dataShow == 1){
        $("#equipmentPurchaseAcquiredExtra").css({
            display:'flex'
        })
    }else{
        $("#equipmentPurchaseAcquiredExtra").css({
            display:'none'
        })
    }
})

function showEquipmentPurchase(){
    var val = $("#equipmentPurchaseType").val();
    if(val == 0 ){
        $("#equipmentPurchaseProcurementsArea").show();
    }else{
        $("#equipmentPurchaseProcurementsArea").hide();
    }
}


    function showEquipmentPurchaseAcquiredExtra(){
        let selectedOption =$("#equipmentPurchaseAcquired").find(':selected');
        let dataShow = selectedOption.data('show');
        if(dataShow == 1){
            $("#equipmentPurchaseAcquiredExtra").css({
                display:'flex'
            })
        }else{
            $("#equipmentPurchaseAcquiredExtra").css({
                display:'none'
            })
        }
    }

    $(function (){
        showEquipmentPurchaseAcquiredExtra();
        showEquipmentPurchase();
    })


$("#roadPassBranch").on("change", function (){
   var selectedBranch = $(this).val();

    if (selectedBranch) {
        var $select2Element = $("#vehicle_road_passes");
        $select2Element.empty();
        $select2Element.trigger('change');

        $.ajax({
            url: '/road_passes/branch/'+selectedBranch+'/vehicles',
            type: 'post',
            data: {
                branch_id: selectedBranch,
            },
            success: function(response) {
                var $select2Element = $("#vehicle_road_passes");
                $select2Element.empty();
                $select2Element.append(response.data);
                $select2Element.trigger('change');
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX sorğusunda xəta baş verdi:', error);
            }
        });
    }

});




$(document).ready(function() {
    function calculateDateDifference() {
        var startDate = $('#roadPassStartDate').val();
        var endDate = $('#roadPassEndDate').val();

        if (startDate && endDate) {
            var start = new Date(startDate);
            var end = new Date(endDate);
            if (end < start) {
                Swal.fire({
                    icon: 'error',
                    title: 'Xəta!',
                    text: 'Bitmə tarixi başlanğıc tarixindən böyük olmalıdır!',
                    confirmButtonText: 'Tamam'
                });
                $('#roadPassEndDate').val('');
                $('#roadPassDifferenceDay').val('');
            } else {
                var timeDifference = end - start;
                var dayDifference = timeDifference / (1000 * 3600 * 24);
                $('#roadPassDifferenceDay').val(Math.abs(dayDifference));
            }

        } else {
            $('#roadPassDifferenceDay').val('');
        }
    }

    $('#roadPassStartDate, #roadPassEndDate').on('change', calculateDateDifference);
});




//yol vereqi geri alinma
$("body").on("click", ".withDrawalButton", function (e){
    e.preventDefault();
    let url = $(this).attr('href')
    $("#saveRoadPassReasonForm").attr('action', url)
    $("#roadPassWithDrawModal").modal("show");
});

// Sürücü məlumatları bildirişləri

$("body").on("click", ".driverInfoNotificationShow", function (e){
    e.preventDefault();
    let url = $(this).attr('href')
    $("#roadPassWithDrawModal").modal("show");
    let formdata = new FormData(document.querySelector("#saveRoadPassReasonForm"))
    $.ajax({
        url: $(this).attr('href'),
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            $("#saveRoadPassReasonForm").find("p.content").html(response.data[0].join('<br>'))
        },
        error: function(xhr, status, error) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                for (let key in errors) {
                    errorMessages += errors[key].join('') + '<br>';
                }
                console.log(errorMessages)
                Swal.fire({
                    icon: 'error',
                    html: errorMessages,
                    showConfirmButton: true,
                    confirmButtonText: "Tamam"
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: xhr.responseJSON.message || 'Something went wrong!',
                    showConfirmButton: false,
                });
            }
        }
    });
});

$('body').on("submit", "#saveRoadPassReasonForm", function(e) {
    e.preventDefault();
    let formdata = new FormData(this);
    showLoading();
    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(response) {
            $("#cell-"+response.data.road_pass.id).html(response.data.date);
            if (response.status === 'success') {
                hideLoading()
                $("#roadPassWithDrawModal").modal("hide");
                Swal.fire({
                    icon: 'success',
                    text: response.message,
                    timer: 1200,
                    showConfirmButton: false,
                    willClose:function(e) {
                        hideLoading();
                        $("#saveRoadPassReasonForm")[0].reset()
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            hideLoading();
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                for (let key in errors) {
                    errorMessages += errors[key].join('') + '<br>';
                }
                console.log(errorMessages)
                Swal.fire({
                    icon: 'error',
                    html: errorMessages,
                    showConfirmButton: true,
                    confirmButtonText: "Tamam"
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: xhr.responseJSON.message || 'Something went wrong!',
                    showConfirmButton: false,
                });
            }
        }
    });
});


$(document).on('click', '[data-dismiss="modal"]', function() {
    $('.modal').modal('hide');
});




$("#vehiclesEngineNumberStatus").on("change", function(e){
    var value  = $(this).val();
    if(value==3){
        $("#vehiclesEngineNumber").val("")
        $("#vehiclesEngineNumber").addClass("disabled")
    }else{
        $("#vehiclesEngineNumber").removeClass("disabled")
    }
})


$(function () {

        $(".licenseDriverMask").each(function(){
            let maskOptions = {
                mask: '00-SS-000',
                definitions: {
                    'S': {
                        mask: /[A-Za-z]/,
                    }
                },
                prepareChar: str => str.toUpperCase(),
            };
            let mask = IMask(this, maskOptions);
        });

        $(".yearMask").each(function(){
            let maskOptions = {
                mask: '0000',
            };
            let mask = IMask(this, maskOptions);
        });


    function capitalizeWords(sentence) {
        console.log(sentence)
        return sentence
            .toLowerCase()
            .replace(/\b\w/g, char => char.toUpperCase());
    }

    $(".nameSurnameMask").each(function(){
        let maskOptions = {
            mask: 'S S',
            blocks: {
                'S': {
                    mask: /^[A-Za-z]*$/,
                }
            }
        };
        IMask(this, maskOptions);
    });

    $(".nameSurnameMask").on("input", function(){
        this.value  =  capitalizeWords(this.value)
    })


    $(".fatherNameMask").each(function(){
        let maskOptions = {
            mask: 'S',
            blocks: {
                'S': {
                    mask: /^[A-Za-z]*$/,
                }
            }
        };
        IMask(this, maskOptions);
    });

    $(".driverLicenseNumberMask").each(function(){
        let maskOptions = {
            mask: 'SS 000000',
            blocks: {
                'S': {
                    mask: /^[A-Za-z]$/,
                }
            },
            prepareChar : str => str.toUpperCase()
        };
        IMask(this, maskOptions);
    });
    $(".assignedRoadNumberMask").each(function(){
        let maskOptions = {
            mask: 'YV0000',
            prepareChar : str => str.toUpperCase()
        };
        IMask(this, maskOptions);
    });

    $(".finCodeMask").each(function(){
        let maskOptions = {
            mask: /^[A-Z0-9]{0,7}$/,
            prepareChar : str => str.toUpperCase()
        };
        let mask = IMask(this, maskOptions);
    });
    $(".cardNumberMask").each(function(){
        let maskOptions = {
            mask: /^[A-Z0-9]{0,9}$/,
            prepareChar : str => str.toUpperCase()
        };
        IMask(this, maskOptions);
    });

    $(".fatherNameMask").on("input", function(){
        this.value  =  capitalizeWords(this.value)
    })

});





$(document).ready(function() {
    $('#nVVehicle').on('change', function () {
        var vehicleId = $(this).val();

        if (vehicleId) {
            $.ajax({
                url: $(this).attr('data-url'),
                type: "POST",
                data: {
                    vehicle_id: vehicleId,
                },
                success: function (response) {
                    if (response.success) {
                        $('select[name="vehicle_type_id"]').val(response.vehicle_type_id);
                        $('select[name="assigned_garage_id"]').val(response.assigned_garage_id);
                        $('select[name="garage_management_id"]').val(response.garage_management_id);

                    } else {
                        Swal.fire({
                            title: 'Xəta!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Tamam'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Xəta!',
                        text: 'Bir xəta baş verdi!',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        }
    });
});

$(document).ready(function() {
    $('#equipmentProcurementVehicle').on('change', function () {
        var vehicleId = $(this).val();
        showLoading();

        if (vehicleId) {
            $.ajax({
                url: $(this).attr('data-url'),
                type: "POST",
                data: {
                    vehicle_id: vehicleId,
                },
                success: function (response) {
                     hideLoading();
                     if(response.success){
                         $('select[name="brand_id"]').val(response.brand_id).change();
                         $('select[name="model_id"]').val(response.model_id).change();
                         $('select[name="vehicle_type_id"]').val(response.vehicle_type_id).change();
                         $('select[name="branch_id"]').val(response.branch_id).change();
                         $('select[name="mechanic_id"]').val(response.branch_id).change();
                         $('select[name="garage_management_id"]').val(response.branch_id).change();




                     }else{
                         $('select[name="brand_id"]').val('').change();
                         $('select[name="model_id"]').val('').change();
                         $('select[name="vehicle_type_id"]').val('').change();
                         $('select[name="branch_id"]').val('').change();
                         $('select[name="mechanic_id"]').val('').change();
                         $('select[name="garage_management_id"]').val('').change();
                     }

                },
                error: function () {
                    hideLoading();
                    Swal.fire({
                        title: 'Xəta!',
                        text: 'Bir xəta baş verdi!',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        }
    });
});


$(document).ready(function() {
    $('#equipmentProcurementCategory').on('change', function () {
        var categoryId = $(this).val();
        var $select2Element = $("#equipmentProcurementSubCategory");
        $select2Element.empty();
        showLoading();
        if (categoryId) {
            $.ajax({
                url: $(this).attr('data-url'),
                type: "POST",
                data: {
                    category_id: categoryId,
                },
                success: function (response) {
                    hideLoading();
                    $select2Element.append(response.data);
                    $select2Element.trigger('change');
                    $select2Element.prop('disabled', false);
                },
                error: function () {
                    hideLoading();
                    Swal.fire({
                        title: 'Xəta!',
                        text: 'Bir xəta baş verdi!',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        }
    });
});



$("#hideServiceQuestionService").on("change", function (){
    var val = $(this).val();
    $('.hideServiceQuestionElement').find('input').val('')
    $("#hideServiceQuestionElementSelect").find('select').val('').change()
    $(".showElement").removeClass('showElement')
    if(val == 1 ){
        $(".hideServiceQuestionElement").hide();
        $("#hideServiceQuestionElementSelect").show();
    }else if(val == 2){
        $(".hideServiceQuestionElement").show();
        $("#hideServiceQuestionElementSelect").hide();
    }else {
        $(".hideServiceQuestionElement").hide();
        $("#hideServiceQuestionElementSelect").hide();
    }
})

