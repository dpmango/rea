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


});
