$( document ).ready( function () {
    // Sidebar Toggle
    window.onclick = function ( event ) {
        if ( !event.target.matches( '.sidebar-toggler' ) && !event.target.matches( '.sidebar *' ) ) {
            $( ".sidebar" ).removeClass( "show" )
        }
    }
    $( ".sidebar-toggler" ).click( function () {
        $( ".sidebar" ).toggleClass( "active" );
        $( ".sidebar" ).toggleClass( "show" );
        $( ".content" ).toggleClass( "active" );
    } );

    // Sidebar Menu Item Toggle
    $( ".menu-item-link" ).click( function () {
        var parent = $( this ).parent();
        $( ".sub-menu", parent ).toggle( "fast" );
        $( ".menu-item-toggler", parent ).toggleClass( 'active' );
    } )

    // Dropdown
    $( ".dropbtn" ).click( function () {
        var parent = $( this ).parent();
        $( ".dropdown-content", parent ).toggleClass( "active" );
    } )

    // Back Button
    $( ".back-btn" ).click( function () {
        window.history.go( -1 );
    } )
} );

