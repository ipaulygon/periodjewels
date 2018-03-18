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
    $('.form-group').removeClass('has-error');
    $('.text-danger li').remove();
    $('#submitCreate').button('loading');
    $('#loading').removeClass('hidden');
    $.ajax({
        type: "POST",
        url: "/jewelry",
        data: $('#createForm').serialize(),
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
$(document).on('click','#btnUpdate',function(){
    var id = $(this).data('id');
    var name = rowFinder($(this)).find('#dataName').text(); 
    var description = rowFinder($(this)).find('#dataDescription').text();
    $('#idUpdate').val(id);
    $('#nameUpdate').val(name);
    $('#descriptionUpdate').val(description);
    $('#updateModal').modal('show');
});

$(document).on('submit','#updateForm',function(e){
    e.preventDefault();
    $('.form-group').removeClass('has-error');
    $('.text-danger li').remove();
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