<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );
  add_image_size( 'logo', 9999, 150, false );

  add_image_size( 'col3', 302, 9999, false );
  add_image_size( 'col3-portrait-crop', 302, 379, true );

  add_image_size( 'col6-square-nocrop', 620, 620, false );

  add_image_size( 'col10-square-nocrop', 1044, 1044, false );

  add_image_size( 'splash', 2880, 1800, false );
}
