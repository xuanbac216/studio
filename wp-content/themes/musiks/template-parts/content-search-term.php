<?php
/**
 * Partial: Content Download
*/
$photoid = get_term_meta($term->term_id, 'photo', true);
$photo   = wp_get_attachment_thumb_url($photoid);
?>
<a href="<?php echo get_term_link( $term ); ?>" class="list-group-item text-ellipsis">
  <?php if ($photo){ ?>
      <span class="thumb-xs m-r-xs">
          <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="img-full rounded"/>
      </span>
  <?php } ?>
  <span><?php echo esc_html( $term->name ); ?></span>
</a>
