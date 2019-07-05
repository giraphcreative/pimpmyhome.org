<?php
require('functions.php');
?><!doctype html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="utf-8">
	<title>Pimp My Home - Element Federal Credit Union</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/main.css?v=3">
	<script src="js/head.js"></script>
</head>
<body>
	<main class="container">
		
		<header>
			<a href="/"><img src="img/header.jpg" class="header"></a>
		</header>
		
		<div class="bg-green group pad text-center">
			<h1>Contest Ended</h1>
			<p>Voting and project submissions have ended for this contest - a big thanks to all who participated!</p>
			<!--
			<form name="upload" action="submit.php" method="post" enctype="multipart/form-data">
			<div class="half">
				<p><labal>First Name
					<input name="name" type="text" value="" /></labal>
					<span class="quiet">The name you enter here will be displayed on the project list below, only include what you'd like to be public.</span></p>
				<p><labal>Project Name
					<input name="project-name" type="text" value="" /></labal>
					<span class="quiet">The project name is displayed in the list below.</span></p>
				<p><labal>Upload Photo<br>
					<input name="photo" type="file" /></labal></p>
			</div>
			<div class="half">
				<p><labal>Email
					<input name="email" type="text" value="" /></labal></p>
				<p><labal>Phone
					<input name="phone" type="text" value="" /></labal>
					<span class="quiet">Your email and phone number are only used to get in touch with you, and will not be shared with third parties for any other purpose.</span></p>
				<p><input type="submit" name="submit" value="Submit" /></p>
			</div>
			</form>
			-->
		</div>

		<div class="bg-white pad projects" style="min-height: 400px;">
			<div class="intro">
				<h2>Vote For Your Favorite Project!</h2>
			</div>
			<?php
			/*
			$files = array();
			foreach ( glob( 'project-info/*.txt' ) as $file ) {
				$files[] = $file;
			}
			*/
			$files = get_submissions();
			if ( !empty( $files ) ) {
				foreach ( $files as $file ) {
					$image_url = 'project-photos/' . $file->submission_photo . '.jpg';
					?>
			<div class="third project" rel="<?php print $file->submission_photo; ?>">
				<div class="project-photo"><a href="<?php print $image_url; ?>"><img src="<?php print $image_url; ?>"></a></div>
				<?php print $file->submission_name . ", " . $file->submission_project; ?>
				<!--
				<div class="vote-buttons">
					<button class="vote-button" rel="<?php print $file->submission_photo; ?>">Vote for me</button>
				</div>
				-->
			</div>
					<?php
				}
			} else {
				print "<p>No projects have been submitted yet. Fill out the form above to submit your project!</p>";
			}
			?>
		</div>
	
		<a href="https://www.facebook.com/ElementFCU" target="_blank"><img src="img/footer-social.png" class="footer-social"></a>
		<a href="https://www.elementfcu.org/" target="_blank"><img src="img/more-info.png" alt="Learn more about how our home equity products can help you get your DIY on." /></a>

		<div class="footer-bar group">
			<div class="wrap">

				<div class="half text-center logo">
					<a href="https://www.elementfcu.org/"><img src="img/logo.png"></a>
				</div>
				<div class="half address">
					3418 MacCorkle Avenue SE<br>
					Charleston, WV 25304<br>
					<a href="tel:3047214145" class="phone">304.721.4145</a>
				</div>

				<div class="fine-print group">
					<img src="img/logo-housing.png" />
					*To win $500 NO PURCHASE NECESSARY. Automatic entry with photo submission on pimpmyhome.org. Alternatively, you may send a 3 x 5" card with name, address, and phone number addressed to Element Federal Credit Union ATTN: Home Equity Photo Contest, 3418 MacCorkle Ave. SE, Charleston, WV 25304. Contest valid April 15 - June 30, 2019. Winner will be drawn on or before July 15, 2019, and will be notified by the phone number and/or email address provided to the credit union upon submission. Membership eligibility required. This credit union is federally insured by the National Credit Union Administration. Equal Housing Lender.
				</div>

			</div>
		</div>

	</main>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/main.js?v=1"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-138697990-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-138697990-1');
</script>

</body>
</html>