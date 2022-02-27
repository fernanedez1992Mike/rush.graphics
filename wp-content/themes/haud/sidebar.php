<?php
/**
 * Generic theme sidebar
 *
 * @package Layers
 * @since Layers 1.0.0
 */

if (is_active_sidebar( 'blahlab_theme_slug_haud' . '-sidebar' )) {
  dynamic_sidebar( 'blahlab_theme_slug_haud' . '-sidebar' );
}