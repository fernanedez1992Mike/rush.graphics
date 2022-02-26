(function($) {

  // actually, this is customize-widgets.js just like wp-admin/js/customize-widgets.js

  var vueWidgets = {};

  var api = wp.customize;

  api.ThemeOptionsControl = api.Control.extend({
    ready: function() {
      var control = this;
      var elem = this.container.find('#blahlab_theme_options');
      var themeOptions = {}, themeDefaults = {};

      try {
        themeOptions = JSON.parse(control.setting.get()) || {};
      } catch(e) { }

      try {
        themeDefaults = JSON.parse(elem.find('textarea.defaults').val()) || {};
      } catch(e) { }

      themeDefaultsCloned = JSON.parse(JSON.stringify(themeDefaults));
      var options = $.extend({}, themeDefaults, themeOptions);

      new Vue({
        el: elem[0],
        data: {
          defaults: themeDefaultsCloned,
          options: options,
          themeData: blahlabDataSource
        },
        methods: {
          clone: function(obj) {
            return $.extend(true, {}, obj);
          }
        },
        watch: {
          options: {
            handler: function(newValue) {
              control.setting.set(JSON.stringify(newValue));
            },
            deep: true
          }
        }
      });

      // setup "one click setup"
      $('button#one_click_setup').click(function() {
        var $one_click_setup_wrapper = $(this).closest('#one_click_setup_wrapper');
        var $once_click_setup_button = $(this);
        var notice = 'Click OK to import,backing up your database before doing this is highly recommended! And please be patient while importing, it may take up to a few minutes!';
        var confirmed = confirm(notice);
        // console.log(confirmed);
        if ( confirmed ) {
          $once_click_setup_button.prop('disabled', true).after('<img src="'+ blahlabThemeData.admin_url +'/images/spinner.gif" id="one_click_setup_spinner" />');
          $.ajax(ajaxurl, {
            data: {
              action: 'blahlab_one_click_setup'
            },
            complete: function() {
              $one_click_setup_wrapper.find('#one_click_setup_spinner').remove();
              $once_click_setup_button.text('One click setup done!');
              // make it a browser reload instead of live preview iframe reload to show the imported content
              // api.previewer.refresh();
              window.location.reload();
            }            
          });

        }

      });

    }
  });

  api.controlConstructor.theme_options = api.ThemeOptionsControl;

  api.Widgets.ExtendedWidgetControl = api.Widgets.WidgetControl.extend({
    _setupUpdateUI: function() {

      if ( this.isBlahlabWidgetControl() ) {
        // this._blahlabPreSetupUpdateUI();
        api.Widgets.WidgetControl.prototype._setupUpdateUI.apply(this);
      } else {
        api.Widgets.WidgetControl.prototype._setupUpdateUI.apply(this);
      }
      
    },
    embedWidgetContent: function() {
      if ( this.isBlahlabWidgetControl() ) {

        api.Widgets.WidgetControl.prototype.embedWidgetContent.apply(this);
        this._blahlabPostEmbedWidgetContent();
        
      } else {
        api.Widgets.WidgetControl.prototype.embedWidgetContent.apply(this);
      }
    },
    isBlahlabWidgetControl: function() {
      return this.id.match(/^widget_blahlab-widget-/) ? true : false;
    },
    _blahlabPreSetupUpdateUI: function() {
      // the .widget-content element is empty when _setupUpdateUI run

    },
    _blahlabPostEmbedWidgetContent: function() {
      var control = this;
      if ( this._blahlabPostEmbedWidgetContentExecuted ) {
        return;
      }

      // move the .vue-widget-content outside of the .widget-content

      var $widgetRoot, $widgetContent, widgetDefaults = {}, widgetOptions = {}, $widgetContentParent, $vueWidgetContent;

      $widgetRoot = this.container.find( '.widget:first' );
      $widgetContent = $widgetRoot.find( '.widget-content:first' );
      $widgetContentParent = $widgetContent.parent();
      $vueWidgetContent = $widgetRoot.find( '.vue-widget-content:first' );

      $widgetContentParent.prepend($vueWidgetContent);

      try {
        widgetDefaults = JSON.parse($widgetContentParent.find('textarea.defaults').val()) || {};
      } catch(e) { }
      
      try {
        widgetOptions = JSON.parse($widgetContentParent.find('textarea.options').val()) || {};
      } catch(e) { }

      // var options = $.extend(true, {}, widgetDefaults, widgetOptions);
      // backup widgetDefaults object, because if don't use "true" to extend object
      // the widgetDefaults can be changed 
      widgetDefaultsCloned = JSON.parse(JSON.stringify(widgetDefaults))
      var options = $.extend({}, widgetDefaults, widgetOptions);

      // $widgetContentParent.find('textarea.options').val(JSON.stringify(options));

      var vueWidget = new Vue({
        el: $vueWidgetContent[0],
        data: {
          defaults: widgetDefaultsCloned,
          options: options,
          themeData: blahlabDataSource,
          widgetId: control.params['widget_id']
        },
        mounted: function() {

          // set title the same as placeholder text
          $('textarea[placeholder], input[placeholder]', this.$el).each(function() {
            if ( !$(this).attr('title') ) {
              $(this).attr('title', $(this).attr('placeholder'));
            }
          });

        },
        filters: {
          capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
          },
          truncate: function(value, limit) {
            if (!value) return '';
            value = value.toString()
            if ( value.length > limit ) {
              return value.substring(0, limit) + ' ...';
            } else {
              return value;
            }
          }
        },
        methods: {
          onDragStart: function(event) {
            $(this.$el).addClass('is-dragging');
          },
          onDragEnd: function(event) {
            $(event.item).find('.blahlab-accordion-title').addClass('hover');

            var that = this;

            $(this.$el).one('mousemove', function() {
              $(event.item).find('.blahlab-accordion-title').removeClass('hover');
            });

            // prevent multiple item hightlighted
            setTimeout(function() {
              $(that.$el).removeClass('is-dragging');
            }, 100);                      
          },
          addClass: function(selector, className) {
            this.$nextTick(function() {
              $(this.$el).find(selector).addClass(className);
            });            
          },
          basename: function(url) {
            return url.split('/').pop();
          },
          clone: function(obj) {
            return $.extend(true, {}, obj);
          }
        },
        watch: {
          options: {
            handler: function(newValue) {
              $widgetContentParent.find('textarea.options').val(JSON.stringify(newValue)).trigger('change');
            },
            deep: true
          }
        }
      });

      this._blahlabPostEmbedWidgetContentExecuted = true;

    }

  });

  window.blahlabVueWidgets = vueWidgets;

  $.extend(api.controlConstructor, {
    'widget_form': api.Widgets.ExtendedWidgetControl
  });


})(jQuery);