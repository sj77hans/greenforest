<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Sorter example with ajax - fileuploader - Innostudio.de</title>
		
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sorter example with ajax - fileuploader - Innostudio.de">
        <meta name="robots" content="noindex">
        

		<!-- fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="lib/fileuploader/2.2/css/font/font-fileuploader.css" rel="stylesheet">
        
		<!-- styles -->
		<link href="lib/fileuploader/2.2/css/jquery.fileuploader.min.css" media="all" rel="stylesheet">
		<link href="lib/fileuploader/2.2/css/jquery.fileuploader-theme-thumbnails.css" media="all" rel="stylesheet">
		
		<!-- js -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
		<script src="lib/fileuploader/2.2/js/jquery.fileuploader.min.js" type="text/javascript"></script>
		<script src="test.js" type="text/javascript"></script>

		<style>
			body {
				font-family: 'Roboto', sans-serif;
				font-size: 14px;
                line-height: normal;
				background-color: #fff;

				margin: 0;
			}
            
            .fileuploader {
                max-width: 100%;
				margin: 15px;
            }

			.fileuploader-icon-sort:before {
				position: absolute;
				top: 8px;
				left: 0;
			}

			.fileuploader-theme-thumbnails .fileuploader-item .content-holder {
				background: rgb(0 0 0 / 50%) !important;
			}

			.fileuploader-theme-thumbnails .fileuploader-item-inner {
				border: 1px solid #787878;
			}
		</style>
	</head>

	<body>
	<form id="loginform" method="post" action="loginchk.php">        <!-- file input -->
        <input type="file" name="files">
		<button type="submit">고</button>
	</form>
    </body>
</html>