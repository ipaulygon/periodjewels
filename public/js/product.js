// initialize
$(document).ready(function(){
    var time = moment().format('MMDDYY');
    $('#tableData').DataTable({
        responsive: true
    });
    $('.select2').select2();
    $("#carat").inputmask({ 
        alias: "currency",
        prefix: '',
        allowMinus: false,
        autoGroup: true,
        min: 0
    });
    $("#price").inputmask({ 
        alias: "currency",
        prefix: '',
        allowMinus: false,
        autoGroup: true,
        min: 0
    });
    $("#caratUpdate").inputmask({ 
        alias: "currency",
        prefix: '',
        allowMinus: false,
        autoGroup: true,
        min: 0
    });
    $("#priceUpdate").inputmask({ 
        alias: "currency",
        prefix: '',
        allowMinus: false,
        autoGroup: true,
        min: 0
    });
});

function Reset(){
    $('#gem').val('');
    $('#jewelry').val('');
    $('#carat').val('');
    $('#color').val('');
    $('#clarity').val('');
    $('#cut').val('');
    $('#origin').val('');
    $('#price').val('');
    $('#description').val('');
    $('#certificate').val('');
    $('#image').val('');
    $('#gemUpdate').val();
    $('#caratUpdate').val();
    $('#jewelryUpdate').val();
    $('#colorUpdate').val();
    $('#clarityUpdate').val();
    $('#cutUpdate').val();
    $('#originUpdate').val();
    $('#descriptionUpdate').val();
    $('#priceUpdate').val();
    $('#certificateUpdate').val('');
    $('#imageUpdate').val('');
    $('.select2').select2();
}

$(document).on('change','#certificate',function(){
    var valid = true;
    var validation = true;
    if (parseInt($(this).get(0).files.length) > 4){
        valid = false;
        alert("You can only upload a maximum of 4 files");
    }
    validationError = "File(s) are not in correct format: ";
    $.each($(this).get(0).files,function(key,value){
        if(value.type != "image/jpg" && value.type != "image/jpeg" && value.type != "image/png"){
            valid = false;
            validation = false;
            validationError += value.name+", ";
        }
    });
    if(valid){
        $('#certificateList').children().remove();
        $.each($(this).get(0).files,function(key,value){
            $('#certificateList').append('<li>'+value.name+'</li>')
        });
    }else{
        $(this).val('');
        $('#certificateList').children().remove();
        (validation ? console.log('') : alert(validationError));        
    }
});

$(document).on('change','#image',function(){
    var valid = true;
    var validation = true;
    if (parseInt($(this).get(0).files.length) > 6){
        valid = false;
        alert("You can only upload a maximum of 6 files");
    }
    var validationError = "File(s) are not in correct format: "; 
    $.each($(this).get(0).files,function(key,value){
        if(value.type != "image/jpg" && value.type != "image/jpeg" && value.type != "image/png"){
            valid = false;
            validation = false;
            validationError += value.name+", ";
        }
    });
    if(valid){
        $('#imagePreview').children().remove();
        $.each($(this).get(0).files,function(key,value){
            $('#imagePreview').append(
                '<div class="col-md-6">' +
                '<div class="box box-solid">' +
                '<div class="box-body box-profile">' +
                '<center>' +
                '<img class="img-responsive" id="imageThumbnail'+key+'" src="" style="height:190px!important;background-size:contain;padding: 2px" />' +
                '<button type="button" class="btn btn-default setMain" data-main="'+key+'"><i class="fa fa-circle-o"></i> Set Main</button>' +
                '</center>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imageThumbnail'+key)
                .attr('src', e.target.result)
            };
            reader.readAsDataURL(value);
        });
    }else{
        $(this).val('');
        $('#imagePreview').children().remove();
        (validation ? console.log('') : alert(validationError));
    }
})

