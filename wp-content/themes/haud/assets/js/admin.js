(function($) {

  'use strict';

  // clean up Appearance > Widgets

  $(document).ready(function($) {

    
    var areas = $('.widget-liquid-right [id^=blahlab-]');

    for (var i = 0; i < areas.length; i++) {
      var area = areas[i];

      $(area).closest('.widgets-holder-wrap').remove();
    };

    var customWidgets = $('.widget-liquid-left .widget[id*=_blahlab-widget-]');

    for (var i = 0; i < customWidgets.length; i++) {
      var widget = customWidgets[i];

      $(widget).remove();
    };

  });

})(jQuery);