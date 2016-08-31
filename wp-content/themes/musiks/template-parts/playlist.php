<?php if( true ){ ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="playlists">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="inline m-r-xs m-t-xs">&times;</span></button>
        <h4 class="modal-title font-bold"><?php esc_html_e( 'Add to playlist', 'musik' ); ?></h4>
      </div>
      <div class="modal-body">
        <div class="padder">
          <div id="playlist-list" class="m-b">

          </div>

          <div id="playlist-new">
            <h4 class="m-b-md"><?php esc_html_e( 'Create new', 'musik' ); ?></h4>
            <div class="form-group">
              <label><?php esc_html_e( 'Playlist title', 'musik' ); ?></label>
              <input type="text" class="form-control input-sm text-md" id="playlist-new-title">
            </div>
            <button type="button" class="btn btn-sm btn-default m-b-md font-bold <?php echo get_theme_mod( 'btn-bg-color' ); ?>" id="playlist-new-save"><?php esc_html_e( 'Save', 'musik' ); ?></button>
          </div>

          <div id="playlist-error" class="hide">
            <h4><?php esc_html_e( 'Someting went wrong, try later', 'musik' ); ?></h4>
          </div>
        </div>
        <div class="hide" id="playlist-list-item">
          <div class="playlist-list-item padder-v b-b clearfix">
            <div class="pull-right m-t-xs">
              <button class="btn btn-sm btn-default" id="playlist-add"><?php esc_html_e( 'Add to playlist', 'musik' ); ?></button>
              <button class="btn btn-sm <?php echo get_theme_mod( 'btn-bg-color' ); ?>" id="playlist-del" style="display:none"><?php esc_html_e( 'Added', 'musik' ); ?></button>
              <button class="btn btn-sm btn-link" id="playlist-remove" title="<?php esc_html_e( 'Remove', 'musik' ); ?>"><i class="fa fa-remove"></i></button>
            </div>
            <a href class="pull-left m-r" id="playlist-thumb"><img width="40"></a>
            <div class="clear">
              <a href id="playlist-title" class="font-bold"></a>
              <div id="playlist-count" class="text-muted"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php } ?>
