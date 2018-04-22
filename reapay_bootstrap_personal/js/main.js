
var loader = {
    loaderId: "loader",
    loaderImage: '/loading.gif',
    show: function( select$ ){
        var div$ = $("<div>").attr("id",this.loaderId).append("<img src='"+this.loaderImage+"'>");
        select$.append( div$ );
    },
    remove: function(){
        $("#"+this.loaderId).remove();
    }

};

function cabinetsearch(val)
{
    document.location.href= "http://www.rea.ru/ru/Pages/Search/results.aspx#k="+val;
}

function initTooltip( $target )
{

    $target.qtip({
        content: {
            attr: 'data-tooltip'
        },
        position: {
            my: 'top left',  // Position my top left...
            at: 'bottom center' // at the bottom right of...
        },
        style: {
            classes: 'qtip-light qtip-shadow'
        }
    });

}


$(function(){


    var checkAgreement = function(){


        $('.agreement_checkbox').each(function(){

            var $agreementCheckbox = $(this);
            //var $target = $('#'+ $(this).data('target') );

            //console.log( $agreementCheckbox.is(':checked') );

            if ( $agreementCheckbox.is(':checked') ) {
                $agreementCheckbox.closest("form").find("button[type='submit']").removeAttr("disabled").removeClass('disabled');
            }else {
                $agreementCheckbox.closest("form").find("button[type='submit']").attr("disabled","disabled").addClass('disabled');
            }

        });


    };

    checkAgreement();

    $(".agreement_checkbox").on("click",checkAgreement); //





    initTooltip( $('[rel=tooltip]') );

    var $clock = $("#clock");
    var timestamp = $clock.data("time");

    setInterval(function(){
        setClockTime($clock,++timestamp);
    },1000);

    function setClockTime($clock,unix_timestamp)
    {

        // Gets the current time
        var now = new Date( unix_timestamp*1000 );

        // Get the hours, minutes and seconds from the current time
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var day =  now.getDate();
        var year = now.getFullYear();
        var month = now.getMonth()+1;

        //console.log( now.toString() );
        //console.log( day );


        // Format hours, minutes and seconds
        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        if (day< 10) {
            day = "0" + day;
        }
        //if (year< 10) {
          //  year = "0" + year;
        //}
        if (month< 10) {
            month = "0" + month;
        }

        $clock.html('<span>'+day+'.'+month+'.'+year+'</span> '+hours + ':' + minutes + ':' + seconds);

    }
});

$(document).ready(function () {

    $('.counter__btn-minus').click(function () {
        var $input = $(this).parent().prev().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.counter__btn-plus').on('click', function () {
        console.log('lol');
        var $input = $(this).parent().prev().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });



    $('.showmobile1').click(function () {
        $(this).toggleClass('vision');
        if ($(this).hasClass('vision')) {
            $('.mainmenu .navbar-nav').slideDown();
            $('.submainmenu .navbar-nav').slideDown();
        } else {
            $('.mainmenu .navbar-nav').slideUp();
            $('.submainmenu .navbar-nav').slideUp();
        }
    });

    $(".submainmenu .navbar-nav > li").each(function () {
        var list = $(this).find('ul');

        if (list.length > 0) {
            $(this).addClass('hasChild');
            $(this).find('a:first').addClass('hasChilda');
        }
    })

    $(".personal__tabs").each(function () {
        var tmp = $(this);
        $(tmp).find(".personal__tabs-header li").each(function (i) {
            $(tmp).find(".personal__tabs-header li:eq("+i+") a").click(function(){
                var tab_id=i+1;
                $(tmp).find(".personal__tabs-header li").removeClass("active");
                $(this).parent().addClass("active");
                $(tmp).find(".personal__tabs-content .tab-item").stop(false,false).hide();
                $(tmp).find(".tab"+tab_id).stop(false,false).show();
                return false;
            });
        });
    });

    $(".es-progress__tab").each(function () {
        var tmp = $(this);
        $(tmp).find(".es-progress__tab-header li").each(function (i) {
            $(tmp).find(".es-progress__tab-header li:eq("+i+")").click(function(){
                var tab_id=i+1;
                $(tmp).find(".es-progress__tab-header li").removeClass("active");
                $(this).addClass("active");
                $(tmp).find(".es-progress__tab-body-item").stop(false,false).hide();
                $(tmp).find(".tab"+tab_id).stop(false,false).show();
                return false;
            });
        });
    });


    $('.es-training__title').on('click', function() {
        $(this).toggleClass('active');
        $(this).next('.es-training__body').stop().animate({'height':'toggle'}, 300);
    });


    $('.es-training__spoiler .es-training__desc').on('click', function() {
        $(this).toggleClass('active');
        $(this).next('.es-training__hidden').stop().animate({'height':'toggle'}, 300);
        var descText = $(this).text();
        console.log(descText);

        if(descText == 'Скрыть')
            $(this).text('Показать');
        else
            $(this).text('Скрыть');
    });

    $('.hasChilda').each(function () {
        $(this).attr('href', 'javascript:void(0)');
    });

    // инициализация поп-ап окон
    $('.fancybox').fancybox({
        smallBtn : true,
        fullScreen : false,
        closeBtn   : false,
        buttons : false
        // touch : false,
    });

    BX.addCustomEvent("onPullEvent", BX.delegate(function(module_id, command, params){

        if(SebekonHelper.readNotifyBox(command) && SebekonHelper.lastAdsID !== params.ads_id){
            SebekonHelper.sendAjaxRequest(
                'GET',
                '/ajax/get_list_info.php',
                {
                    ads_id: params.ads_id,
                    type: 'new_ads'
                },
                SebekonHelper.pasteToDomElement,
                '#ads_field'
            );
        }
        else{
            SebekonHelper.addNotify(command, false);
        }
        //console.log(module_id, command, params);
    }, this));

    $('.hasChilda').bind('click', function () {

        $(this).parents('.hasChild').toggleClass('released');
        if ($(this).parents('.hasChild').hasClass('released')) {
            $(this).parents('.hasChild').children('ul').slideDown();
        } else {
            $(this).parents('.hasChild').children('ul').slideUp();
        }
    });

    try{
        document.form_auth.USER_PASSWORD.focus();
    }
    catch(e){

    }
	
});
var Sebekon = {};
Sebekon.addPopup = function (elementId) {
    $('[href=#'+elementId+']').fancybox({
        smallBtn : true,
        fullScreen : false,
        closeBtn   : false,
        buttons : false
        // touch : false,
    });
};
