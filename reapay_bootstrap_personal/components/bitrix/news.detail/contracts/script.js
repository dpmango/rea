function Add2Basket(Type,Contract,Summ, ScheduleId){
    $.ajax({
        url:'/ajax/add2basket.php',
        data:({ // Что отсылаем
            TYPE: Type,
            CONTRACT: Contract,
            SUMM: Summ,
            SCHEDULE:ScheduleId
        }),
        async:false, // Ждем пока аякс придет и идем дальше
        type:'POST', // Каким методом
        dataType: 'html', // Тип получаемых данных
        success: function(ResultAjax){ // Действие при успешной обработке
            location.href="/order.php";
            console.log(ResultAjax);
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log (msg);
        }
    });
}