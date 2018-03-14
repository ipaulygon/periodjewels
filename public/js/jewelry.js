// initialize
$(document).ready(function(){
    var time = moment().format('MMDDYY');
    $('#tableData').DataTable({
    });
});

function Reset(){
    $('#name').val('');
    $('#description').val('');
    $('#nameUpdate').val('');
    $('#descriptionUpdate').val('');
}
// create
$(document).on('submit', '#createForm', function(e){
    e.preventDefault();
    $('.formGroup').removeClass('has-error');
    $('#submitCreate').button('loading');
    $('#loading').removeClass('hidden');
    $.ajax({
        type: "POST",
        url: "/jewelry/store",
        data: $('#createForm').serialize(),
        success: function(data){
            if(data.errors){
                $.each(data.errors, function(key,value){
                    $('#'+key+'Form').addClass('has-error');
                    $('#'+key+'Error li').remove();
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
        },
        error: function(data){
            $('#createModal').modal('hide');
            ErrorAlert();
        }
    });
    $('#submitCreate').button('reset');
    $('#loading').addClass('hidden');
});
// update
$(document).on('click','#btnUpdate',function(){
    var id = $(this).data('id');
    var name = $(this).parent().parent().find('#dataName').text(); 
    var description = $(this).parent().parent().find('#dataDescription').text();
    $('#idUpdate').val(id);
    $('#nameUpdate').val(name);
    $('#descriptionUpdate').val(description);
    $('#updateModal').modal('show');
});

$(document).on('submit','#updateForm',function(e){
    e.preventDefault();
    $('.formGroup').removeClass('has-error');
    $('#submitUpdate').button('loading');
    $('#loading').removeClass('hidden');
    $.ajax({
        type: "POST",
        url: "/jewelry/0",
        data: $('#updateForm').serialize(),
        success: function(data){
            if(data.errors){
                $.each(data.errors, function(key,value){
                    $('#'+key+'FormUpdate').addClass('has-error');
                    $('#'+key+'ErrorUpdate li').remove();
                    $.each(value, function(subkey, subvalue){
                        $('#'+key+'ErrorUpdate').append('<li>'+subvalue+'</li>');
                    });
                });
            }else{
                $('#box-body').html(data);
                $('#updateModal').modal('hide');
                $('#tableData').DataTable({});
                Reset();
                SuccessAlert();
            }
        },
        error: function(data){
            $('#updateModal').modal('hide');
            ErrorAlert();
        }
    });
    $('#submitUpdate').button('reset');
    $('#loading').addClass('hidden');
});