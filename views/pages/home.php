<div class="masthead text-center text-white d-flex">
	<div class="container my-auto">
		<div class="row">
			<div class="blue-text-block">
				<div class="col-lg-10 mx-auto">
					<h1 class="text-uppercase">
						<strong>Welcome to our website!</strong>
					</h1>
					<hr>
				</div>
				<div class="col-lg-8 mx-auto">
					<p class="text-faded mb-5">Start your introduction to our system.</p>
					<?php 
					if(!isset($_SESSION["loggedin"])){
					?>
					<a class="btn btn-primary btn-xl js-scroll-trigger" href="/login">Sign-in</a>
					<?php
				    }
				    if(isset($_SESSION["loggedin"]) && $_SESSION["permission"] == "admin"){
					?>
					<a class="btn btn-primary btn-xl js-scroll-trigger" href="/admin">Admin Panel</a>
					<?php
				    }
					?>
				</div>
			</div>
		</div>
	</div>
</div>