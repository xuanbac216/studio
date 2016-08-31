<?php
add_action('widgets_init', create_function('', 'return register_widget("music_post_widget");'));

class music_post_widget extends WP_Widget{
  /** Constructor */
  function __construct() {
    parent::__construct( 'music_post_widget', __( 'Music', 'musik' ), array( 'description' => __( 'Display the musics or albums', 'musik' ) ) );
  }

  /** @see WP_Widget::widget */
  function widget( $args, $instance ) {
    // Set defaults
    $args['id'] = ( isset( $args['id'] ) ) ? $args['id'] : 'music_post_widget';
    $title      = apply_filters('widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
    $subtitle   = isset( $instance['subtitle'] ) ? $instance['subtitle'] : '';
    $type       = isset( $instance['type'] ) ? $instance['type'] : '';
    $orderby    = isset( $instance['orderby'] ) ? $instance['orderby'] : 'date';
    $order      = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
    $count      = isset( $instance['count'] ) ? $instance['count'] : 6;
    $display    = isset( $instance['display'] ) ? $instance['display'] : 'grid';
    $column     = isset( $instance['column'] ) ? $instance['column'] : 6;
    $pagination = isset( $instance['pagination'] ) ? $instance['pagination'] : '';
    $category   = isset( $instance['category'] ) ? $instance['category'] : '';
    $widget     = isset( $instance['widget'] ) ? $instance['widget'] : false;
    $include    = isset( $instance['include'] ) ? $instance['include'] : false;
    $exclude    = isset( $instance['exclude'] ) ? $instance['exclude'] : false;
    $related    = isset( $instance['related'] ) ? $instance['related'] : false;
    $filter     = isset( $instance['filter'] ) ? $instance['filter'] : false;
    $filterid   = isset( $instance['filterid'] ) ? $instance['filterid'] : false;
    $author     = isset( $instance['author'] ) ? $instance['author'] : false;
    

    if(!$widget){
      echo $args['before_widget'];
    }

    $wrap = '<div class="list-group list-group-lg">';
    $wrap_el = '<div class="list-group-item">';
    $tpl = 'download-list';

    if($display == 'grid'){
        $wrap = '<div class="row row-sm">';
        $class = 'col-xs-6';
        switch($column){
          case 2:
            $class = $class;
            break;
          case 3:
            $class .= ' col-sm-4';
            break;
          case 4:
            $class .= ' col-sm-4 col-md-3';
            break;
          case 6:
            $class .= ' col-sm-4 col-md-3 col-lg-2';
            break;
        }
        $wrap_el = '<div class="'. esc_attr( $class ) .'">';
        $tpl = 'download';
    }

    $arg = array(
      'post_type'       => 'download',
      'posts_per_page'  =>  $count
    );
    
    $arg['paged'] = 1;
    if($pagination == 'on'){
      if ( get_query_var( 'paged' ) )
        $arg['paged'] = get_query_var('paged');
      else if ( get_query_var( 'page' ) )
        $arg['paged'] = get_query_var( 'page' );
      else if ( isset( $_GET['link'] ) )
        $arg['paged'] = $_GET['link'];
      else if ( preg_match('/\/page\/[0-9]*\//', $_SERVER['REQUEST_URI'], $matches) ){
        $arg['paged'] = str_replace(array('page','/'), '', $matches[0]);
      }
    }

    if($orderby){
      $arg['orderby']   = $orderby;
      $arg['order']  = $order;
    }
    
    if($type == 'bundle'){
      $arg['meta_query'] = array(
        array(
          'key'   => '_edd_product_type',
          'value' => 'bundle'
        )
      );
    }

    if($type == 'single'){
      $arg['meta_query'] = array(
        array(
          'key'   => 'music_type',
          'value' => 'single'
        )
      );
    }

    if($orderby == 'sales'){
      $arg['orderby']   = 'meta_value';
      $arg['meta_key']   = '_edd_download_sales';
    }

    if($orderby == 'plays'){
      $arg['orderby']   = 'meta_value';
      $arg['meta_key']   = 'plays';
    }

    // get the related
    if( is_single() && $related ){
      $arg['post__not_in'] = array( get_queried_object()->ID );
      // get post in same category
      $terms = wp_get_object_terms( get_queried_object()->ID, 'download_category', array('fields' => 'ids'));
      if (!is_wp_error( $terms ) && '' != $terms ) {
        $arg['tax_query'] = array(
          array(
            'taxonomy' => 'download_category',
            'field'    => 'term_id',
            'terms'    => $terms
          )
        );
      }
    }

    // filter post
    if( $filter ){
      $arg['tax_query'] = array(
        array(
          'taxonomy' => $filter,
          'field'    => 'term_id',
          'terms'    => explode(',', $filterid)
        )
      );
    }

    // select post by include ids
    if( $include ){
      $arg['post__in'] = explode(',', $include);
      $arg['orderby'] = 'post__in';
    }

    if( $exclude ){
      $arg['post__not_in'] = explode(',', $exclude);
    }

    if( $author ){
      $arg['author'] = $author;
    }

    global $wp_query;
    if( !empty( $wp_query->query_vars['vendor'] ) ) {
      $vendor_nicename  = get_query_var('vendor');
      $vendor_id        = get_user_by( 'slug', $vendor_nicename );
      $arg[ 'author' ]  = $vendor_id->ID;
    }
    
    $my_query = new WP_Query( $arg );

    if($my_query->have_posts()){

      if($title != ''){
        echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
      }
      if($subtitle != ''){
        echo '<div class="sub-title">'. ( $subtitle ) .'</div>';
      }
      echo $wrap;
      while($my_query->have_posts()){
        $my_query->the_post();
        ?>
          <?php echo $wrap_el; ?>
              <?php get_template_part( 'template-parts/content', $tpl ); ?>
          <?php
          echo '</div>';
      }
      echo '</div>';

      wp_reset_postdata();

      if($pagination == 'on'){
        if( get_option('permalink_structure') ) {
          $format = '?paged=%#%';
        } else {
          $format = 'page/%#%/';
        } 
        $big = 999999999; // need an unlikely integer
        $base = $format =='?paged=%#%' ? $base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ) : $base = @add_query_arg('paged','%#%');
        echo '<div class="nav-links m-t-md m-b-md clearfix">'.paginate_links( array(
          'base' => $base,
          'format' => $format,
          'current' => max( 1, $arg['paged'] ),
          'total' => $my_query->max_num_pages,
          'prev_text' => '<i class="fa fa-chevron-left"></i>',
          'next_text' => '<i class="fa fa-chevron-right"></i>'
        ) ).'</div>';
      }

    }

    if(!$widget){
      echo $args['after_widget'];
    }
  }

