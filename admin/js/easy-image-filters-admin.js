(function( $ ) {
	'use strict';

	$(document).ready(function() {
		var eif_img  = $('#eif-image').data('img');
		var eif_red, eif_green, eif_blue, eif_brightness, eif_contrast, eif_vibrance, eif_saturation, eif_exposure, eif_hue, eif_sepia, eif_gamma, eif_noise, eif_clip, eif_sharpen, eif_stackBlur;

		eif_red = eif_green = eif_blue = eif_brightness = eif_contrast = eif_vibrance = eif_saturation = eif_exposure = eif_hue = eif_sepia = eif_gamma = eif_noise = eif_clip = eif_sharpen = eif_stackBlur = 0;
		eif_gamma = 1;

		Caman('#eif-image', eif_img, function() {
			this.render();
		});

		$('#eif-presets').on('click', '.eif-preset-button', function(event) {
			$('#eif-loader').show();
			var eif_preset = $(this).data('preset');

			Caman('#eif-image', eif_img, function() {
				this.revert(true);

				switch (eif_preset) {
					case 'brightness':
						this.brightness(30);
						break;

					case 'noise':
						this.noise(10);
						break;

					case 'contrast':
						this.contrast(10);
						break;

					case 'sepia':
						this.sepia(10);
						break;

					case 'colorize':
						this.colorize(60, 105, 218, 10);
						break;

					case 'tiltShift':
						this.tiltShift({
									angle: 90,
									focusWidth: 600
								});
						break;

					case 'posterize':
						this.posterize(8, 8);
						break;

					default:
						this[eif_preset]();
						break;
				}

				this.render(function(){
					$('#eif-loader').hide();
				});

		  });
		});


		$('#eif-filters').on('change', 'input', function(event) {
			var eif_changed_value = this.value;
			var eif_filter = $(this).data('filter');

			Caman('#eif-image', eif_img, function() {
				this.revert(false);

				switch (eif_filter) {
					case 'red':
						this.channels({ red: eif_changed_value });
						break;

					case 'green':
						this.channels({ green: eif_changed_value });
						break;

					case 'blue':
						this.channels({ blue: eif_changed_value });
						break;

					case 'gamma':
						eif_changed_value = parseFloat(eif_changed_value);
						this[eif_filter](eif_changed_value);
						break;

					default:
						eif_changed_value = parseInt(eif_changed_value);
						this[eif_filter](eif_changed_value);
				}

				this.render();
			});

		});

		$('#eif-save').on('click',function(){
			Caman("#eif-image",eif_img, function () {

			  var image = this.toBase64();
				$('#eif-loader').show();

			    //save To Server

					var data = {
						'action': 'eif_save_image',
						'old_image': eif_img,
						'new_image': image,
					};

					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					$.post(ajaxurl, data, function(response) {

						if("error" != response ){
							window.location = response;
						}
						else {

						}
					});
			});
		});

		$('#eif-reset').on('click',function(){
			Caman("#eif-image",eif_img, function () {
				this.revert(true);

				$('#eif-filters .mdl-slider').each(function(index) {
					this.MaterialSlider.change(0);
				});

			});
		});

	});

})( jQuery );
