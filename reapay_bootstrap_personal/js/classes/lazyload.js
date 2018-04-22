var SebekonLazyLoad = function () {};

SebekonLazyLoad.isLazyProcess = false;

SebekonLazyLoad.Mark = {};

SebekonLazyLoad.pageURL = '';

SebekonLazyLoad.checkDistanceAjaxBlock = function () {

    if(SebekonLazyLoad.Mark.length > 0){

        var blockDist = $(SebekonLazyLoad.Mark).offset().top;

        var windowScroll = $(window).scrollTop();

        //console.log([blockDist, windowScroll]);

        if(windowScroll >= blockDist){

            SebekonLazyLoad.loadNewInformation();
        }
        else{
            SebekonLazyLoad.isLazyProcess = false;
        }
    }

    return true;

};

SebekonLazyLoad.setMark = function () {

    SebekonLazyLoad.Mark = $('div[data-lazyloaded="N"]');

    //console.log(SebekonLazyLoad.Mark);

    return true;
};

SebekonLazyLoad.unlinkMark = function () {

    $(SebekonLazyLoad.Mark).attr("data-lazyloaded", "Y");

    return true;
};

SebekonLazyLoad.getRequestHandler = function (result, target) {

    SebekonLazyLoad.unlinkMark();

    SebekonHelper.pasteToDomElement(result, target);

    SebekonLazyLoad.setMark();

    SebekonLazyLoad.isLazyProcess = false;
};

SebekonLazyLoad.loadNewInformation = function () {

    if(!SebekonLazyLoad.isLazyProcess){

        //console.log(SebekonLazyLoad.Mark.attr("data-lazyoffset"));

        SebekonLazyLoad.isLazyProcess = true;

        SebekonHelper.sendAjaxRequest(
            'GET',
            SebekonLazyLoad.pageURL,
            {
                lazy_offset: SebekonLazyLoad.Mark.attr("data-lazyoffset")
            },
            SebekonLazyLoad.getRequestHandler,
            "#ads_field"
        );
    }
};

$(document).ready(function() {

    SebekonLazyLoad.setMark();

    SebekonLazyLoad.checkDistanceAjaxBlock();

    $(window).scroll(function(){

        SebekonLazyLoad.checkDistanceAjaxBlock();

    });

});