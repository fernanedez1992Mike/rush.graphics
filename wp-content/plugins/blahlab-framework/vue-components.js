(function($) {

  Vue.component('BlahlabSortable', {
    template: '<ul class="blahlab-accordions-sortable blahlab-accordions"><slot></slot></ul>',
    props: ['items'],
    mounted: function() {
      var that = this;

      $(this.$el).sortable({
        activate: function(event, ui) {

        },
        start: function(event, ui) {
          ui.item.sortable = {
            index: ui.item.index()
          }
        },
        update: function(event, ui) {
          ui.item.sortable.dropindex = ui.item.index();

          var items = JSON.parse(JSON.stringify(that.items));
          // var items = that.items;
          // debugger
          var moved = items.splice(ui.item.sortable.index, 1)[0];
          items.splice(ui.item.sortable.dropindex, 0, moved);   

          // that.items = items;
          // debugger
          setTimeout(function() {
            that.$nextTick(function () {
              that.$emit('update:items', items);
            });
          }, 20000);
          
        },
        change: function(event, ui) {

        },
        stop: function(event, ui) {
          
        }
      });
    }
  });

  var template = '<a class="blahlab-accordion-title"><span><slot></slot></span>' +
                   '<span v-if="!no_delete" class="remove" style="cursor: pointer;color: red;float: right;" v-on:click="remove()">[X]</span>' +
                 '</a>';

  Vue.component('BlahlabAccordionTitle', {
    template: template,
    props: [
      'item',
      'no_delete'
    ],
    computed: {
      title: function() {
        var title = this.item.title || this.item.name ;

        if (title) {
          return this.titlePlaceHolder + ': ' + title;
        } else {
          return this.titlePlaceHolder;
        }            
      }
    },
    methods: {
      click: function(event) {
      },
      remove: function() {
        this.$emit('remove');
      }
    },
    watch: {
      "params.item": {
        handler: function() {
          // this.item.new = false;
        },
        deep: true
      }
    }
  });

  Vue.component('BlahlabAccordionContent', {
    template: '<section class="blahlab-accordion-section blahlab-content"><div class="blahlab-row"><slot></slot></div></section>',
  });

  Vue.component('BlahlabColorPicker', {
    template: '<input type="text" class="blahlab-color-selector" />',
    props: ['value'],
    mounted: function() {
      var self = this, title;

      if (this.$slots && this.$slots.default && this.$slots.default[0] && this.$slots.default[0].text) {
        title = this.$slots.default[0].text;
      }

      $(this.$el).val(this.value);

      // backup
      var pick = wpColorPickerL10n.pick;

      if( title ) {
        wpColorPickerL10n.pick = title;
      }

      $(this.$el).wpColorPicker({
        change: function(event, ui) {
          var color = ui.color.toString();
          self.$emit('input', color)
        },
        clear: function(event, ui) {
          var color = '';
          self.$emit('input', color);
        },
        width: 220
      });

      // restore afterwards
      wpColorPickerL10n.pick = pick;

    }
  });

  Vue.component('BlahlabButton', {
    template: '<a class="blahlab-button btn-full" v-on:click="click()"><slot></slot></a>',
    methods: {
      click: function() {
        this.$emit('click', 'abc');
      }
    }
  });

  Vue.component('BlahlabUploadImageToCollection', {
    template: '<input class="button" type="button" :value="text" @click="click" />',
    props: ['mediaType'],
    methods: {
      click: function() {
        var that = this;

        // inspire by OptionsFramework
        // and media-views.js > MediaFrame.Select > media.query( options.library )
        // media-editors.js > query = wp.media.query( args ) > args.type = 'image'
        // wp.media({ library: { type: 'video' } }).open()
        var frame = wp.media({ library: { type: this.mediaType }});
        frame.on('select', function() {
          var url = frame.state().get('selection').first().attributes.url;
          that.$emit('add', url);
        }).open();

      }
    },
    data: function() {
      var text = 'Upload Image';

      if (this.$slots && this.$slots.default && this.$slots.default[0] && this.$slots.default[0].text) {
        text = this.$slots.default[0].text;
      }

      return { text: text };
    }
  });

  var template = '<section class="blahlab-video-container">' +
                   '<textarea cols="50" v-bind:value="value" v-on:input="update($event)" v-bind:placeholder="placeholder"></textarea>' +
                   '<a href="#" class="blahlab-image-upload-button  blahlab-button btn-full" v-on:click.prevent="upload($event)"><slot></slot></a>' +
                 '</section>';

  Vue.component('BlahlabUploadVideo', {
    template: template,
    props: ['value', 'placeholder'],
    methods: {
      update: _.debounce(function(event) {
        this.$emit('input', event.target.value);
      }, 1500),
      upload: function(event) {
        var self = this;

        var $that = $(event.target);

        // If the media frame already exists, reopen it.
        if ( blahlab_file_frame ) {
          blahlab_file_frame.close();
        }

        // Create the media frame.
        blahlab_file_frame = wp.media.frames.file_frame = wp.media({
          title: "Select an Image",
          button: {
            text: "Use Video",
          },
          library: {
            type: 'video/mp4'
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        blahlab_file_frame.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          var attachment = blahlab_file_frame.state().get('selection').first().toJSON();

          self.$emit('input', attachment.url);

          return;
        });

        // Finally, open the modal
        blahlab_file_frame.open();

      }
    }

  });

  var template = '<section class="blahlab-image-container">' +
                   '<div class="blahlab-image-display">' +
                     '<img v-bind:src="value" v-if="value" />' +
                     '<a class="blahlab-image-remove" href="" v-on:click.prevent="remove($event)">Remove</a>' +
                   '</div>' +
                   '<a href="#" class="blahlab-image-upload-button  blahlab-button btn-full" v-on:click.prevent="upload($event)"><slot></slot></a>' +
                   '</section>';
  var blahlab_file_frame;

  Vue.component('BlahlabUploadImage', {
    template: template,
    props: ['value'],
    methods: {
      remove: function(event) {
        var $that = $(event.target);
        $container = $that.closest( '.blahlab-image-container' );
        $container.removeClass( 'blahlab-has-image' );
        this.$emit('input', null);
        $that.fadeOut();
        return false;
      },
      upload: function(event) {
        var self = this;

        var $that = $(event.target);
        $container = $that.closest( '.blahlab-image-container' );

        // If the media frame already exists, reopen it.
        if ( blahlab_file_frame ) {
          blahlab_file_frame.close();
        }

        // Create the media frame.
        blahlab_file_frame = wp.media.frames.file_frame = wp.media({
          title: "Select an Image",
          button: {
            text: "Use Image",
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        blahlab_file_frame.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          var attachment = blahlab_file_frame.state().get('selection').first().toJSON();

          // Fade in Remove button
          $container.find('.blahlab-image-remove').fadeIn();

          // Set attachment to the larege/medium size if they're defined
          if ( undefined !== attachment.sizes.medium )  {
            $attachment = attachment.sizes.medium;
          } else if( undefined !== attachment.sizes.large ) {
            $attachment = attachment.sizes.large;
          } else {
            $attachment = attachment;
          }

          // Add 'Has Image' Class
          $container.addClass( 'blahlab-has-image' );

          self.$emit('input', attachment.url);

          return;
        });

        // Finally, open the modal
        blahlab_file_frame.open();

      }
    }
  });


})(jQuery);
