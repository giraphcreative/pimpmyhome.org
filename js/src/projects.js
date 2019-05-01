

var set_project_photo_height = function(){
	
	// get project photo width
	var project_width = $('.project-photo:first').width();

	// set heights on the project photo div
	$('.project-photo').height( project_width );

	// loop through all the project photos and set interior image heights.
	$('.project').each(function(){
		
		// get photo img width
		var $photo = $(this).find('img');
		var photo_height = $photo.height();
		var photo_width = $photo.width();

		// if the photo height is less than the project width, we'll resize it to fill the space.
		if ( photo_height < photo_width ) {

			// set height of interior img to height of project if it's not already that way
			$photo.height( project_width );

			// get the photo width
			var photo_overflow = $photo.width() - project_width;

			// set the margin on the photo so it is 'centered'.
			$photo.css( 'margin-left', -( photo_overflow / 2 ) );

		} else {
			$photo.width( project_width );
		}
	});
};

$(function(){

	$( window ).resize( set_project_photo_height );

	$( 'button.vote-button' ).on( 'click', function(){

		var $button = $( this );
		var project_id = $( this ).attr( 'rel' );
		$.ajax({
			url: "vote.php?for="+project_id
		}).done(function( data ) {
			if ( data == 'failure:ip' ) {
				$button.parent('.vote-buttons').html( '<div class="error">You may only vote for each <br>project once every 24 hours.</div>' );
			} else if ( data == 'failure:vote' ) {
				$button.parent('.vote-buttons').html( '<div class="error">Internal error.</div>' );
			} else {
				$button.parent('.vote-buttons').html( '<div class="success">Vote cast!</div>' );
			}
		});

	});

	setTimeout(function(){
		set_project_photo_height();
	}, 2000)

	$('.project a').magnificPopup({type:'image'});

});

