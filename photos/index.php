<?php


require( '../functions.php' );

if ( isset( $_REQUEST['approve'] ) ) {
	$approve = $_REQUEST['approve'];
	$db->update( "update `submissions` set `submission_status`='approved' where `submission_photo`='" . $approve . "';" );
}


?>
<!doctype html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="utf-8">
	<title>Pimp My Home - Element Federal Credit Union</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/main.css?v=3">
	<script src="../js/head.js"></script>
</head>
<body>
	<main class="container admin group" style="padding: 30px;">
		<div class="half">
			<h3>Submissions to Review</h3>
		<?php

		$files = get_pending_submissions();
		if ( !empty( $files ) ) {
			foreach ( $files as $file ) {
				?>
			<div class="row">
				<img src="../project-photos/<?php print $file->submission_photo; ?>.jpg">
				<a href="./?approve=<?php print $file->submission_photo ?>">Approve Project</a>
			</div>
				<?php
			}
		} else {
			print "<p>No projects to be approved. Wait for more to be submitted.</p>";
		}

		?>
		</div>
		<div class="half stats text-center">
			<h3>Vote Totals</h3>
			<?php 

			global $db;

			$voted = $db->query( 'select distinct `vote_for`, count(*) as `count` from `vote` group by `vote_for` order by `count` desc;' );
			if ( !empty( $voted ) ) {				
				foreach ( $voted as $vote ) {
					$sub = $db->query_one( 'select * from `submissions` where `submission_photo`="' . $vote->vote_for . '";' );
					?>
				<div class="item">
					<div class="sixty"><?php print $sub->submission_name ?>, <?php print $sub->submission_project ?></div>
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