( function() {
	const toggle = document.querySelector( '[data-menu-toggle]' );
	const nav = document.querySelector( '[data-nav]' );

	if ( ! toggle || ! nav ) {
		return;
	}

	function openMenu() {
		nav.classList.add( 'is-open' );
		toggle.classList.add( 'is-active' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
	}

	function closeMenu() {
		nav.classList.remove( 'is-open' );
		toggle.classList.remove( 'is-active' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';
	}

	toggle.addEventListener( 'click', function() {
		nav.classList.contains( 'is-open' ) ? closeMenu() : openMenu();
	} );

	document.addEventListener( 'click', function( e ) {
		if ( ! nav.contains( e.target ) && ! toggle.contains( e.target ) ) {
			closeMenu();
		}
	} );
}() );