$(document).on('click','.setMain',function(){
    $('.imageMain').html('<i class="fa fa-circle-o"></i> Set Main');
    $('.imageMain').attr('class','btn btn-default setMain');
    $(this).html('<i class="fa fa-check"></i> Main Image');
    $(this).attr('class','btn btn-primary imageMain');
    $('#main').val($(this).data('main'));
});

// create
$(document).on('submit', '#createForm', function(e){
    e.preventDefault();
    $('.form-group').removeClass('has-error');
    $('.text-danger li').remove();
    $('#submitCreate').button('loading');
    $('#loading').removeClass('hidden');
    var data = new FormData($('#createForm')[0]);
    $.ajax({
        type: "POST",
        url: "/product",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data){
            if(data.errors){
                $.each(data.errors, function(key,value){
                    $('#'+key+'Form').addClass('has-error');
                    $.each(value, function(subkey, subvalue){
                        $('#'+key+'Error').append('<li>'+subvalue+'</li>');
                    });
                });
            }else{
                $('#box-body').html(data);
                $('#createModal').modal('hide');
                $('#tableData').DataTable({});
                Reset();
                SuccessAlert();
            }
            $('#submitCreate').button('reset');
            $('#loading').addClass('hidden');
        },
        error: function(data){
            $('#createModal').modal('hide');
            ErrorAlert();
            $('#submitCreate').button('reset');
            $('#loading').addClass('hidden');
        }
    });
});

// update
$(document).on('change','#certificateUpdate',function(){
    var valid = true;
    var validation = true;
    if (parseInt($(this).get(0).files.length) > 4){
        valid = false;
        alert("You can only upload a maximum of 4 files");
    }
    validationError = "File(s) are not in correct format: ";
    $.each($(this).get(0).files,function(key,value){
        if(value.type != "image/jpg" && value.type != "image/jpeg" && value.type != "image/png"){
            valid = false;
            validation = false;
            validationError += value.name+", ";
        }
    });
    if(valid){
        $('#certificateListUpdate').children().remove();
        $.each($(this).get(0).files,function(key,value){
            $('#certificateListUpdate').append('<li>'+value.name+'</li>')
        });
    }else{
        $(this).val('');
        $('#certificateListUpdate').children().remove();
        (validation ? console.log('') : alert(validationError));        
    }
});

$(document).on('change','#imageUpdate',function(){
    var valid = true;
    var validation = true;
    if (parseInt($(this).get(0).files.length) > 6){
        valid = false;
        alert("You can only upload a maximum of 6 files");
    }
    var validationError = "File(s) are not in correct format: "; 
    $.each($(this).get(0).files,function(key,value){
        if(value.type != "image/jpg" && value.type != "image/jpeg" && value.type != "image/png"){
            valid = false;
            validation = false;
            validationError += value.name+", ";
        }
    });
    if(valid){
        $('#imagePreviewUpdate').children().remove();
        $.each($(this).get(0).files,function(key,value){
            $('#imagePreviewUpdate').append(
                '<div class="col-md-6">' +
                '<div class="box box-solid">' +
                '<div class="box-body box-profile">' +
                '<center>' +
                '<img class="img-responsive" id="imageThumbnail'+key+'" src="" style="height:190px!important;background-size:contain;padding: 2px" />' +
                '<button type="button" class="btn btn-default setMain" data-main="'+key+'"><i class="fa fa-circle-o"></i> Set Main</button>' +
                '</center>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imageThumbnailUpdate'+key)
                .attr('src', e.target.result)
            };
            reader.readAsDataURL(value);
        });
    }else{
        $(this).val('');
        $('#imagePreviewUpdate').children().remove();
        (validation ? console.log('') : alert(validationError));
    }
})

$(document).on('click','.setMainUpdate',function(){
    $('.imageMainUpdate').html('<i class="fa fa-circle-o"></i> Set Main');
    $('.imageMainUpdate').attr('class','btn btn-default setMainUpdate');
    $(this).html('<i class="fa fa-check"></i> Main Image');
    $(this).attr('class','btn btn-primary imageMainUpdate');
    $('#mainUpdate').val($(this).data('main'));
});

