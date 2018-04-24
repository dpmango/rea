$(document).ready(function(){

  //////////
  // Global variables
  //////////

  var _window = $(window);
  var _document = $(document);

  _document
    // open hamburger
    .on('click', '.js-open-mobile-menu', function(e){
      $(this).toggleClass('is-active');
      $('.m-menu').toggleClass('is-active');

      e.stopPropagation();
    })
    //close haburger
    .on('click', '.js-close-mobile-menu', function(e){
      closeMobileMenu();
    })
    // mobile user nav
    .on('click', '.js-toggle-user-nav', function(e){
      $('.user-menu__drop').toggleClass('is-active');
      e.stopPropagation();
    })
    // outside click
    .on('click', function(e){
      if ( !$(e.target).closest('.m-menu').length > 0 ){
        closeMobileMenu();
      }
      if ( !$(e.target).closest('.user-menu__drop').length > 0 ){
        $('.user-menu__drop').removeClass('is-active');
      }
    })

  function closeMobileMenu(){
    $('.js-open-mobile-menu').removeClass('is-active');
    $('.m-menu').removeClass('is-active');
  }

  // resize helper
  _window.on('resize', debounce(function(e){
    if ( _window.width() > 992 ){
      closeMobileMenu();
    }
    if ( _window.width() > 768 ){
      $('.user-menu__drop').removeClass('is-active');
    }
  }, 250))


  //* LK nav
  function initMobileNav(){
    var rightMenu = $('.es-rightmenu');
    var rightMenuList = rightMenu.find('li');
    var selectric = $('.js-selectric');

    if ( selectric.length > 0 ){
      selectric.selectric({
        maxHeight: 410,
        responsive: true,
        onBeforeInit: function(){
          rightMenuList.each(function(i, li){
            var isSelected = "";
            if ( $(li).is('.active') ){
              isSelected = "selected"
            }
            selectric.append('<option '+ isSelected +' data-value="'+ $(li).find('a').attr('href') +'">' + $(li).find('a').html() + '</option>');
          });
        },
        optionsItemBuilder: function(itemData, element, index) {
          return '<a href="'+ itemData.element.data('value') +'">' + itemData.text + '</a>';
        },
        onChange: function(element){
          var targetHref= $(element).find('option:selected').data('value');
          // change localhost here also
          window.location.href = 'http://localhost:3000' + targetHref
        },
        // change localhost here!
        arrowButtonMarkup: '<b class="button"><svg class="ico ico-drop-arrow"><use xlink:href="http://localhost:3000/img/sprite.svg#ico-drop-arrow"></use></svg></b>',
      });
    }
  }

  initMobileNav();


  ////////////
  // TELEPORT PLUGIN
  ////////////
  function initTeleport(){
    $('.js-teleport').each(function (i, val) {
      var self = $(val)
      var objHtml = $(val).html();
      var target = $('[data-teleport-target=' + $(val).data('teleport-to') + ']');
      var conditionMedia = $(val).data('teleport-condition').substring(1);
      var conditionPosition = $(val).data('teleport-condition').substring(0, 1);

      if (target && objHtml && conditionPosition) {

        function teleport() {
          var condition;

          if (conditionPosition === "<") {
            condition = _window.width() < conditionMedia;
          } else if (conditionPosition === ">") {
            condition = _window.width() > conditionMedia;
          }

          if (condition) {
            console.log(target)
            target.html(objHtml)
            self.html('')
          } else {
            self.html(objHtml)
            target.html("")
          }
        }

        teleport();
        _window.on('resize', debounce(teleport, 200));


      }
    })
  }

  initTeleport();


  /// GRADES TABLE
  if (  $('.es-progress__tab-body-item').length > 0 ){
    $('.es-progress__tab-body-item').each(function(i, table){
      var table = $(table);
      var head = table.find('.es-progress__line:first-child .es-progress__line-item');
      var headNames = [];
      var rows = table.find('.es-progress__line:not(:first-child)');
      head.each(function(i, tr){
        headNames.push( $(tr).html() )
      })
      rows.each(function(i, tr){
        var td = $(tr).find('.es-progress__line-item')

        td.each(function(i, td){
          // ignore first (tr header)
          if ( i == 0 ){
            return
          }
          $(td).prepend('<span class="for-mobile">'+ headNames[i] +'</span>')
        })
      })
    });
  }

  /// REQUEST TABLE
  if (  $('.request__list').length > 0 ){
    $('.request__list').each(function(i, table){
      var table = $(table);
      var head = table.find('.request__list-header div');
      var headNames = [];
      var rows = table.find('.request__list-line');
      head.each(function(i, tr){
        headNames.push( $(tr).html() )
      })
      console.log(headNames)
      rows.each(function(i, tr){
        var td = $(tr).find('div')
        td.each(function(i, td){
          // ignore first (tr header)
          if ( i == 0 ){
            return
          }
          $(td).prepend('<span class="for-mobile">'+ headNames[i] +'</span>')
        })
      })
    });
  }

  // SHEDULE TABLE COLORS
  if ( $('.table_lessons').length > 0 ) {
    function setTableColors(){
      $('.table_lessons td').each(function(i, td){
        var bg = $(td).css('background-color');
        var prevSibl = $(td).prev()
        console.log(bg)
        if (  bg != "rgb(255, 255, 255)" && bg != "rgb(2, 24, 43)" ){
          // copy bg color
          if ( _window.width() < 767 ){
            prevSibl.css({
              'background-color': bg
            })
          } else {
            prevSibl.css({
              'background-color': "rgb(255, 255, 255)"
            })
          }
        }
      })
    }

    setTableColors();
    _window.on('resize', debounce(setTableColors, 200));


  }




  // ADS REMOVE NSBP
  if ( $('.appeal__content__head_contact').length > 0 ){
    // $('.appeal__content__head_contact').html().replace(/\u00A0/g, '')
  }


});
