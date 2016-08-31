// MODAL BOX EFFECTS
$('.soundtheme-mini-link').magnificPopup({
	type:'inline',
	midClick: true,
  	fixedContentPos: true,
  	removalDelay: 300,
  	mainClass: 'mfp-fade'
});

$('.soundtheme-video-popup').magnificPopup({
    type: 'inline',
    preloader: false,
    closeOnContentClick: true,
    closeBtnInside: false,
    midClick: true,
    fixedContentPos: true,
    removalDelay: 300,
    mainClass: 'mfp-fade'
  });

// GALLERY
$('.soundtheme-gallery-space').each(function() {
    $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
          enabled: true,
		  preload: [0,2],
		  navigateByImgClick: true,
		  arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
		  tPrev: 'Previous (Left arrow key)',
		  tNext: 'Next (Right arrow key)'
        }
    });
});

$('.images').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
              enabled: true,
          preload: [0,2],
          navigateByImgClick: true,
          arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
          tPrev: 'Previous (Left arrow key)',
          tNext: 'Next (Right arrow key)'
            }
        });
    });

// FILTER
$(function() {
    $('#Container').mixItUp();
});

// SLIDER
( function( window ) {
'use strict';
function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}
var hasClass, addClass, removeClass;
if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}
function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}
var classie = {
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};
if ( typeof define === 'function' && define.amd ) {
  define( classie );
} else {
  window.classie = classie;
}
})( window );

(function() {
  var support = { animations : Modernizr.cssanimations },
    animEndEventNames = {
      'WebkitAnimation' : 'webkitAnimationEnd',
      'OAnimation' : 'oAnimationEnd',
      'msAnimation' : 'MSAnimationEnd',
      'animation' : 'animationend'
    },
    animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ],
    effectSel = document.getElementById( 'fxselect' ),
    component = document.getElementById( 'component' ),
    items = component.querySelector( 'ul.itemwrap' ).children,
    current = 0,
    itemsCount = items.length,
    nav = component.querySelector( 'nav' ),
    navNext = nav.querySelector( '.next' ),
    navPrev = nav.querySelector( '.prev' ),
    isAnimating = false;
  function init() {
    navNext.addEventListener( 'click', function( ev ) { ev.preventDefault(); navigate( 'next' ); } );
    navPrev.addEventListener( 'click', function( ev ) { ev.preventDefault(); navigate( 'prev' ); } );
  }
  function hideNav() {
    nav.style.display = 'none';
  }
  function showNav() {
    nav.style.display = 'block';
  }
  function changeEffect() {
    component.className = component.className.replace(/\bfx.*?\b/g, '');
    if( effectSel.selectedIndex ) {
      classie.addClass( component, effectSel.options[ effectSel.selectedIndex ].value );
      showNav();
    }
    else {
      hideNav();
    }
  }
  function navigate( dir ) {
    if( isAnimating ) return false;
    isAnimating = true;
    var cntAnims = 0;
    var currentItem = items[ current ];
    if( dir === 'next' ) {
      current = current < itemsCount - 1 ? current + 1 : 0;
    }
    else if( dir === 'prev' ) {
      current = current > 0 ? current - 1 : itemsCount - 1;
    }
    var nextItem = items[ current ];
    var onEndAnimationCurrentItem = function() {
      this.removeEventListener( animEndEventName, onEndAnimationCurrentItem );
      classie.removeClass( this, 'current' );
      classie.removeClass( this, dir === 'next' ? 'navOutNext' : 'navOutPrev' );
      ++cntAnims;
      if( cntAnims === 2 ) {
        isAnimating = false;
      }
    }
    var onEndAnimationNextItem = function() {
      this.removeEventListener( animEndEventName, onEndAnimationNextItem );
      classie.addClass( this, 'current' );
      classie.removeClass( this, dir === 'next' ? 'navInNext' : 'navInPrev' );
      ++cntAnims;
      if( cntAnims === 2 ) {
        isAnimating = false;
      }
    }
    if( support.animations ) {
      currentItem.addEventListener( animEndEventName, onEndAnimationCurrentItem );
      nextItem.addEventListener( animEndEventName, onEndAnimationNextItem );
    }
    else {
      onEndAnimationCurrentItem();
      onEndAnimationNextItem();
    }
    classie.addClass( currentItem, dir === 'next' ? 'navOutNext' : 'navOutPrev' );
    classie.addClass( nextItem, dir === 'next' ? 'navInNext' : 'navInPrev' );
  }
  init();
})();