$(document).on('click','#btnUpdate',function(){
    var id = $(this).data('id');
    var gem = rowFinder($(this)).find('#dataGem').data('gem'); 
    var carat = rowFinder($(this)).find('#dataCarat').data('carat');
    var jewelry = rowFinder($(this)).find('#dataDescription').data('jewelry');
    var color = rowFinder($(this)).find('#dataDescription').data('color');
    var clarity = rowFinder($(this)).find('#dataDescription').data('clarity');
    var cut = rowFinder($(this)).find('#dataDescription').data('cut');
    var origin = rowFinder($(this)).find('#dataDescription').data('origin');
    var description = rowFinder($(this)).find('#dataDescription').data('description');
    var price = rowFinder($(this)).find('#dataPrice').data('price');
    var certificate = rowFinder($(this)).find('#dataCertificate').data('certificate');
    var image = rowFinder($(this)).find('#dataImage').data('image');
    $('#idUpdate').val(id);
    $('#gemUpdate').val(gem);
    $('#caratUpdate').val(carat);
    $('#jewelryUpdate').val(jewelry);
    $('#colorUpdate').val(color);
    $('#clarityUpdate').val(clarity);
    $('#cutUpdate').val(cut);
    $('#originUpdate').val(origin);
    $('#descriptionUpdate').val(description);
    $('#priceUpdate').val(price);
    $('.select2').select2();
    $('#certificateListUpdate').children().remove();
    $.each(certificate,function(key,value){
        $('#certificateListUpdate').append('<li>'+value.certificate+'</li>')
    });
    $('#imagePreviewUpdate').children().remove();    
    $.each(image,function(key,value){
        if(!value.isMain){
            $('#imagePreviewUpdate').append(
                '<div class="col-md-6">' +
                '<div class="box box-solid">' +
                '<div class="box-body box-profile">' +
                '<center>' +
                '<img class="img-responsive" id="imageThumbnail'+key+'" src="'+value.image+'" style="height:190px!important;background-size:contain;padding: 2px" />' +
                '<button type="button" class="btn btn-default setMainUpdate" data-main="'+key+'"><i class="fa fa-circle-o"></i> Set Main</button>' +
                '</center>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
        }else{
            $('#imagePreviewUpdate').append(
                '<div class="col-md-6">' +
                '<div class="box box-solid">' +
                '<div class="box-body box-profile">' +
                '<center>' +
                '<img class="img-responsive" id="imageThumbnail'+key+'" src="'+value.image+'" style="height:190px!important;background-size:contain;padding: 2px" />' +
                '<button type="button" class="btn btn-primary imageMainUpdate" data-main="'+key+'"><i class="fa fa-check"></i> Main Image</button>' +
                '</center>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
            $('#mainUpdate').val(key);
        }
    });
    $('#updateModal').modal('show');
});

$(document).on('submit', '#updateForm', function(e){
    e.preventDefault();
    $('.form-group').removeClass('has-error');
    $('.text-danger li').remove();
    $('#submitUpdate').button('loading');
    $('#loading').removeClass('hidden');
    var data = new FormData($('#updateForm')[0]);
    $.ajax({
        type: "POST",
        url: "/product/0",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data){
            console.log(data);
            if(data.errors){
                $.each(data.errors, function(key,value){
                    $('#'+key+'FormUpdate').addClass('has-error');
                    $.each(value, function(subkey, subvalue){
                        $('#'+key+'ErrorUpdate').append('<li>'+subvalue+'</li>');
                    });
                });
            }else{
                $('#box-body').html(data);
                $('#updateModal').modal('hide');
                $('#tableData').DataTable({
                    responsive: true
                });
                Reset();
                SuccessAlert();
            }
            $('#submitUpdate').button('reset');
            $('#loading').addClass('hidden');
        },
        error: function(data){
            $('#updateModal').modal('hide');
            ErrorAlert();
            $('#submitUpdate').button('reset');
            $('#loading').addClass('hidden');
        }
    });
});

