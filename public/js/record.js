$(document).on('change','#showDeactivated',function(e){
    e.preventDefault();
    var link = $(this).data('link');
    var set = ($(this).prop('checked') ? 0 : 1);
    $('#loading').removeClass('hidden');    
    $.ajax({
        type: "POST",
        url: "/"+link+"/switch",
        data: {set: set},
        success:function(data){
            $('#box-body').html(data);
            $('#tableData').DataTable({});
            $('#loading').addClass('hidden');    
        },
        error: function(data){
            console.log('error');
            $('#loading').addClass('hidden');    
        }
    });
});
// deactivate
$(document).on('click','#btnDeactivate',function(e){
    e.preventDefault();
    var link = $(this).data('link');    
    var id = $(this).data('id');    
    bootbox.confirm({ 
        size: "small",
        title: "<b>Deactivate</b>",
        message:  "This record will not be used on further transactions.",
        callback: function(result){ 
            if(result){
                $('#loading').removeClass('hidden');
                $.ajax({
                    url: "/"+link+"/0",
                    type:"DELETE",
                    data: {id : id},
                    success:function(data){
                        $('#box-body').html(data);
                        $('#tableData').DataTable({});
                        SuccessAlert();
                        $('#loading').addClass('hidden');                
                    },
                    error:function(data){ 
                        ErrorAlert();
                        $('#loading').addClass('hidden');                
                    }
                });
            }
        }
    })
});
// reactivate
$(document).on('click','#btnReactivate',function(e){
    e.preventDefault();
    var link = $(this).data('link');    
    var id = $(this).data('id');    
    bootbox.confirm({ 
        size: "small",
        title: "<b>Reactivate</b>",
        message:  "This record will be used again on further transactions.",
        callback: function(result){ 
            if(result){
                $('#loading').removeClass('hidden');
                $.ajax({
                    url: "/"+link+"/reactivate",
                    type:"POST",
                    data: {id : id},
                    success:function(data){
                        $('#box-body').html(data);
                        $('#tableData').DataTable({});
                        SuccessAlert();
                        $('#loading').addClass('hidden');                
                    },
                    error:function(data){ 
                        ErrorAlert();
                        $('#loading').addClass('hidden');                
                    }
                });
            }
        }
    })
});