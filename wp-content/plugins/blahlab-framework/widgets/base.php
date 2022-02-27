<?php

class Blahlab_Widget extends WP_Widget {

  function __construct() {

    $reflection = new ReflectionObject($this);
    $this->root = dirname($reflection->getFileName());

    $this->view = blahlab_join_paths($this->root, 'view.php');
    $this->form = blahlab_join_paths($this->root, 'form.php');
    $this->slug = 'blahlab-widget-' . $this->widget_id;

    $this->widget_ops = array(
      'classname' => isset($this->classname) && !empty($this->classname) ? $this->classname : 'blahlab-' . $this->widget_id . '-widget',
      'description' => esc_html__( 'This widget is used to display your ', 'blahlab-framework' ) . $this->widget_title . '.',
      'customize_selective_refresh' => $this->customize_selective_refresh,
    );

    $this->control_ops = array( 'width' => isset($this->width) ? $this->width : 160, 'height' => NULL, 'id_base' => $this->slug );

    $this->fa_icons = array(
      "glass", "music", "search", "envelope-o", "heart", "star", "star-o", "user", "film", "th-large", "th", "th-list", "check", "times", "search-plus", "search-minus", "power-off", "signal", "cog", "trash-o", "home", "file-o", "clock-o", "road", "download", "arrow-circle-o-down", "arrow-circle-o-up", "inbox", "play-circle-o", "repeat", "refresh", "list-alt", "lock", "flag", "headphones", "volume-off", "volume-down", "volume-up", "qrcode", "barcode", "tag", "tags", "book", "bookmark", "print", "camera", "font", "bold", "italic", "text-height", "text-width", "align-left", "align-center", "align-right", "align-justify", "list", "outdent", "indent", "video-camera", "picture-o", "pencil", "map-marker", "adjust", "tint", "pencil-square-o", "share-square-o", "check-square-o", "arrows", "step-backward", "fast-backward", "backward", "play", "pause", "stop", "forward", "fast-forward", "step-forward", "eject", "chevron-left", "chevron-right", "plus-circle", "minus-circle", "times-circle", "check-circle", "question-circle", "info-circle", "crosshairs", "times-circle-o", "check-circle-o", "ban", "arrow-left", "arrow-right", "arrow-up", "arrow-down", "share", "expand", "compress", "plus", "minus", "asterisk", "exclamation-circle", "gift", "leaf", "fire", "eye", "eye-slash", "exclamation-triangle", "plane", "calendar", "random", "comment", "magnet", "chevron-up", "chevron-down", "retweet", "shopping-cart", "folder", "folder-open", "arrows-v", "arrows-h", "bar-chart", "twitter-square", "facebook-square", "camera-retro", "key", "cogs", "comments", "thumbs-o-up", "thumbs-o-down", "star-half", "heart-o", "sign-out", "linkedin-square", "thumb-tack", "external-link", "sign-in", "trophy", "github-square", "upload", "lemon-o", "phone", "square-o", "bookmark-o", "phone-square", "twitter", "facebook", "github", "unlock", "credit-card", "rss", "hdd-o", "bullhorn", "bell", "certificate", "hand-o-right", "hand-o-left", "hand-o-up", "hand-o-down", "arrow-circle-left", "arrow-circle-right", "arrow-circle-up", "arrow-circle-down", "globe", "wrench", "tasks", "filter", "briefcase", "arrows-alt", "users", "link", "cloud", "flask", "scissors", "files-o", "paperclip", "floppy-o", "square", "bars", "list-ul", "list-ol", "strikethrough", "underline", "table", "magic", "truck", "pinterest", "pinterest-square", "google-plus-square", "google-plus", "money", "caret-down", "caret-up", "caret-left", "caret-right", "columns", "sort", "sort-desc", "sort-asc", "envelope", "linkedin", "undo", "gavel", "tachometer", "comment-o", "comments-o", "bolt", "sitemap", "umbrella", "clipboard", "lightbulb-o", "exchange", "cloud-download", "cloud-upload", "user-md", "stethoscope", "suitcase", "bell-o", "coffee", "cutlery", "file-text-o", "building-o", "hospital-o", "ambulance", "medkit", "fighter-jet", "beer", "h-square", "plus-square", "angle-double-left", "angle-double-right", "angle-double-up", "angle-double-down", "angle-left", "angle-right", "angle-up", "angle-down", "desktop", "laptop", "tablet", "mobile", "circle-o", "quote-left", "quote-right", "spinner", "circle", "reply", "github-alt", "folder-o", "folder-open-o", "smile-o", "frown-o", "meh-o", "gamepad", "keyboard-o", "flag-o", "flag-checkered", "terminal", "code", "reply-all", "star-half-o", "location-arrow", "crop", "code-fork", "chain-broken", "question", "info", "exclamation", "superscript", "subscript", "eraser", "puzzle-piece", "microphone", "microphone-slash", "shield", "calendar-o", "fire-extinguisher", "rocket", "maxcdn", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-circle-down", "html5", "css3", "anchor", "unlock-alt", "bullseye", "ellipsis-h", "ellipsis-v", "rss-square", "play-circle", "ticket", "minus-square", "minus-square-o", "level-up", "level-down", "check-square", "pencil-square", "external-link-square", "share-square", "compass", "caret-square-o-down", "caret-square-o-up", "caret-square-o-right", "eur", "gbp", "usd", "inr", "jpy", "rub", "krw", "btc", "file", "file-text", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-numeric-asc", "sort-numeric-desc", "thumbs-up", "thumbs-down", "youtube-square", "youtube", "xing", "xing-square", "youtube-play", "dropbox", "stack-overflow", "instagram", "flickr", "adn", "bitbucket", "bitbucket-square", "tumblr", "tumblr-square", "long-arrow-down", "long-arrow-up", "long-arrow-left", "long-arrow-right", "apple", "windows", "android", "linux", "dribbble", "skype", "foursquare", "trello", "female", "male", "gittip", "sun-o", "moon-o", "archive", "bug", "vk", "weibo", "renren", "pagelines", "stack-exchange", "arrow-circle-o-right", "arrow-circle-o-left", "caret-square-o-left", "dot-circle-o", "wheelchair", "vimeo-square", "try", "plus-square-o", "space-shuttle", "slack", "envelope-square", "wordpress", "openid", "university", "graduation-cap", "yahoo", "google", "reddit", "reddit-square", "stumbleupon-circle", "stumbleupon", "delicious", "digg", "pied-piper", "pied-piper-alt", "drupal", "joomla", "language", "fax", "building", "child", "paw", "spoon", "cube", "cubes", "behance", "behance-square", "steam", "steam-square", "recycle", "car", "taxi", "tree", "spotify", "deviantart", "soundcloud", "database", "file-pdf-o", "file-word-o", "file-excel-o", "file-powerpoint-o", "file-image-o", "file-archive-o", "file-audio-o", "file-video-o", "file-code-o", "vine", "codepen", "jsfiddle", "life-ring", "circle-o-notch", "rebel", "empire", "git-square", "git", "hacker-news", "tencent-weibo", "qq", "weixin", "paper-plane", "paper-plane-o", "history", "circle-thin", "header", "paragraph", "sliders", "share-alt", "share-alt-square", "bomb", "futbol-o", "tty", "binoculars", "plug", "slideshare", "twitch", "yelp", "newspaper-o", "wifi", "calculator", "paypal", "google-wallet", "cc-visa", "cc-mastercard", "cc-discover", "cc-amex", "cc-paypal", "cc-stripe", "bell-slash", "bell-slash-o", "trash", "copyright", "at", "eyedropper", "paint-brush", "birthday-cake", "area-chart", "pie-chart", "line-chart", "lastfm", "lastfm-square", "toggle-off", "toggle-on", "bicycle", "bus", "ioxhost", "angellist", "cc", "ils", "meanpath"
    );

    parent::__construct($this->slug, $this->widget_title, $this->widget_ops, $this->control_ops);
  }


