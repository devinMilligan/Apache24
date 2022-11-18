# Apache24

Add C:\Apache24\php to your system file path enviroment variable
   This must be placed in the C: drive directly
   
All HTML, php, and other code files should be placed in Apache24\htdocs

Upload.html and fileUploadScripts.php are complete so feel free to use as examples

Apache24\conf\httpd.conf is where the opening file is set
	Currently it is set to Upload.html
	
To run the webserver
	Open up cmd
	navigate to Apache24\bin
	run command 'httpd'
	open in browser 'http://localhost'
	
Note:
	if you look in fileUploadScripts.php, at the top there is a header line, this line waits 10 seconds and then send the user to the file listed
	this could be useful
	

	

   