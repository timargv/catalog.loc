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


    $('#widgetProduct').select2({
        placeholder: 'Выберите продукт',
        ajax: {
            url: '/admin/widgets-autocomplete-ajax',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
});
