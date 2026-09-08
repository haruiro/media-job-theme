document.addEventListener( 'DOMContentLoaded', () => {
	// 企業名の自動入力
	const params = new URLSearchParams( window.location.search );
	const company = params.get( 'company' );
	if ( company ) {
		const field = document.getElementById( 'company-name' );
		if ( field ) field.value = decodeURIComponent( company );
	}

	// 送信中の表示（確認ページのみ）
	if ( document.querySelector( '.wpcf7-previous' ) ) {
		document.addEventListener( 'wpcf7beforesubmit', () => {
			const btn = document.querySelector( '.wpcf7-submit' );
			if ( btn ) {
				btn.value = '送信中...';
				btn.disabled = true;
			}
		});
	}

	// 送信後リダイレクト
	document.addEventListener('wpcf7mailsent', ( e ) => {
		if ( e.detail && e.detail.apiResponse && e.detail.apiResponse.redirect_to ) {
			window.location.href = e.detail.apiResponse.redirect_to;
		}
	} );
} );