  /** @see WP_Widget::update */
  function update($new_instance, $old_instance){
    $instance = $old_instance;
    $instance['title']    = strip_tags($new_instance['title']);
    $instance['subtitle'] = ($new_instance['subtitle']);
    $instance['type']     = strip_tags($new_instance['type']);
    $instance['orderby']  = strip_tags($new_instance['orderby']);
    $instance['order']    = strip_tags($new_instance['order']);
    $instance['count']    = strip_tags($new_instance['count']);
    $instance['display']  = strip_tags($new_instance['display']);
    $instance['column']   = strip_tags($new_instance['column']);
    $instance['pagination']    = strip_tags($new_instance['pagination']);
    $instance['include']   = strip_tags($new_instance['include']);
    $instance['exclude']   = strip_tags($new_instance['exclude']);
    $instance['filter']   = strip_tags($new_instance['filter']);
    $instance['filterid']   = strip_tags($new_instance['filterid']);
    return $instance;
  }

  /** @see WP_Widget::form */
  function form( $instance ) {
    // Set up some default widget settings.
    $defaults = array(
      'title'    => '',
      'subtitle' => '',
      'type'     => 'all',
      'orderby'  => 'rand',
      'order'    => 'DESC',
      'count'    => 6,
      'display'  => 'Grid',
      'column'   => 4,
      'pagination'   => '',
      'include'  => '',
      'exclude'  => '',
      'filter'   => '',
      'filterid' => ''
    );

    $instance = wp_parse_args((array) $instance, $defaults);
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'musik'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Sub Title:', 'musik'); ?></label>
      <textarea class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" ><?php echo $instance['subtitle']; ?></textarea>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>">
        <option value="all" <?php selected( 'all', $instance['type'] ); ?>><?php _e('All', 'musik'); ?></option>
        <option value="single" <?php selected( 'single', $instance['type'] ); ?>><?php _e('Single', 'musik'); ?></option>
        <option value="bundle" <?php selected( 'bundle', $instance['type'] ); ?>><?php _e('Bundle', 'musik'); ?></option>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
        <option value=""></option>
        <option value="rand" <?php selected( 'rand', $instance['orderby'] ); ?>><?php _e('Random', 'musik'); ?></option>
        <option value="id" <?php selected( 'id', $instance['orderby'] ); ?>><?php _e('ID', 'musik'); ?></option>
        <option value="name" <?php selected( 'name', $instance['orderby'] ); ?>><?php _e('Name', 'musik'); ?></option>
        <option value="date" <?php selected( 'date', $instance['orderby'] ); ?>><?php _e('Date', 'musik'); ?></option>
        <option value="meta_value_num" <?php selected( 'meta_value_num', $instance['orderby'] ); ?>><?php _e('View', 'musik'); ?></option>
        <option value="sales" <?php selected( 'sales', $instance['orderby'] ); ?>><?php _e('Sales', 'musik'); ?></option>
        <option value="plays" <?php selected( 'plays', $instance['orderby'] ); ?>><?php _e('Plays', 'musik'); ?></option>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
        <option value="ASC" <?php selected( 'ASC', $instance['order'] ); ?>><?php _e('ASC', 'musik'); ?></option>
        <option value="DESC" <?php selected( 'DESC', $instance['order'] ); ?>><?php _e('DESC', 'musik'); ?></option>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>">
        <option value="list" <?php selected( 'list', $instance['display'] ); ?>><?php _e('List', 'musik'); ?></option>
        <option value="grid" <?php selected( 'grid', $instance['display'] ); ?>><?php _e('Grid', 'musik'); ?></option>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('column'); ?>"><?php _e('Grid Column:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'column' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>">
        <option value="2" <?php selected( '2', $instance['column'] ); ?>>2</option>
        <option value="3" <?php selected( '3', $instance['column'] ); ?>>3</option>
        <option value="4" <?php selected( '4', $instance['column'] ); ?>>4</option>
        <option value="6" <?php selected( '6', $instance['column'] ); ?>>6</option>
      </select>
    </p>

    <p>
      <label><?php _e('Filter by:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'filter' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>">
        <?php
        $category_labels = function_exists('edd_get_taxonomy_labels') ? edd_get_taxonomy_labels( 'download_category' ) : 'Category';
        $tag_labels      = function_exists('edd_get_taxonomy_labels') ? edd_get_taxonomy_labels( 'download_tag' ) : 'Tag';
        ?>
        <option value=""></option>
        <option value="download_category" <?php selected( 'download_category', $instance['filter'] ); ?>><?php echo $category_labels['name']; ?></option>
        <option value="download_tag" <?php selected( 'download_tag', $instance['filter'] ); ?>><?php echo $tag_labels['name']; ?></option>
        <option value="download_artist" <?php selected( 'download_artist', $instance['filter'] ); ?>><?php echo __('Artist', 'musik'); ?></option>
      </select>
    </p>

    <p>
      <label><?php _e('Filter ids:', 'musik'); ?></label>
      <input type="text" id="<?php echo $this->get_field_id( 'filterid' ); ?>" name="<?php echo $this->get_field_name( 'filterid' ); ?>" value="<?php echo $instance['filterid']; ?>" />
      <small><em>Separate taxonomy ids with commas</em></small>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('include'); ?>"><?php _e('Include:', 'musik'); ?></label>
      <input type="text" id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>" value="<?php echo $instance['include']; ?>" />
      <small><em>Separate music ids with commas</em></small>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e('Exclude:', 'musik'); ?></label>
      <input type="text" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" value="<?php echo $instance['exclude']; ?>" />
      <small><em>Separate music ids with commas</em></small>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', 'musik'); ?></label>
      <input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'pagination' ); ?>"><?php _e( 'Show Pagination:', 'musik' ); ?></label>
      <input <?php checked( $instance['pagination'], 'on' ); ?> id="<?php echo $this->get_field_id( 'pagination' ); ?>" name="<?php echo $this->get_field_name( 'pagination' ); ?>" type="checkbox" />
    </p>

    <?php
  }
}
?>
