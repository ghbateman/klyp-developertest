<?php

  // Debugging - echo var_dump surrounded in <pre> tags for formatting
  function predump( $input ) {
    echo ('<pre>'); 
      echo (var_dump( $input )); 
    echo ('</pre>');
  }

  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function change_background_colour ( $movie_background ) {
    if ( strpos( strtolower( $movie_background ), 'red' ) !== false ) {
      echo ('<script>$("body").addClass("body_colour_red")</script>');
    } elseif ( strpos( strtolower( $movie_background ), 'green' ) !== false ) {
      echo ('<script>$("body").addClass("body_colour_green")</script>');
    } elseif ( strpos( strtolower( $movie_background ), 'blue') !== false ) {
      echo ('<script>$("body").addClass("body_colour_blue")</script>');
    } elseif ( strpos( strtolower( $movie_background ), 'yellow') !== false ) {
      echo ('<script>$("body").addClass("body_colour_yellow")</script>');
    } 
  }

?>