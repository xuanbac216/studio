<?php

switch($attrs->type):
	case 'basic': ?>
		<span class="ait-sc-rule rule-basic"></span>
	<?php break; case 'top': ?>
		<span class="ait-sc-rule rule-top"><span class="ait-sc-rule-btn-top"><?php _e('top', 'ait-shortcodes' ) ?></span></span>
	<?php break; case 'empty': ?>
		<span class="ait-sc-rule rule-empty"></span>
	<?php break; case 'clear': ?>
		<span class="ait-sc-rule rule-clear"></span>
	<?php break;
endswitch;