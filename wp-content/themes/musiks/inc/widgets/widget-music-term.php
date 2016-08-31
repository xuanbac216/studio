<?php
add_action('widgets_init', create_function('', 'return register_widget("music_term_widget");'));

class music_term_widget extends WP_Widget{
  /** Constructor */
  function __construct() {
    parent::__construct( 'music_term_widget', __( 'Music terms', 'musik' ), array( 'description' => __( 'Display the music genres, artists or tags', 'musik' ) ) );
  }

  /** @see WP_Widget::widget */
  function widget( $args, $instance ) {
    // Set defaults
    $args['id'] = ( isset( $args['id'] ) ) ? $args['id'] : 'music_term_widget';
    $title      = apply_filters('widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
    $subtitle   = isset( $instance['subtitle'] ) ? $instance['subtitle'] : '';
    $taxonomy   = isset( $instance['taxonomy'] ) ? $instance['taxonomy'] : 'download_category';
    $orderby    = isset( $instance['orderby'] ) ? $instance['orderby'] : 'rand';
    $order      = isset( $instance['order'] ) ? $instance['order'] : 'ASC';
    $count      = isset( $instance['count'] ) ? $instance['count'] : 0;
    $display    = isset( $instance['display'] ) ? $instance['display'] : 'grid';
    $column     = isset( $instance['column'] ) ? $instance['column'] : 6;
    $show_count = isset( $instance['show_count'] ) && $instance['show_count'] == 'on' ? 1 : 0;
    $hide_empty = isset( $instance['hide_empty'] ) && $instance['hide_empty'] == 'on' ? 1 : 0;
    $widget     = isset( $instance['widget'] ) ? $instance['widget'] : false;
    $pagination = isset( $instance['pagination'] ) ? $instance['pagination'] : '';
    $include    = isset( $instance['include'] ) ? $instance['include'] : false;
    $class      = isset( $instance['class'] ) ? $instance['class'] : '';

    if(!$widget){
      echo $args['before_widget'];
    }

    if($title != ''){
      echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
    }
    if($subtitle != ''){
      echo '<h5 class="sub-title">'. esc_html( $subtitle ) .'</h5>';
    }

    $taxonomies = array( 
        'download_category'
    );


    $paged = 1;
    if($pagination == 'on'){
      if ( get_query_var('paged') ) {
          $paged = get_query_var('paged');
      } elseif ( get_query_var('page') ) {
          $paged = get_query_var('page');
      }
    }
    $offset = $count * ( $paged - 1) ;
    $arg = array(
        'orderby'         =>  $orderby,
        'order'           =>  $order,
        'number'          =>  $count,
        'offset'          =>  $offset,
        'hide_empty'      =>  $hide_empty,
        'show_count'      =>  $show_count
    );

    // select taxomomy by include ids
    if( $include ){
      $arg['include'] = explode(',', $include);
    }

    if($taxonomy == 'download_category' || $taxonomy == 'download_tag'){
      $parent = 0;
      if( is_archive() ){
        $cat = get_term_by('slug', get_query_var('download_category'), 'download_category');
        if($cat){
          $parent = $cat->parent;
        }
      }
      if($display == 'grid'){
        echo $this->taxonomy_walker($taxonomy, $arg, $parent, 'list-inline');
      }else{
        echo $this->taxonomy_walker($taxonomy, $arg, $parent);
      }
    }

    if($taxonomy == 'download_artist'){
      $wrap = '<div class="list-group list-group-lg '. esc_attr( $class ) .'">';
      $wrap_el = '<div class="list-group-item clearfix">';

      if($display == 'grid'){
          $wrap = '<div class="row">';
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
      }
      $terms = get_terms($taxonomy, $arg);
      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        echo $wrap;
          foreach ( $terms as $term ){
              $photoid = get_term_meta($term->term_id, 'photo', true);
              $photo   = wp_get_attachment_thumb_url($photoid);
              $rounded = $display=='list' ? 'rounded' : 'r';
              echo $wrap_el;
      ?>
                  <div class="pos-rlt <?php if( $display=='list'){ echo 'pull-left m-r'; } ?>">
                      <a href="<?php echo get_term_link( $term ); ?>" class="<?php if( $display=='list'){ echo 'thumb-sm'; } ?>">
                          <?php if ($photo): ?>
                              <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="img-full <?php echo $rounded; ?>"/>
                          <?php else: ?>
                              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default_300_300.jpg" alt="<?php echo esc_attr( $term->name ); ?>" class="img-full <?php echo $rounded; ?>"/>
                          <?php endif ?>
                      </a>
                  </div>
                  <div class="<?php if( $display=='grid'){ echo 'padder-v text-center'; } ?>">
                      <a href="<?php echo get_term_link( $term ); ?>" class="m-t-sm m-b-sm text-ellipsis"><?php echo esc_html( $term->name ); ?></a>
                  </div>
              </div>
      <?php }
        echo '</div>';
        if($pagination == 'on'){
          unset($arg['offset']);
          $number_of_series = wp_count_terms( $taxonomy, $arg );
          $total = ( $count == 0 ? 1 : ceil( $number_of_series / $count ) );
          if( get_option('permalink_structure') ) {
            $format = '?paged=%#%';
          } else {
            $format = 'page/%#%/';
          } 
          $big = 999999999; // need an unlikely integer
          $base = $format =='?paged=%#%' ? $base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ) : $base = @add_query_arg('paged','%#%');
          if($total > 1){
            echo '<div class="nav-links m-t-md m-b-md clearfix">'.paginate_links( array(
                'base' => $base,
                'format' => $format,
                'current' => $paged,
                'total'   => $total,
                'prev_text' => '<i class="fa fa-chevron-left"></i>',
                'next_text' => '<i class="fa fa-chevron-right"></i>'
            ) ).'</div>';
          }
        }
    }
    }

