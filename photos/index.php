<?php


require( '../functions.php' );

if ( isset( $_REQUEST['approve'] ) ) {
	$approve = $_REQUEST['approve'];
	rename( '../project-info-temp/' . $approve . '.txt', '../project-info/' . $approve . '.txt' );
	rename( '../project-photos-temp/' . $approve . '.jpg', '../project-photos/' . $approve . '.jpg' );
}


?>
<!doctype html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="utf-8">
	<title>Pimp My Home - Element Federal Credit Union</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/main.css?v=2">
	<script src="../js/head.js"></script>
</head>
<body>
	<main class="container admin group" style="padding: 30px;">
		<div class="sixty">
			<h3>Submissions</h3>
		<?php

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
				<img src="<?php print $image_url; ?>">
				<a href="./?approve=<?php print $time ?>">Approve</a>
			</div>
				<?php
			}
		} else {
			print "<p>No projects to be approved. Wait for more to be submitted.</p>";
		}

		?>
		</div>
		<div class="fourty stats text-center">
			<h3>Vote Totals</h3>
			<?php 

			global $db;

			$voted = $db->query( 'select distinct `vote_for`, count(*) as `count` from `vote` group by `vote_for` order by `count` desc;' );
			if ( !empty( $voted ) ) {				
				foreach ( $voted as $vote ) {
					?>
				<div class="item">
					<div class="sixty"><?php print file_get_contents( '../project-info/' . $vote->vote_for . ".txt" ) ?></div>
					<div class="fourty"><?php print $vote->count ?></div>
				</div>
					<?php
				}
			}

			?>
		</div>
	</main>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
	
</script>
</body>
</html>