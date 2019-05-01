<?php


// include database configuration details
require( "db-config.php" );


// database object
class db {
	protected $cn='';
	public $result='';
	public $show_errors=true;

	function db() {
		$this->cn=@mysql_connect( DB_HOST, DB_USER, DB_PASS);
		mysql_select_db( DB_NAME );
	}

	function query( $query ) {
		$select=mysql_query( $query,$this->cn );
		if ( is_resource( $select ) ) {
			while ( $rowselect=mysql_fetch_object( $select ) ) {
				$results[]=$rowselect;
			}
		}
		if ( !empty( $results ) ) {
			return $results;
		} else {
			$this->handle_error();
			return false;
		}
	}

	function query_one( $query ) {
		$select=mysql_query( $query,$this->cn );
		if ( is_resource( $select ) ) {
			while ( $rowselect=mysql_fetch_object( $select ) ) {
				$results[]=$rowselect;
			}
		}
		if ( !empty( $results ) ) {
			return $results[0];
		} else {
			$this->handle_error();
			return false;
		}
	}

	function update( $query ) {
		$update=mysql_query( $query, $this->cn );
		if ( $update ) {
			return true;
		} else {
			$this->handle_error();
			return false;
		}
	}

	function insert( $query ) {
		$update=mysql_query( $query, $this->cn );
		if ( $update ) {
			return mysql_insert_id();
		} else {
			$this->handle_error();
			return false;
		}
	}

	function handle_error() {
		$error=mysql_error();
		if ( !empty( $error ) && $this->show_errors ) {
			print $error;
			die;
		}
	}

}
$db=new db;



function get_submissions() {
	global $db;
	return $db->query( "select * from `submissions` where `submission_status`='approved' order by `submission_photo` desc;" );
}



function get_pending_submissions() {
	global $db;
	return $db->query( "select * from `submissions` where `submission_status`='pending' order by `submission_photo` desc;" );
}




function get_user_ip(){
    if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if ( !empty($_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



function ip_ok( $for = '' ) {
    global $db;

    $ip_last_vote = $db->query_one( "select * from `vote` where `vote_ip`='" . get_user_ip() . "' and `vote_date`>'" . ( time() - 86400 ) . "'" . ( !empty( $for ) ? " and `vote_for`='" . $for . "'" : '' ) . " order by `vote_id` desc;" );

    if ( !empty( $ip_last_vote ) ) {
        return false;
    } else {
        return true;
    }
}



function fix_images() {
	if ($handle = opendir('project-photos')) {
	    while ( false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != "..") {
	            $filename = 'project-photos/' . $entry;
				$exif = exif_read_data($filename );
		 		$ort = ( isset( $exif['Orientation'] ) ? $exif['Orientation'] : '' ); 
				$image = imagecreatefromjpeg( $filename );
				if ( !empty( $ort ) ) {
					switch ( $ort ) {
						case 3:
							$image = imagerotate( $image, 180, 0 );
						break;

						case 6:
							$image = imagerotate( $image, -90, 0 );
						break;

						case 8:
							$image = imagerotate( $image, 90, 0 );
						break;
					}
				}
				imagejpeg( $image, $filename, 90 );
	        }
	    }

	    closedir($handle);
	}
}


