// For some reason this is overwritten somewhere in the wordpress headers
var $ = jQuery

var Okfn = Okfn || {};
//console.log('[Initialising Okfn App.js]');

Okfn.createCarousel = function(items, domElement) {
  // Captured instance of bubble
  var bubble = null;
  var autoScroll = null;

  function createBubble(htmlContent) {
    var bubble = $('<div/>').addClass('carousel-bubble');
    bubble.append($('<div/>').addClass('inner').html(htmlContent));
    domElement.append(bubble);
    var height = bubble.height() + 'px';
    bubble.height('0px');
    bubble.css({opacity:0});
    setTimeout(function() { bubble.animate({height:height,opacity:'0.9'},600); }, 200);
    return bubble;
  }

  function showBubble(something,somethingElse,nextId) {
    autoScroll = setTimeout(function() { $('.jcarousel-next').click(); }, 9000);
    // Can you tell I hacked the callbacks until I got what I wanted?
    var id = (((nextId-1) % items.length) + items.length) % items.length;
    var item = items[id];
    if (item.caption!=undefined && item.caption.length>0) {
      bubble = createBubble(item.caption);
    }
  }
  function hideBubble() {
    if (bubble) {
      bubble.hide();
      bubble = null;
    }
    if (autoScroll) {
      clearTimeout(autoScroll);
      autoScroll = null;
    }
  }
  $('.jcarousel-next').live('click', hideBubble);
  $('.jcarousel-prev').live('click', hideBubble);

  // Prefix all image locations with theme URL
  $.each(items, function(index, item) {
    if (item.image.substr(0,4) != 'http') {
      item.image = Okfn.theme_directory+'/'+item.image;
    }
  });

  var loadCarouselItem = function(carousel, state) {
    if (state == 'init') {
      for (var i=0; i<items.length; i++) {
        var html = '<img src="' + items[i].image + '"/>';
        carousel.add(i+1, html);
      }
      carousel.size(items.length);
    }
  };

  domElement.jcarousel({
    itemLoadCallback: loadCarouselItem,
    scroll: 1,
    wrap: 'circular',
    buttonNextHTML: '<div>next »</div>',
    buttonPrevHTML: '<div>« prev</div>',
    itemFirstInCallback: showBubble
  });
};


