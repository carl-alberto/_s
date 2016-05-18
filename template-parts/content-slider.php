<?php
  $args = array( 'post_type' => 'homeslider' );
  $loop = new WP_Query( $args );
  $c = 0;
  $class = '';
 ?>
<div class="container">
   <br>
   <div id="myCarousel" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner" role="listbox">
       <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
         <?php
           $c++;
           if ( $c == 1 ) {
             $class = ' active';
           } else {
             $class = '';
           };
          ?>
         <div class="item<?php echo $class ?>">
          <?php
            $feat_image_size = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ));
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            echo '<img src="' . $feat_image . '" alt="" width="" height="">' ;
            //echo '<div class="carousel-caption">';
            //echo '<h3></h3>';
            //echo '<p></p>';
            //echo '</div>';
          ?>
        </div>
      <?php endwhile; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
