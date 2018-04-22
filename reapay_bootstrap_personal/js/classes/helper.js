/* OP, SEBEKON */
var SebekonHelper = function () {};

SebekonHelper.isOpenPopup = false;

SebekonHelper.NotifyPagesBox = [];

SebekonHelper.lastAdsID = 0;

SebekonHelper.maxHitTime = 86400000;

SebekonHelper.hitTime = sessionStorage.getItem('hittime');

// миллисекунды между всплываниями окошка с выбором факультета
SebekonHelper.maxFacultyTime = 300000;

SebekonHelper.facultySelectTime = sessionStorage.getItem('faculty');

SebekonHelper.now = new Date();

SebekonHelper.preloaderBox = '#areaForLoader';

/* отправка аякс запроса и получение ответа*/
SebekonHelper.sendAjaxRequest = function(type, url, sendData, succFunction, target) {

    $.ajax({
        type: type,
        url: url,
        cache: false,
        data: sendData,
        dataType: 'json',
        contentType: 'application/json',
        json: true,
        success: function (result) {

            if(succFunction !== false && result.status !== 'error'){
                succFunction(result, target);
            }
            //console.log(result);
        }
    });
};

SebekonHelper.sendAjaxRequestWithError = function(type, url, sendData, callBackFunction, callBackData) {

    $.ajax({
        type: type,
        url: url,
        cache: false,
        data: sendData,
        dataType: 'json',
        json: true,
        success: function (result) {

            if(callBackFunction !== undefined){
                callBackFunction(sendData, result, callBackData);
            }
        }
    });
};

SebekonHelper.arrayColumn = function(matrix, col) {

    var column = [];

    for(var i=0; i<matrix.length; i++){

        column.push(matrix[i][col]);
    }

    return column;
};

SebekonHelper.requestHandler = function(result, target){

    $('select[name=' + target + ']').empty().append(result.data);

    $('.dropdown').easyDropDown({});

    //console.log([result, target]);

    return true;
};

SebekonHelper.openPopup = function(targetAnchor){

    $.fancybox.open($('#'+targetAnchor));

    return true;
};

SebekonHelper.closePopup = function(){

    $.fancybox.close();

    return true;
};
/**
 *
 * @param type - ( ads - объявления, request - справки )
 * @param counter - счетчик-цифрка
 * @returns {boolean}
 */
SebekonHelper.addNotify = function(type, counter){

    if(counter === false){
        counter = '';
    }

    $('[data-'+type+'="Y"]').append('<span class="notify">'+counter+'</span>');

    return true;
};

SebekonHelper.hideNotify = function(type){

    $('[data-'+type+'="Y"] .notify').remove();

    return true;
};

SebekonHelper.loadToNotifyBox = function(page){

    SebekonHelper.NotifyPagesBox.push(page);

    return true;
};

SebekonHelper.readNotifyBox = function(page){

    var isPageInBox = true;

    var pageBoxKey = SebekonHelper.NotifyPagesBox.indexOf(page);

    if(pageBoxKey === -1){
        isPageInBox = false;
    }

    return isPageInBox;
};

SebekonHelper.pasteToDomElement = function(result, target){

    if(result.method === 'before'){
        $(target).prepend(result.data);
    }
    else{
        $(target).append(result.data);
    }

    return true;
};

SebekonHelper.showPreloader = function(){
    $(SebekonHelper.preloaderBox).fadeIn('slow');
};

SebekonHelper.hidePreloader = function(speed){

    if(speed === false){
        speed  = 'slow';
    }

    $(SebekonHelper.preloaderBox).fadeOut(speed);
};

SebekonHelper.toDate = function (dateStr) {
    var parts = dateStr.split(".");
    return new Date(parts[2], parts[1] - 1, parts[0]);
};

SebekonHelper.initDatepicker = function($inputDate, startDate, onSelect)
{
    var dp = $inputDate.datepicker({
        startDate: startDate,
        dateFormat: 'dd.mm.yyyy',
        onSelect: onSelect,
    }).data('datepicker');

    dp.selectDate(startDate);

    $inputDate.closest('form').find('.is_error').removeClass('is_error')
};