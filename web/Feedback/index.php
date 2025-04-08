<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$section_names = ["information" => "Informational Pages", "groups" => "Groups", "socialMedia" => "Social Media", "events" => "Events", "media" => "Media", "products" => "Products", "softwareTools" => "Software Tools"];

if(count($_POST) > 0){
	$mail = new PHPMailer(true);
	$email_title = "";
	$feedback_text = "";
	
	if(isset($_POST['general_feedback'])){
		$email_title = "General Feedback";
		$feedback_text = "URL:\n".$_POST['general_url']."\n\nMessage:\n".$_POST['general_feedback'];
	}else{
		$email_title = "Advanced Feedback";
		foreach($section_names as $section_name => $section_title){
			$feedback_text .= $section_title." Message:\n".$_POST[$section_name."_feedback"]."\n\n";
		}
	}
	
	try {
	//Server settings
	$mail->isSMTP();                                            // Send using SMTP
	$mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	$mail->Username   = 'feedback@bciwiki.org';                     // SMTP username
	$mail->Password   = '8(1wiK1F3edb4cK';                               // SMTP password
	$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	$mail->Port       = 465;                                    // TCP port to connect to

	//Recipients
	$mail->setFrom('feedback@bciwiki.org');
	$mail->addAddress('feedback@bciwiki.org');
	$mail->addAddress('landon@bciwiki.org');

	$mail->Subject = $email_title;
	$mail->Body    = $feedback_text;

	$mail->send();
	header("Location: /Feedback?sent=true");
	} catch (Exception $e) {
		header("Location: /Feedback?sent=false");
	}
}
 ?>
