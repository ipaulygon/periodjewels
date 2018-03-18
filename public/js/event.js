// initialize
$(document).ready(function(){
    var time = moment().format('MMDDYY');
    $('#tableData').DataTable({
    });
});

//create
var start = moment();
var end = moment();

function cb(start, end) {
    $('#date input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#date').daterangepicker({
    opens: 'left',
    minDate: start,
    startDate: start,
    endDate: end,
    ranges: {
        'Today': [moment(), moment()],
        'Last for 7 Days': [moment(), moment().add(6, 'days')],
        'Last for 30 Days': [moment(), moment().add(29, 'days')],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
    }
}, cb);

cb(start, end);

//update
function cbUpdate(start, end) {
    $('#dateUpdate input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#dateUpdate').daterangepicker({
    opens: 'left',
    minDate: start,
    startDate: start,
    endDate: end,
    ranges: {
        'Today': [moment(), moment()],
        'Last for 7 Days': [moment(), moment().add(6, 'days')],
        'Last for 30 Days': [moment(), moment().add(29, 'days')],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
    }
}, cb);

cbUpdate(start, end);

function myMap(address,method) {
    var address = address;
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'address': address
        }, 
        function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
                new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map
                });
                map.setCenter(results[0].geometry.location);
                (method ? $('#valid').val('valid') : $('#validUpdate').val('valid'));          
            }else{
                (method ? $('#valid').val('') : $('#validUpdate').val(''));          
            }
    });
    var mapProp = {
        zoom: 17,
        scrollwheel: true,
        draggable: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = (method ? new google.maps.Map(document.getElementById("googleMap"), mapProp) : new google.maps.Map(document.getElementById("googleMapUpdate"), mapProp));
}

$(document).on('change','#address',function(){
    myMap($(this).val(),true);
});

$(document).on('change','#addressUpdate',function(){
    myMap($(this).val(),false);
});

function Reset(){
    $('#name').val('');
    $('#date').val('');
    $('#address').val('');
    $('#description').val('');
    $('#valid').val('');
    $('#nameUpdate').val('');
    $('#dateUpdate').val('');
    $('#addressUpdate').val('');
    $('#descriptionUpdate').val('');
    $('#validUpdate').val('');
    $('#address').trigger('change');
    $('#addressUpdate').trigger('change');
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
        url: "/event",
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
    var date = rowFinder($(this)).find('#dataDate').data('date');
    var address = rowFinder($(this)).find('#dataAddress').text();
    var description = rowFinder($(this)).find('#dataDescription').text();
    $('#idUpdate').val(id);
    $('#nameUpdate').val(name);
    $('#dateUpdate').val(date);
    $('#addressUpdate').val(address);
    $('#descriptionUpdate').val(description);
    $('#addressUpdate').trigger('change');    
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
        url: "/event/0",
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