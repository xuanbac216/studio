<a
	href="<?php echo esc_url($attrs->url) ?>"
	<?php if($attrs->urlnewwindow != "" and $attrs->urlnewwindow == "1" ){
		echo 'target="_blank"'; }
	?>
	id="<?php echo $this->htmlId ?>"
	class="<?php echo $this->htmlClass, " align{$attrs->align} ", " buticon-{$attrs->iconalign} " ?> <?php if($attrs->iconurl != "") echo 'buticon' ?> <?php if(($attrs->title == "") and ($attrs->description == "")) echo 'notext' ?> <?php if(($attrs->title != "") and ($attrs->description == "") and ($attrs->iconurl == "")) echo 'simple' ?>"
	style="<?php echo $style[0], $style[1], $style[5], $style[6], $style[7], $style[8] ?>"
>
	<span class="container">
		<span class="wrap">

			<?php if($attrs->iconurl != ""){ ?>
				<?php if($attrs->iconalign == "top" or $attrs->iconalign == "left") { ?>
				<span class="icon" style="<?php echo $style[4] ?>">
					<img src="<?php echo esc_url($attrs->iconurl) ?>" alt="button icon">
				</span>
				<?php } ?>
			<?php }elseif(!empty($attrs->fonticon)){ ?>
				<?php if($attrs->iconalign == "top" or $attrs->iconalign == "left") { ?>
					<span class="icon" style="<?php echo $style[4] ?>">
						<i class="fa <?php echo esc_attr($attrs->fonticon) ?>" <?php if(!empty($attrs->titlecolor)) { ?>style="color: <?php echo esc_attr($attrs->titlecolor) ?>;"<?php } ?>></i>
					</span>
				<?php } ?>
			<?php } ?>

			<?php if(($attrs->title != "") or ($attrs->description != "")) { ?>
			<span class="text" style="<?php echo $style[4] ?>">
				<?php if($attrs->title != ""){ ?>
				<span class="title" style="<?php echo $style[2] ?>">
					<?php
					if($attrs->escapetext != "" and $attrs->escapetext == "0"){
						echo html_entity_decode($attrs->title);
					} else {
						echo esc_html($attrs->title);
					}
					?>
				</span>
				<?php } ?>
				<?php if($attrs->description != ""){ ?>
				<span class="description" style="<?php echo $style[3] ?>">
					<?php
						if($attrs->escapetext != "" and $attrs->escapetext == "0"){
							echo html_entity_decode($attrs->description);
						} else {
							echo esc_html($attrs->description);
						}
						?>
				</span>
				<?php } ?>
			</span>
			<?php } ?>

			<?php if($attrs->iconurl != ""){ ?>
				<?php if($attrs->iconalign == "bottom" or $attrs->iconalign == "right") { ?>
				<span class="icon" style="<?php echo $style[4] ?>">
					<img src="<?php echo esc_url($attrs->iconurl) ?>" alt="button icon">
				</span>
				<?php } ?>
			<?php }elseif(!empty($attrs->fonticon)){ ?>
				<?php if($attrs->iconalign == "bottom" or $attrs->iconalign == "right") { ?>
					<span class="icon" style="<?php echo $style[4] ?>">
						<i class="fa <?php echo esc_attr($attrs->fonticon) ?>" <?php if(!empty($attrs->titlecolor)) { ?>style="color: <?php echo esc_attr($attrs->titlecolor) ?>;"<?php } ?>></i>
					</span>
				<?php } ?>
			<?php } ?>
		</span>
	</span>
</a>