  function widget( $args, $instance ) {

    global $wp_customize;

    extract($args, EXTR_SKIP);

    // $instance Defaults
    $instance_defaults = $this->defaults;

    // If we have information in this widget, then ignore the defaults
    if( !empty( $instance ) ) $instance_defaults = array();

    $instance = wp_parse_args( $instance , $instance_defaults );

    if ( isset($instance['options']) && is_string($instance['options']) ) {
      $decoded = json_decode($instance['options'], true);
      if ( is_array($decoded) ) {
        $instance['options'] = $decoded;
      }
    }

    $this->instance = $instance;

    echo '<a id="' . $widget_id . '"></a>';
    echo blahlab_esc($before_widget);
    include($this->view);
    echo blahlab_esc($after_widget);

  }

  function blahlab_get_custom_field_name($name) {
    $options = explode('.', $name);

    $parts = array();
    foreach ($options as $option) {
      array_push($parts, $option);
    }

    return 'widget-' . $this->id_base . '[' . $this->number . ']' . '[' . implode('][', $parts) . ']';
  }

  function blahlab_get_custom_field_id($name) {
    $options = explode('.', $name);

    $parts = array();
    foreach ($options as $option) {
      array_push($parts, $option);
    }

    return 'widget-' . $this->id_base . '-' . $this->number . '-' . implode('-', $parts);
  }


  function update($new_instance, $old_instance) {
    if ( isset( $this->checkboxes ) ) {
      foreach( $this->checkboxes as $cb ) {
        if( isset( $old_instance[ $cb ] ) ) {
          $old_instance[ $cb ] = strip_tags( $new_instance[ $cb ] );
        }
      } // foreach checkboxes
    } // if checkboxes
    return $new_instance;
  }

  function form( $instance ){

    // $instance Defaults
    $instance_defaults = $this->defaults;

    // If we have information in this widget, then ignore the defaults
    if( !empty( $instance ) ) $instance_defaults = array();

    // Parse $instance
    $instance = wp_parse_args( $instance, $instance_defaults );

    $this->instance = $instance;

    extract( $instance, EXTR_SKIP );

    // $widget_id = $this->id;
    // include dirname(__FILE__) . '/widget.form.init.php';

    include($this->form);
    echo '<input type="hidden" value="trigger" name="trigger" class="trigger">';

  }

  function is_ajax_update_widget() {
    return isset($_POST['action']) && $_POST['action'] == 'update-widget' && $_SERVER['REQUEST_URI'] == admin_url( 'admin-ajax.php', 'relative' );
  }


}

?>