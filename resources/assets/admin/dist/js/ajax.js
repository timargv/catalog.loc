$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#btn-toggle', function() {
        var category = $(this).data('id');

        $.ajax({
            type:'POST',
            url:'/admin/categories/toggle-status',
            data:{category:category},
            success:function(data){
                console.log(data.success);
            }
        });
    });

});