jQuery(document).ready(function ($) {
    "use strict";
/**
* Mobile navigation scripts
*
*/   

// Elements to focus after modals are closed.
function wp_parallaxElFocus(focusElement){
     var _doc = document;
     setTimeout( function() {

    focusElement = _doc.querySelector( focusElement );
    focusElement.focus();

    }, 200 );
}


 $('body').on('click keypress','.toggle-wrapp', function(e){
    e.preventDefault();
     
    $('.site-header').toggleClass('toggled-on');
    $('body').toggleClass('toggled-modal');

    if( $(this).hasClass('close-wrapp') ){
        wp_parallaxElFocus('.mob-outer-wrapp .toggle-wrapp');
    }else{
        wp_parallaxElFocus('.toggle.close-wrapp.toggle-wrapp');
    }
   
 });



$('.mob-nav-wrapp ul li ul').slideUp();



$('body').on('vclick touchstart keypress','.mob-nav-wrapp .sub-toggle', function()  {
  
  $(this).next('ul.sub-menu').slideToggle(400);
  $(this).parent('li').toggleClass('mob-menu-toggle');
});

$('body').on('click touchstart keypress','.mob-nav-wrapp .sub-toggle-children',function() {
  $(this).next('ul.sub-menu').slideToggle(400);
    
});

wp_parallaxFocusTab();
function wp_parallaxFocusTab(){
        var _doc = document;

        _doc.addEventListener( 'keydown', function( event ) {
            var toggleTarget, modal, selectors, elements, menuType, bottomMenu, activeEl, lastEl, firstEl, tabKey, shiftKey;
                
            if ( _doc.body.classList.contains( 'toggled-modal' ) ) {
                toggleTarget = '.mob-nav-wrapp';//mobile menu wrapper
                selectors = 'input, a, button';
                modal = _doc.querySelector( toggleTarget );

                elements = modal.querySelectorAll( selectors );
                elements = Array.prototype.slice.call( elements );

                if ( '.menu-modal' === toggleTarget ) {
                    menuType = window.matchMedia( '(min-width: 1000px)' ).matches;
                    menuType = menuType ? '.expanded-menu' : '.mobile-menu';

                    elements = elements.filter( function( element ) {
                        return null !== element.closest( menuType ) && null !== element.offsetParent;
                    } );

                    elements.unshift( _doc.querySelector( '.mob-outer-wrapp .toggle-wrapp' ) ); //mobile toggle

                    bottomMenu = _doc.querySelector( '.mob-outer-wrapp .menu-last' );//mobile menu last div

                    if ( bottomMenu ) {
                        bottomMenu.querySelectorAll( selectors ).forEach( function( element ) {
                            elements.push( element );
                        } );
                    }
                }

                lastEl = elements[ elements.length - 1 ];
                firstEl = elements[0];
                activeEl = _doc.activeElement;
                tabKey = event.keyCode === 9;
                shiftKey = event.shiftKey;

                if ( ! shiftKey && tabKey && lastEl === activeEl ) {
                    event.preventDefault();
                    firstEl.focus();
                }

                if ( shiftKey && tabKey && firstEl === activeEl ) {
                    event.preventDefault();
                    lastEl.focus();
                }
            }
        } );
}


});