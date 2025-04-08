<html>
	<head>
		<title>Brain-Computer Interface Wiki</title>
		<script src="https://unpkg.com/vue@3"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css" integrity="sha512-OivR4OdSsE1onDm/i3J3Hpsm5GmOVvr9r49K3jJ0dnsxVzZgaOJ5MfxEAxCyGrzWozL9uJGKz6un3A7L+redIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
		
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
			
			.dropdown {
				z-index: 3;
			}
			.dropdownoption {
				background-color: white;
			}
			.dropdownoption:hover {
				background-color: #EEEEEE;
				cursor: pointer;
			}
		</style>
		  <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	
	
	<body class="bg-light">
		<div id="app">
			<div @click="clearSearch">
			<div class="container">
				<div class="row">
					<div class="col-md-2 offset-md-5 col-4 offset-4">
						<img src="logo.png" class="w-100"/>
					</div>
				</div>
				<div class="row text-center">
						<h2>Information about brain-computer interfaces</h2>
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
				</br>
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-sm-12">
						<div class="input-group">
						  <input type="text" class="form-control" id="searchquery" aria-label="Search Query"  @input="searchSite()" @keydown="searchSite()" @change="searchSite()" @keydown.enter="searchSubmit()" v-model="searchtext">
						  <button class="btn btn-outline-primary" type="button" @click="searchSubmit()">Search</button>
						</div>
						<div class="bg-white position-absolute col-lg-5 dropdown">
							<div v-if="searchsuggestions.query" v-for="suggestion in searchsuggestions.query.search">
								<div class="dropdownoption p-2" @click="gotoPage(suggestion.title)">
									<b>{{ suggestion.title }}</b></br>
									<i v-html="suggestion.snippet"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="bg-white col-12 mt-5 pt-5 pb-5">
				<div class="row w-100">
					<div class="col-lg-4 col-sm-12">
						<ul class="list-group-flush">
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Brain_Computer_Interface_Companies">Brain Computer Interface Companies</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Labs">Labs</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Brain_Computer_Interface_Classification">Classification</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Application_Categories">Application Categories</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Demo_Videos">Demonstration Videos</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Neurosensing_Techniques">Neurosensing Techniques</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Neurostimulation_Techniques">Neurostimulation Techniques</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Books">Books</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Hardware">Hardware</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Software">Software</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/A_Quick_Look_at_Applications_for_EEG">A Quick Look at Applications for EEG</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-sm-12">
						<ul class="list-group-flush">
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Brain_Computer_Interfaces_In_Fiction">Brain Computer Interfaces In Fiction</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Wikipedia_Links">Wikipedia Links</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Company_Profiles">Company Profiles</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Developer_Tools">Developer Tools</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Podcasts">Podcasts</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:YouTube_Channels">YouTube Channels</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Facebook_Pages">Facebook Pages</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Instagram_Pages">Instagram Pages</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Twitter_Accounts">Twitter Accounts</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/Neurotech_Mindmap">Neurotech Mindmap</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Datasets">Datasets</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-sm-12">
						<ul class="list-group-flush">
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Organizations">Brain Computer Interface Organizations</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Investors">Venture Capital and Investors</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Events">Events</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:LinkedIn_Accounts">LinkedIn Accounts</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:GitHub_Accounts">GitHub Accounts</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:GitHub_Repos">GitHub Repositories</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:App_Store_Apps">App Store Apps</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Category:Play_Store_Apps">Play Store Apps</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/index.php/Contributors">Contributors</a></li>
							<li class="list-group-item"><a href="https://bciwiki.org/Feedback">Feedback</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="container mt-5">
				<div class="row">
					<div class="col-12">
						<p>Welcome to BCIWiki! A collection of links and resources related to computers that interface with the nervous system.</p>
						<p>The long-term goals for this project are to make it simple for anyone to understand the capabilities and limitations of Brain-Computer Interface (BCI) technologies, and to make informed hypotheses about their potential uses. <a href="https://en.wikipedia.org/wiki/Brain%E2%80%93computer_interface">click here for an explanation of BCI</a>.</p>
						</br>
						<i><p>Site by <a href="">Landon Burress</a></br>
						If you're interested in becoming a contributor or requesting changes then please reach out on <a href="https://discord.gg/3eqKb9bmFy">Discord</a>, <a href="https://twitter.com/bciwiki">Twitter</a>, or from this <a href="/Feedback">feedback form</a>.</p></i>
					</div>
				</div>
			</div>
			</div>
		</div>
	</body>

	<script>
	  const { createApp } = Vue

	  createApp({
		data() {
		  return {
			searchtext: '',
			searchsuggestions: {}
		  }
		},
		methods: {
			searchSite() {
				console.log(this.searchtext)
				fetch("https://bciwiki.org/api.php?action=query&list=search&srsearch="+this.searchtext+"&utf8=&format=json").then(resp => resp.json()).then(results => this.searchsuggestions = results).catch(e => console.log(e))
				console.log(this.searchsuggestions['query']['search'][0])
			},
			gotoPage(pagename) {
				location.href='https://bciwiki.org/index.php/'+pagename
			},
			clearSearch() {
				this.searchsuggestions = {}
			},
			searchSubmit(){
				if(this.searchtext!=''){
					location.href='https://bciwiki.org/index.php?search='+this.searchtext
				}
			}
		}
	  }).mount('#app')
	</script>
</html>