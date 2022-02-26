(function($) {

  // initialize metabox vue

  $(document).ready(function() {
    $('.blahlab_wp_metabox').each(function() {

      var metaboxDefaults, metaboxOptions;

      try {
        metaboxDefaults = JSON.parse($(this).find('textarea.defaults').val()) || {};
      } catch(e) { console.log(e) }
      
      try {
        metaboxOptions = JSON.parse($(this).find('script.options').html()) || {};
      } catch(e) { console.log(e) }

      metaboxDefaultsCloned = JSON.parse(JSON.stringify(metaboxDefaults));
      var metaboxOptions = $.extend({}, metaboxDefaults, metaboxOptions);

      new Vue({
        el: this,
        data: {
          defaults: metaboxDefaultsCloned,
          options: metaboxOptions,
          themeData: blahlabDataSource
        },
        mounted: function() {
          $(this.$el).find('textarea.options').val(JSON.stringify(this.$data.options));          
        },
        methods: {
          addClass: function(selector, className) {
            this.$nextTick(function() {
              $(this.$el).find(selector).addClass(className);
            });            
          },
          clone: function(obj) {
            return $.extend(true, {}, obj);
          },
          focusLast: function(key) {

            // https://laracasts.com/discuss/channels/vue/vue-set-focus-to-input-created-by-v-for?
            this.$nextTick(function() {
              var index = this.$refs[key].length - 1;
              this.$refs[key][index].focus();
            });

          }
        },
        watch: {
          options: {
            handler: function(newValue) {          
              $(this.$el).find('textarea.options').val(JSON.stringify(newValue));
            },
            deep: true
          }
        }
      });

    });

  })
})(jQuery);


(function($) {

  // initialize accordions

  $(document).ready(function($) {

    $( document ).on( 'click' , '.blahlab-accordion-title' , function(e){
      e.preventDefault();

      $me = $(this).closest( 'li.blahlab-accordion-item' );
      $me.find( '.blahlab-accordion-section' ).first().slideToggle(function() {
        $me.toggleClass( 'open' );
      });


      $siblings = $me.siblings();
      $siblings.find( '.blahlab-accordion-section' ).slideUp(function() {
        $siblings.removeClass( 'open' );
      });

    });

  });

})(jQuery);


(function($) {

  // clean up Appearance > Widgets

  $(document).ready(function($) {

    
    var areas = $('.widget-liquid-right [id^=blahlab-]');

    for (var i = 0; i < areas.length; i++) {
      var area = areas[i];

      $(area).closest('.widgets-holder-wrap').hide();
    };

    var customWidgets = $('.widget-liquid-left .widget[id*=_blahlab-widget-]');

    for (var i = 0; i < customWidgets.length; i++) {
      var widget = customWidgets[i];

      $(widget).remove();
    };

  })

})(jQuery);


(function($) {

  // hook up events for page template
  
  $(document).ready(function($) {

    // the start link
    $(document).on( 'click' , '#blahlab_toggle_builder a', function(e){
      e.preventDefault();

      $that = jQuery(this);

      $that.closest('form').submit();

      if( 'auto-draft' !== $( '#original_post_status' ).val() ){
        window.location = $that.attr('href');
      }

    });

    $(document).on( 'change' , '#page_template', function(){
      // "Hi Mom"
      $that = jQuery(this);

      $non_blahlab_boxes = '#postdivrich';

      // If we use the builder, show the "build" button
      // BLAHLAB HACKS
      if( builder_templates.indexOf($that.val()) > -1 ){
        $( '#blahlab_toggle_builder' ).removeClass( 'blahlab-hide' );
        $( $non_blahlab_boxes ).hide();
      } else {
        $( '#blahlab_toggle_builder' ).addClass( 'blahlab-hide' );
        $( $non_blahlab_boxes ).show();
      }

      // BLAHLAB HACKS
      // this can avoid shake
      $(window).trigger('resize');

      // BLAHLAB HACKS
      // fix the WordPress editor toolbar
      $('#wpwrap').css('height', '110%');
      window.scrollBy(0, 1);
      window.scrollBy(0, -1);
      $('#wpwrap').css('height', 'auto');

      setTimeout(function() {
        $('#wpwrap').css('width', '110%');
        window.scrollBy(1, 0);
        window.scrollBy(-1, 0);
        $('#wpwrap').css('width', '100%');
      }, 200);

      blahlab_update_page_template();
    });

    function blahlab_update_page_template() {
      console.log('ajax');
      jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: 'action=update_page_builder_meta&template=' + $( '#page_template' ).val() + '&id=' + $('#post_ID').val()
      });
    }

  });

})(jQuery);


(function($) {

  // for gutenberg "Edit in Theme Customizer" button

  var BlahlabGuterbergApp = {

    init: function() {

      var self = this;

      this.editor = $('#editor');
      this.button = $($('#blahlab_gutenberg_edit_in_customizer_button_wrapper').html());

      this.editor.find('.edit-post-header-toolbar').append(this.button);

      this.button.on('click', function() {

        var wpEditorActions = wp.data.dispatch('core/editor');
        var wpEditor = wp.data.select('core/editor');

        var documentTitle = wpEditor.getEditedPostAttribute('title');

        var options = { template: 'blahlab-builder-default.php' };

        if (!documentTitle) {
          options.title = 'Page id #' + $('#post_ID').val();          
        }

        wpEditorActions.editPost(options);
        wpEditorActions.savePost();

        self.redirectAfterSave();

      });

    },

    redirectAfterSave: function() {

      var self = this;

      setTimeout(function () {
        if (wp.data.select('core/editor').isSavingPost()) {
          self.redirectWhenSave();
        } else {
          // theme customizer url
          // var link = wp.data.select('core/editor').getCurrentPost().link;
          // console.log(blahlabThemeData.theme_customizer_page_edit_url);
          location.href = blahlabThemeData.theme_customizer_page_edit_url;
        }
      }, 500);

    }

  }

  $(document).ready(function() {

    function watchForInit() {

      setTimeout(function() {

        if ($('#editor .edit-post-header-toolbar').length > 0) {
          BlahlabGuterbergApp.init();
        } else {
          watchForInit();
        }

      }, 100);

    }

    watchForInit();

  });

})(jQuery)



