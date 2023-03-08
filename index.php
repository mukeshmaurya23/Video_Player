<?php require_once("includes/header.php"); ?>

<div class="container">
	<div class="videoSection">
		<div class="subs" style="overflow-x: auto;">
			<?php
			$subscriptions = $userLoggedInObj->getSubscriptions();

			if (User::isLoggedIn() && sizeof($subscriptions) > 0) {
				foreach ($subscriptions as $sub) {
					$subUsername = $sub->getUsername();
					$profilePic = $sub->getProfilePic();
					echo 	"<div class='listOfSubs'>
									<a href='profile?username=$subUsername'><img src='$profilePic'></a>
									<span class='caption'>$subUsername</span>
								</div>";
				}
			}
			?>
			<!-- <p> Subscriptions </p>
			<h4> <a href="subscriptions"> See All </a> </h4>
			<p>Virat Kohli</p>

			<p>MS Dhoni</p>

			<p>Shikhar Dhawan</p> -->
		</div>
		<?php
		$subscriptionsProvider = new SubscriptionsProvider($con, $userLoggedInObj);
		$subscriptionsVideos = $subscriptionsProvider->getVideos();

		$videoGrid = new VideoGrid($con, $userLoggedInObj->getUsername());

		if (User::isLoggedIn() && sizeof($subscriptionsVideos) > 0) {
			echo $videoGrid->create($subscriptionsVideos, "Subscriptions", false);
		}

		echo $videoGrid->create(null, "Home", false);
		?>



	</div>
</div>

<?php require_once("includes/footer.php"); ?>