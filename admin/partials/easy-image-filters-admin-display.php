<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://kiranpotphode.com/
 * @since      1.0.0
 *
 * @package    Easy_Image_Filters
 * @subpackage Easy_Image_Filters/admin/partials
 */
?>
<?php if( !isset( $_GET['attachment_id'] ) || $_GET['attachment_id']=='' ){ ?>
				<h1><?php _e("Please select image to apply filters.","easy-image-filters"); ?></h1>
			<?php }else{
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap" id="eif-wrap"><div id="icon-tools" class="icon32"></div>
	<h1><?php _e("Easy Image Filters", "easy-image-filters"); ?></h1>
	<div id="eif-image-wrapper">
		<canvas id="eif-image" data-img="<?php echo wp_get_attachment_url( $_GET['attachment_id'] );	?>">
		</canvas>
		<div id="eif-loader" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
		<div id="eif-controls">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" id="eif-save"><?php _e('Save','easy-image-filters'); ?></button>
			<div class="mdl-tooltip mdl-tooltip--large" for="eif-save">
			<?php _e("Save copy of image with applied effects.", "easy-image-filters" ); ?>
			</div>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="eif-reset"><?php _e("Reset","easy-image-filters"); ?></button>
			<div class="mdl-tooltip mdl-tooltip--large" for="eif-reset">
			<?php _e("Reset all effects and filters and load origional image.", "easy-image-filters" ); ?>
			</div>
		</div>
	</div>



	<div class="mdl-grid">
	  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
		  	<div class="title"><?php _e('Adjustments','easy-image-filters'); ?></div>
			<div id="eif-filters">

				<label><?php _e("Red","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="red" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-red" id="eif-red"/>

				<label><?php _e("Green","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="green" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-green" id="eif-green"/>

				<label><?php _e("Blue","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="blue" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-blue" id="eif-blue"/>

				<label><?php _e("Brightness","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="brightness" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-brightness" id="eif-brightness"/>

				<label><?php _e("Contrast","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="contrast" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-contrast" id="eif-contrast"/>

				<label><?php _e("Vibrance","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="vibrance" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-vibrance" id="eif-vibrance"/>

				<label><?php _e("Saturation","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="saturation" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-saturation" id="eif-saturation"/>

				<label><?php _e("Exposure","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="exposure" class="mdl-slider mdl-js-slider" min="-100" max="100" value="0" name="eif-exposure" id="eif-exposure"/>

				<label><?php _e("Hue","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="hue" class="mdl-slider mdl-js-slider" min="0" max="360" value="0" name="eif-hue" id="eif-hue"/>

				<label><?php _e("Sepia","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="sepia" class="mdl-slider mdl-js-slider" min="0" max="100" value="0" name="eif-sepia" id="eif-sepia"/>

				<label><?php _e("Gamma","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="gamma" class="mdl-slider mdl-js-slider" min="0" max="4" value="0" step='0.1' name="eif-gamma" id="eif-gamma"/>

				<label><?php _e("Noise","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="noise" class="mdl-slider mdl-js-slider" min="0" max="100" value="0" name="eif-noise" id="eif-noise"/>

				<label><?php _e("Clip","easy-image-filters"); ?>: </label>
				<input type="range" data-filter="clip" class="mdl-slider mdl-js-slider" class="mdl-slider mdl-js-slider" min="0" max="100" value="0" name="eif-clip" id="eif-clip"/>

			</div>

		</div>
	  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
			<div id="eif-presets">
				<div class="title"><?php _e('Presets','easy-image-filters'); ?></div>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="invert"><?php _e("Invert","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="greyscale"><?php _e("Grayscale","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="brightness"><?php _e("Brightness","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="noise"><?php _e("Noise","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="sepia"><?php _e("Sepia","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="contrast"><?php _e("Contrast","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="colorize"><?php _e("Colorize","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="vintage"><?php _e("Vintage","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="lomo"><?php _e("Lomo","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="emboss"><?php _e("Emboss","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="tiltShift"><?php _e("Tilt Shift","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="radialBlur"><?php _e("Radial Blur","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="edgeEnhance"><?php _e("Edge Enhance","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="posterize"><?php _e("Posterize","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="clarity"><?php _e("Clarity","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="orangePeel"><?php _e("Orange Peel","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="sinCity"><?php _e("Sin City","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="sunrise"><?php _e("Sunrise","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="crossProcess"><?php _e("Cross Process","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="hazyDays"><?php _e("Hazy Days","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="love"><?php _e("Love","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="grungy"><?php _e("Grungy","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="pinhole"><?php _e("Pinhole","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="oldBoot"><?php _e("Old Boot","easy-image-filters"); ?></button>
				<button class="eif-preset-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-preset="glowingSun"><?php _e("Glowing Sun","easy-image-filters"); ?></button>

			</div>

		</div>
	</div>
</div>
<?php }
