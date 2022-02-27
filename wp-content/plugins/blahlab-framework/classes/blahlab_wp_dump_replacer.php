<?php 

  class Blahlab_WP_Dump_Replacer {

    function __construct($source, $destination) {
      $this->source = $source;
      $this->destination = $destination;
      $this->length_delta = strlen($this->destination) - strlen($this->source);
    }

    function execute($sql) {

      if ( $this->source && $this->destination ) {
        $sql = $this->serialized_replace($sql);
        $sql = $this->simple_replace($sql);
      }

      return $sql;      
    }

    function serialized_replace($sql) {    

      $sql = preg_replace_callback('/s:(\d+):"(.*?)";/', array($this, 'serialize_replace_callback'), $sql);

      return $sql;

    }

    function simple_replace($sql) {
      return str_replace($this->source, $this->destination, $sql);
    }

    function serialize_replace_callback($matches) {

      if ( strpos($matches[0], $this->source) ) {
        $full_source_field_length =  intval($matches[1]);
        $full_destination_field_length = $full_source_field_length;

        $count = substr_count($matches[2], $this->source);
        $full_destination_field_length += $this->length_delta * $count;

        $content = str_replace($this->source, $this->destination, $matches[2]);

        $replacement = 's:' . $full_destination_field_length . ':"' . $content . '";';
      } else {
        $replacement = $matches[0];
      }

      return $replacement;

    }

  }


?>