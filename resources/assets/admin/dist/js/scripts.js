const autoNumericOptionsRuble = {
    currencySymbol: "\u202f₽",
    currencySymbolPlacement: "s",
    decimalCharacterAlternative: ".",
    digitGroupSeparator: " ",
    minimumValue: "0"
};

$(document).ready(function (){
    $("#example1").DataTable();
    $(".select2").select2();

    //Flat red color scheme for iCheck
    $("#all_categories").iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    });


    $("#all_categories").on('ifChecked', function(event){
        $("#categories > option").prop("selected","selected");
        $("#categories").trigger("change");
        console.log('all');
    });


    $("#all_categories").on('ifUnchecked', function(event){
        $("#categories > option").removeAttr("selected");
        $("#categories").trigger("change");
        $("ul.select2-selection__rendered >.select2-selection__choice").remove();
        console.log('Of all');
    });

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yy'
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });


    $('[data-toggle="tooltip"]').tooltip();
    $('#number').inputmask({ mask: "+*[**] (999[9]) 999-99-99", "placeholder": "*" });

    // $('#price, #vendor_price').maskMoney();

    $('#slug').slugify('#title');

    AutoNumeric.multiple('#price', autoNumericOptionsRuble);

});

