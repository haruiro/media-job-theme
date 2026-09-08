( function() {
	const modal = document.getElementById( 'videoModal' );
	const iframe = document.getElementById( 'videoModalIframe' );
	if ( ! modal || ! iframe ) return;

	function openModal( youtubeId ) {
		iframe.src = 'https://www.youtube.com/embed/' + youtubeId + '?rel=0&autoplay=1';
		modal.classList.add( 'is-open' );
		modal.setAttribute( 'aria-hidden', 'false' );
		document.body.style.overflow = 'hidden';
	}

	function closeModal() {
		iframe.src = '';
		modal.classList.remove( 'is-open' );
		modal.setAttribute( 'aria-hidden', 'true' );
		document.body.style.overflow = '';
	}

	document.querySelectorAll( '.js-video-open' ).forEach( function( btn ) {
		btn.addEventListener( 'click', function() {
			openModal( this.dataset.youtubeId );
		} );
	} );

	document.querySelectorAll( '.js-video-close' ).forEach( function( el ) {
		el.addEventListener( 'click', closeModal );
	} );

	document.addEventListener( 'keydown', function( e ) {
		if ( e.key === 'Escape' ) closeModal();
	} );
}() );
