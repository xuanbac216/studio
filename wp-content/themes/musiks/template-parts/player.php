<?php if( get_theme_mod( 'hide-player' ) == 0 ){ ?>
<footer class="footer nav-bar-fixed-bottom <?php echo esc_attr( get_theme_mod( 'player-bg-color', 'bg-info' ) ); ?>">
  <div id="jp_container">
    <div class="jp-type-playlist">
      <div id="jplayer" class="jp-jplayer hide"></div>
      <div class="jp-gui">
        <div class="jp-video-play hide">
          <a class="jp-video-play-icon"><?php esc_html_e( 'play', 'musik' ); ?></a>
        </div>
        <div class="jp-interface">
          <div class="jp-controls">
            <div><a class="jp-previous"><i class="icon-control-rewind i-lg"></i></a></div>
            <div>
              <a class="jp-play"><i class="icon-control-play i-2x"></i></a>
              <a class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
            </div>
            <div><a class="jp-next"><i class="icon-control-forward i-lg"></i></a></div>
            <div class="hide"><a class="jp-stop"><i class="fa fa-stop"></i></a></div>
            <div><a class="" data-toggle="dropdown" data-target="#playlist"><i class="icon-list"></i></a></div>
            <div class="jp-progress hidden-xs">
              <div class="jp-seek-bar lt">
                <div class="jp-play-bar dk">
                </div>
              </div>
              <div class="jp-title text-lt">
              </div>
            </div>
            <div class="hidden-xs hidden-sm jp-current-time text-xs text-muted"></div>
            <div class="hidden-xs hidden-sm jp-duration text-xs text-muted"></div>
            <div class="hidden-xs hidden-sm">
              <a class="jp-mute" title="<?php esc_html_e( 'mute', 'musik' ); ?>"><i class="icon-volume-2"></i></a>
              <a class="jp-unmute hid" title="<?php esc_html_e( 'unmute', 'musik' ); ?>"><i class="icon-volume-off"></i></a>
            </div>
            <div class="hidden-xs hidden-sm jp-volume">
              <div class="jp-volume-bar dk">
                <div class="jp-volume-bar-value lter"></div>
              </div>
            </div>
            <div>
              <a class="jp-shuffle" title="<?php esc_html_e( 'shuffle', 'musik' ); ?>"><i class="icon-shuffle text-muted"></i></a>
              <a class="jp-shuffle-off hid" title="<?php esc_html_e( 'shuffle off', 'musik' ); ?>"><i class="icon-shuffle text-lt"></i></a>
            </div>
            <div>
              <a class="jp-repeat" title="<?php _e( 'repeat', 'musik' ); ?>"><i class="icon-loop text-muted"></i></a>
              <a class="jp-repeat-off hid" title="<?php _e( 'repeat off', 'musik' ); ?>"><i class="icon-loop text-lt"></i></a>
            </div>
            <div class="hide">
              <a class="jp-full-screen" title="<?php esc_html_e( 'full screen', 'musik' ); ?>"><i class="fa fa-expand"></i></a>
              <a class="jp-restore-screen" title="<?php esc_html_e( 'restore screen', 'musik' ); ?>"><i class="fa fa-compress text-lt"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="jp-playlist dropup" id="playlist">
        <ul class="dropdown-menu aside-xl dker">
          <!-- The method Playlist.displayPlaylist() uses this unordered list -->
          <li class="list-group-item"></li>
        </ul>
      </div>
      <div class="jp-no-solution hide">
        <span><?php esc_html_e( 'Update Required', 'musik' ); ?></span>
        <?php esc_html_e( 'To play the media you will need to either update your browser to a recent version or update your Flash plugin.', 'musik'); ?>
      </div>
    </div>
  </div>
</footer>
<?php } ?>
