<?php


if ( isset( $_REQUEST['approve'] ) ) {
	$approve = $_REQUEST['approve'];
	rename( '../project-info-temp/' . $approve . '.txt', '../project-info/' . $approve . '.txt' );
	rename( '../project-photos-temp/' . $approve . '.jpg', '../project-photos/' . $approve . '.jpg' );
}


$files = array();
foreach ( glob( '../project-info-temp/*.txt' ) as $file ) {
	$files[] = $file;
}
if ( !empty( $files ) ) {
	foreach ( $files as $file ) {
		$info = $file;
		$image_url = str_replace( 'project-info-temp/', 'project-photos-temp/', str_replace( '.txt', '.jpg', $file ) );
		$time = str_replace( '../project-info-temp/', '', str_replace( '.txt', '', $info ) );
		?>
<div class="row">
	<img src="<?php print $image_url; ?>"></div>
	<a href="./?approve=<?php print $time ?>">Approve</a>
</div>
		<?php
	}
} else {
	print "<p>No projects have been submitted yet. Fill out the form above to submit your project!</p>";
}
