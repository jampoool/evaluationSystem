$(document).ready(function(){
    var i = 1;

    $('#add').click(function(){
        i++;
        $('.col-md-6:last').append('<div id="row'+i+'" class="input-group mb-3"><input type="text" name="questions[]" placeholder="Enter your Question" class="form-control name_list" /><button type="button" name="remove" id="'+i+'" class="btn btn-outline-danger btn-remove">X</button></div>');
    });

    $(document).on('click', '.btn-remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });

    // Keep the "Add More" button visible
   
});
