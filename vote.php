<?php


require( 'functions.php' );


if ( isset( $_GET['for'] ) ) {
    $for = $_GET['for'];
    if ( ip_ok( $for ) ) {
        global $db;

        if ( $db->insert( "insert into `vote` ( `vote_ip`, `vote_for`, `vote_date` ) values ( '" . get_user_ip() . "', " . $for . ", " . time() . " );" ) ) {
            print 'success';
        } else {
            print 'failure:db';
        }
    } else {
        print 'failure:ip';
    }
} else {
    print 'failure:vote';
}

