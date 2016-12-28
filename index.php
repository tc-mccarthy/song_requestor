<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8"> <!-- set the character set -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- first step to a responsive site -->
	<title>Bootstrap starter template</title>

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- Your styles should be called here -->
  <link rel="stylesheet" href="css/style.min.css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>
  <body>
  	<div class="container"> <!-- start bootstrap container -->
      <input id="search" type="text" placeholder="Enter the name of the song you wish to request"></div>
      <div id="results" class="container">
        <table>
          <tr>
            <th class='img'></th>
            <th class='request'></th>
            <th>Song</th>
            <th>Artist</th>
            <th>Album</th>
          </tr>
        </table>
      </div>
  	</div>

  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  	<!-- Your javascript should be called here -->
    <script src="js/app.min.js"></script>
    <script id="results_template" type="text/template">
          <tr class='row'>
            <td class='img'>
              <a class="play" href="#">
                <img src='<%= item.album_image %>' />
                <i class='fa fa-play-circle-o'></i>
              </a>
              <audio src="<%= item.preview_track %>"></audio>
            </td>
            <td class='request'>
              <a href="#" class='request'>
                <i class="fa fa-plus"></i>
              </a>
            </td>
            <td><%= item.track_name %></td>
            <td><%= item.artist %></td>
            <td><%= item.album %></td>
          </tr>
    </script>
  </body>
</html>
