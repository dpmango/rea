/**
 * Класс для работы с формами.
 *
 * @constructor
 */
var SebekonForm = function () {};

SebekonForm.clearForm = function(formAnchor){

    $('#'+formAnchor).trigger( 'reset' );

    $.fancybox.close();

    return true;
};

SebekonForm.clearSelect2Form = function(){

    var formFields = [
        '#ads_group_select',
        '#ads_student_select',
        '#ads_important',
        '#ads_text',
        '#ads_file'
    ];

    $('#ads_group_select').html('');
    $('#ads_student_select').html('');
    $('#ads_important').prop( "checked", false );

   for(var i = 0; i < formFields.length; i++){
       SebekonForm.clearFormField(formFields[i]);
   }

    $('#appeal_form').find('.is_error').removeClass('is_error');

    $.fancybox.close();

    return true;
};

SebekonForm.clearFormField = function(anchor){
    $(anchor).val(null).trigger('change');

    return true;
};

SebekonForm.spotForm = function(element){
    return $(element).closest("form");
};

SebekonForm.collectData = function(form){

    return new FormData(form.get(0));
};

SebekonForm.sendFormData = function(type, url, sendData, succFunction, target) {

    $.ajax({
        type: type,
        url: url,
        cache: false,
        data: sendData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (result) {

            if(succFunction !== false){
                succFunction(result, target);
            }
            //console.log(result);
        }
    });
};

$(document).ready(function() {


});