    if(!$widget){
      echo $args['after_widget'];
    }
  }

  function taxonomy_walker($taxonomy, $arg, $parent = 0, $display = "nav"){
      $arg['parent'] = $parent;
      $terms = get_terms($taxonomy, $arg);
      if( !is_wp_error( $terms ) && count($terms) > 0 ){
          $out = '<ul class="m-t-n-xxs '. esc_attr( $display ) .'">';
          foreach ($terms as $term)
          {
              $active = '';
              if($arg['hide_empty'] && $term->count==0){
                continue;
              }
              if (is_tax() && $term->name == single_term_title('',false) ) {
                $active = 'active bg-light lter';
              }
              $out .='<li><a class="'. esc_attr( $active ) .'" href="'.get_term_link( intval($term->term_id),  $taxonomy ).'">'.(( ($term->count > 0) && $arg['show_count'] ) ? '  <span class="badge bg-light pull-right">'.$term->count.'</span>' : '')  . esc_html( $term->name ) . '</a>'. $this->taxonomy_walker($taxonomy, $arg, $term->term_id) . '</li>'; 
          }
          $out .= "</ul>";
          return $out;
      }
      return;
  }

  /** @see WP_Widget::update */
  function update($new_instance, $old_instance){
    $instance = $old_instance;
    $instance['title']    = strip_tags($new_instance['title']);
    $instance['subtitle'] = strip_tags($new_instance['subtitle']);
    $instance['taxonomy'] = strip_tags($new_instance['taxonomy']);
    $instance['orderby']  = strip_tags($new_instance['orderby']);
    $instance['order']    = strip_tags($new_instance['order']);
    $instance['count']    = strip_tags($new_instance['count']);
    $instance['display']  = strip_tags($new_instance['display']);
    $instance['column']   = strip_tags($new_instance['column']);
    $instance['show_count']  = strip_tags($new_instance['show_count']);
    $instance['hide_empty']  = strip_tags($new_instance['hide_empty']);
    $instance['pagination']    = strip_tags($new_instance['pagination']);
    $instance['include']  = strip_tags($new_instance['include']);
    return $instance;
  }

  /** @see WP_Widget::form */
  function form( $instance ) {
    // Set up some default widget settings.
    $defaults = array(
      'title'    => '',
      'subtitle' => '',
      'taxonomy' => 'download_category',
      'orderby'  => 'rand',
      'order'    => 'ASC',
      'count'      => 6,
      'display'    => 'Grid',
      'column'     => 4,
      'show_count' => '',
      'pagination'   => '',
      'hide_empty' => '',
      'include'    => ''
    );

    $instance = wp_parse_args((array) $instance, $defaults);
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'musik'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Sub Title:', 'musik'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>">
        <?php
        $category_labels = function_exists('edd_get_taxonomy_labels') ? edd_get_taxonomy_labels( 'download_category' ) : 'Category';
        $tag_labels      = function_exists('edd_get_taxonomy_labels') ? edd_get_taxonomy_labels( 'download_tag' ) : 'Tag';
        ?>
        <option value="download_category" <?php selected( 'download_category', $instance['taxonomy'] ); ?>><?php echo $category_labels['name']; ?></option>
        <option value="download_tag" <?php selected( 'download_tag', $instance['taxonomy'] ); ?>><?php echo $tag_labels['name']; ?></option>
        <option value="download_artist" <?php selected( 'download_artist', $instance['taxonomy'] ); ?>><?php echo __('Artist', 'musik'); ?></option>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by:', 'musik'); ?></label>
      <select name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
        <option value="name" <?php selected( 'name', $instance['orderby'] ); ?>><?php _e('Name', 'musik'); ?></option>
        <option value="count" <?php selected( 'count', $instance['orderby'] ); ?>><?php _e('Count', 'musik'); ?></option>
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
      <label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e( 'Show Count:', 'musik' ); ?></label>
      <input <?php checked( $instance['show_count'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" type="checkbox" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('include'); ?>"><?php _e('Include:', 'musik'); ?></label>
      <input type="text" id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>" value="<?php echo $instance['include']; ?>" />
      <small><em>Separate term ids with commas</em></small>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'hide_empty' ); ?>"><?php _e( 'Hide Empty Categories:', 'musik' ); ?></label>
      <input <?php checked( $instance['hide_empty'], 'on' ); ?> id="<?php echo $this->get_field_id( 'hide_empty' ); ?>" name="<?php echo $this->get_field_name( 'hide_empty' ); ?>" type="checkbox" />
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
