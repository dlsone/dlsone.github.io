<html>

	<head>
		<title>Dlsone Podcast Episodes</title>
		<link rel="stylesheet" type="text/css" href="../dlsone.css" />
		<link rel="shortcut icon" href="../sharedPictures/dlsoneIcon.png">
		
		<meta charset="UTF-8">
		<meta name="description" content="The official website for the Dlsone Podcast, a monthly cubing-related podcast! Check out this page for all the episodes, information about the hosts, news, and more!">
		<meta name="keywords" content="Dlsone,Podcast,Dlsone Podcast,Cubing,Rubik's Cube,Speedcubing,Speedsolving,Rubik's,Rubix,Cubers,Collaboration,DGCubes,Derpy Cuber,Hashtag Cuber,TheProgrammingCuber,TheRubiksCubed,Episodes">
		<meta name="author" content="Daniel Goodman">
		
		<!--CODE ADAPTED FROM https://productforums.google.com/forum/#!topic/docs/RMKFBdfd3t4-->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawSheetName);

			function drawSheetName() {
				// Selects the columns to be extracted
				var queryString = encodeURIComponent('SELECT A, J');

				// Change headers=1 to headers=0 to include the first row
				var query = new google.visualization.Query('https://docs.google.com/spreadsheets/d/1imn0fgDzJaE-T0wArXAqMyutEriyeL4dGJ5nKfe1CzI/gviz/tq?gid=0&headers=1&tq=' + queryString); 
				query.send(handleSampleDataQueryResponse);
			}

			function handleSampleDataQueryResponse(response) {
				var data = response.getDataTable();
				
				var episodes = data.getValue(0,0) - 1;
				var html = "";
				
				var episodes_wanted = [];
				
				var more_episodes = true;
				var num = 1;
				
				while (more_episodes) {
					try {
						episodes_wanted.push(document.getElementById(num).innerHTML);
						num += 1;
					} catch(error) {
						more_episodes = false;
					}
				}
				
				for (i = 0; i < episodes_wanted.length; i++) {
					html += data.getValue(episodes_wanted[i] - 1,1);
					html += "<table class='bottomBorder'><tr><td></td></tr></table>";
				}
				
				document.getElementById("allEpisodes").innerHTML = html;
			}
		</script>
		
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-97373094-1', 'auto');
			ga('send', 'pageview');
		</script>
	</head>

	<body>

		<table class="banner">
			<tr>
				<td>
					<a href="https://www.youtube.com/channel/UC1S2PJpLSVwj_ex5CRx60pQ" target="_blank"><img src="../sharedPictures/banner2.png" class="banner" alt="Banner"></a>
				</td>
			</tr>
		</table>

		<ul>
			<li class="nav"><a href=".." style="color:white;">Homepage</a></li>
			<li class="nav"><a href="../hosts" style="color:white;">Hosts</a></li>
			<li class="nav" style="width:34%;"><a href="#" style="font-weight:bold;color:black;">Episodes</a></li>
		</ul>

		<?php
			$servername = "localhost";
			$username = "u767752771_dg";
			$password = "jumboTest";
			$dbname = "u767752771_eps";
			
			$search = $_POST["search"];

			// Create connection
			$link = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($link->connect_error) {
				die("Connection failed: " . $link->connect_error);
			} 
			echo "Connected successfully";

			$num = 0;
			
			// Attempt select query execution
			$sql = "SELECT id FROM episodes WHERE (title LIKE '%$search%' OR guest LIKE '%$search%' OR description LIKE '%$search%')";
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					echo "<table>";
						echo "<tr>";
							echo "<th>id</th>";
						echo "</tr>";
					while($row = mysqli_fetch_array($result)){
						$num = $num + 1;
						echo "<tr>";
							echo "<td id='" . $num . "'>" . $row['id'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					// Free result set
					mysqli_free_result($result);
				} else{
					echo "No records matching your query were found.";
				}
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
			 
			// Close connection
			mysqli_close($link);
		?>

		<table id ="episodes">
			<tr>
				<td id="episodesBorder">
					<span id="allEpisodes">
					</span>
				</td>
			</tr>
		</table>
	</body>
</html>								