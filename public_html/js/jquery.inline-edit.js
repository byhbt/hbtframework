(function( $, undefined ){
	$.fn.inlineEdit = function( options ) {
		return this.each(function(){
			//setting
			var self = this, $main = $( self ), original,
				settings = $.extend({
					load: undefined,
					display: '.display',
					form: '.form',
					text: '.text',
					save: '.save',
					cancel: '.cancel',
					revert: '.revert',
					loadtxt: 'Loading...',
					hover: undefined,
					postFormat: undefined
				}, options || {}, $.metadata ? $main.metadata() : {} ),

				//Get all control
				$display = $main.find( settings.display ),
				$form 	 = $main.find( settings.form ),
				$text 	 = $form.find( settings.text ),
				$revert  = $form.find( settings.revert ),
				$cancel  = $form.find( settings.cancel );

			if ( $.data( self, 'inline-edit' ) === true ) {
				return;
			}

			$.data( self, 'inline-edit', true );



			// Display Actions
			$display.bind( 'click.inline-edit', function(){
				$display.hide(200);
				$form.show(200);

				if ( settings.html ) {
					if ( original === undefined ) {
						original = $display.html();
					}

					$text.val( original ).focus();
				}
				else if ( original === undefined ) {
					original = $text.val();
				}

				return false;
			})
			.bind( 'mouseenter.inline-edit', function(){
				$display.addClass( settings.hover );
			})

			.bind( 'mouseleave.inline-edit', function(){
				$display.removeClass( settings.hover );
			});

			// Add revert handler
			$revert.bind( 'click.inline-edit', function(){
				$text.val( original || '' ).focus();
				return false;
			});

			// Cancel Actions
			$cancel.bind( 'click.inline-edit', function(){
				$form.hide(200);
				$display.show(200);

				// Remove hover action if stalled
				if ( $display.hasClass( settings.hover ) ) {
					$display.removeClass( settings.hover );
				}

				return false;
			});
		});
	};
})( jQuery );