<html>
	<head>
		<title>Feedback | Brain-Computer Interface Wiki</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/regular.min.css" integrity="sha512-k2UAKyvfA7Xd/6FrOv5SG4Qr9h4p2oaeshXF99WO3zIpCsgTJ3YZELDK0gHdlJE5ls+Mbd5HL50b458z3meB/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
		
		<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
		
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-W07B3RRNW4"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-W07B3RRNW4');
		</script>

		<style>
			body {
				font-family: 'Roboto';
			}
			
			.menuLink {
				color: black;
				text-decoration: none;
			}
			.menuLink:hover {
				color: black;
				text-decoration: none;
			}
		</style>
		  <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	
	
	<body class="bg-light" onload="bodyReady();">
	<?php if(isset($_GET['sent'])){
	?>
	<script type="text/javascript">
    $(window).on('load', function() {
        $('#sentModal').modal('show');
    });
</script>

	<?php
			if($_GET['sent'] == "true"){
			?>
			<div class="modal" tabindex="-1" role="dialog" id="sentModal">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-body">
					<p>Feedback sent successfully.</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#sentModal').modal('hide');">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			<?php
			}else{ ?>
			<div class="modal" tabindex="-1" role="dialog" id="sentModal">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-body">
					<p>Something went wrong.</br>Please try again or help out by letting me know: landon@bciwiki.org</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#sentModal').modal('hide');">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			<?php }} ?>
			<div class="container pb-5">
				<div class="row">
					<div class="col-md-2 offset-md-5 col-4 offset-4">
						<a href="/main.php"><img src="../logo.png" class="w-100"/></a>
					</div>
				</div>
				<div class="row text-center">
						<h2>Suggestion Submission Form</h2>
				</div>
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-sm-12">
						<div class="row">
							<div class="col-2 offset-4 text-center">
								<a class="text-decoration-none h2" href="https://twitter.com/bciwiki"><span class="fa-brands fa-twitter"></span></a>
							</div>
							<div class="col-2 text-center">
								<a class="text-decoration-none h2" href="https://discord.gg/3eqKb9bmFy"><span class="fa-brands fa-discord"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-white col-12 mt-4 pt-4 pb-4">
				<div class="row w-100">
					<div class="col-lg-10 offset-lg-1 col-sm-12">
						<h3><a class="menuLink" data-bs-toggle="collapse" href="#general" role="button" aria-expanded="false" aria-controls="general" onclick="toggleIcon('#generalIcon');">
							<i class="fa fa-fw fa-chevron-down" id="generalIcon"></i>   General Feedback
						</a></h3>
					</div>
				</div>
			</div>
			<div class="col-12 pt-4 pb-4 collapse show" id="general">
				<div class="row w-100">
					<div class="col-lg-10 offset-lg-1 col-sm-12">
						<form action="" method="post" class="px-2">
							<div class="row">
								<div class="col-12">
									<label>URL / Page Title</label>
									<input class="form-control" type="text" name="general_url" />
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-12">
									<label>Suggestion *</label>
									<textarea class="form-control" name="general_feedback" rows="8" placeholder="Questions, Requests for updates, Collaboration proposals, Ideas for the website, BCI applications, Anything else" required></textarea>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-lg-2 offset-lg-5 col-sm-12">
									<button class="btn btn-primary form-control" type="submit">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="bg-white col-12 pt-4 pb-4">
				<div class="row w-100">
					<div class="col-lg-10 offset-lg-1 col-sm-12">
						<h3><a class="menuLink" data-bs-toggle="collapse" href="#advanced" role="button" aria-expanded="false" aria-controls="advanced" onclick="toggleIcon('#advancedIcon');">
							<i class="fa fa-fw fa-chevron-up" id="advancedIcon"></i>   Advanced Feedback
						</a></h3>
					</div>
				</div>
			</div>
			<form action="" method="post">
				<div class="col-12 collapse show" id="advanced">
					<?php
						
						end($section_names);
						$last_section = key($section_names);
						?><script>const section_names=[<?php
						foreach($section_names as $section_name => $section_title){
							echo("\"".$section_name."\"");
							if($section_name != $last_section){
								echo(", ");
							}
						}
						?>];</script><?php
						
						foreach($section_names as $section_name => $section_title){
					?>
					<div class="bg-white col-12 pt-4 pb-4">
						<div class="row w-100">
							<div class="col-lg-8 offset-lg-2 col-sm-12">
								<h4 class="pl-4"><a class="menuLink" data-bs-toggle="collapse" href="#<?= $section_name ?>" role="button" aria-expanded="false" aria-controls="<?= $section_name ?>" onclick="toggleIcon('#<?= $section_name ?>Icon');">
									<i class="fa fa-fw fa-chevron-up" id="<?= $section_name ?>Icon"></i>   <?= $section_title ?>
								</a></h4>
							</div>
						</div>
					</div>
					<div class="col-12 pt-4 pb-4 collapse show" id="<?= $section_name ?>">
						<div class="row w-100">
							<div class="col-lg-10 offset-lg-1 col-sm-12">
								<div class="row px-2">
									<div class="col-12">
								<?php
								$placeholder_text = "";
									switch($section_name){
										case "information":
											?>
												<h5>Pages: <a href="/main.php">main.php</a>, <a href="/index.php/Brain_Computer_Interface_Classification">Brain Computer Interface Classification</a>, <a href="/index.php/Application_Categories">Application Categories</a>, <a href="/index.php/Contributors">Contributors</a>, <a href="/index.php/Category:Neurosensing_Techniques">Neurosensing Techniques</a>, <a href="/index.php/Category:Neurostimulation_Techniques">Neurostimulation Techniques</a>, <a href="/index.php/Wikipedia_Links">Wikipedia Links</a></h5>
											<?php
											$placeholder_text = "Ideas about what to list on the home page,\nHow to classify BCI applications and organizations,\nUnlisted methods for measuring/modulating neural activity,\nRelevant Wikipedia pages";
											break;
										case "events":
											?>
												<h5>Page: <a href="/index.php/Category:Events">Events</a></h5>
											<?php
											$placeholder_text = "Any neuroscience conferences, hackathons, conventions, or other events";
											break;
										case "media":
											?>
												<h5>Pages: <a href="/index.php/Category:Podcasts">Podcasts</a>, <a href="/index.php/Category:Books">Books</a>, <a href="/index.php/Demo_Videos">Demonstration Videos</a>, <a href="/index.php/Brain_Computer_Interfaces_In_Fiction">Brain Computer Interfaces In Fiction</a></h5>
											<?php
											$placeholder_text = "Media and online content about brain-computer interfaces,\nIdeas for new page categories,\nHow to format the table of sci-fi examples";
											break;
										case "groups":
											?>
												<h5>Pages: <a href="/index.php/Category:Organizations">Organizations</a>, <a href="/index.php/Category:Companies">Companies</a>, <a href="/index.php/Category:Investors">Investors</a>, <a href="/index.php/Company_Profiles">Company Profiles</a></h5>
											<?php
											$placeholder_text = "Unlisted neurotech companies/labs/non-profits/funds,\nIdeas about how to format the table of companies,\nHow to improve generated company infographics";
											break;
										case "socialMedia":
											?>
												<h5>Pages: <a href="/index.php/Category:YouTube_Channels">YouTube Channels</a>, <a href="/index.php/Category:LinkedIn_Accounts">LinkedIn Accounts</a>, <a href="/index.php/Category:Twitter_Accounts">Twitter Accounts</a>, <a href="/index.php/Category:GitHub_Accounts">GitHub Accounts</a>, <a href="/index.php/Category:Facebook_Pages">Facebook Pages</a>, <a href="/index.php/Category:Instagram_Pages">Instagram Pages</a></h5>
											<?php
											$placeholder_text = "Links to unlisted social media pages,\nOther social media platforms to include";
											break;
										case "products":
											?>
												<h5>Page: <a href="/index.php/Category:Hardware">Hardware</a></h5>
											<?php
											$placeholder_text = "Consumer, medical, and research devices for neural monitoring and stimulation";
											break;
										case "softwareTools":
											?>
												<h5>Pages: <a href="/index.php/Category:Software">Software</a>, <a href="/index.php/Category:Developer_Tools">Developer Tools</a>, <a href="/index.php/Category:GitHub_Repos">GitHub Repos</a>, <a href="/index.php/Category:App_Store_Apps">App Store Apps</a>, <a href="/index.php/Category:Play_Store_Apps">Play Store Apps</a></h5>
											<?php
											$placeholder_text = "Desktop / web / mobile / VR software for neuroscience research and BCI applications,\nDevelopment libraries / APIs / SDKs";
											break;
									}
								?>
								</div>
							</div>
									<div class="row px-2">
										<div class="col-12">
											<label>Suggestion</label>
											<textarea class="form-control" name="<?= $section_name ?>_feedback" rows="8" placeholder="<?= $placeholder_text ?>"></textarea>
										</div>
									</div>
									<div class="row pt-3 px-2">
										<div class="col-lg-2 offset-lg-5 col-sm-12">
											<button class="btn btn-primary form-control" type="submit">Submit</button>
										</div>
									</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div>
			</form>
			
			<div class="bg-white col-12 pb-5">
				<div class="row w-100">
				</div>
			</div>
			
			<div class="container mt-5 pt-5 pb-5">
				<div class="row">
					<div class="col-12">
						
					</div>
				</div>
			</div>
	</body>
	<script>
		function toggleIcon(icon_name){
			if($(icon_name).hasClass("fa-chevron-up")){
				$(icon_name).removeClass("fa-chevron-up");
				$(icon_name).addClass("fa-chevron-down");
			}else{
				$(icon_name).removeClass("fa-chevron-down");
				$(icon_name).addClass("fa-chevron-up");
			}
		}
		
		function bodyReady(){
			expand_section_id = window.location.hash;
			if(expand_section_id != ""){
				if(expand_section_id != "#general"){
					$("#general").collapse('toggle');
					for(a=0; a < section_names.length; a++){
						if(expand_section_id != "#".concat(section_names[a])){
							$("#".concat(section_names[a])).collapse('toggle');
						}
					}
				}else{
					$("#advanced").collapse('toggle');
				}
			}else{
				$("#advanced").collapse('toggle');
			}
		}
	</script>
</html>