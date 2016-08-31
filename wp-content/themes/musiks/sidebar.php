<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package musik
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
    return;
}

?>
<aside>
    
    <?php dynamic_sidebar( 'sidebar' ); ?>
    
</aside>
