<body>
    	<header>
    	<h1> Aktier </h1>
    	<div id="button_container">
 		<!--refresh the browser-->
 		    <div class= "refreshpage">
 			    <button onClick="window.location.reload();">Refresh Page</button>
 		    </div>
 		    <!--logout the user-->
 		    <div class="logout">
 			    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
        			<input type="submit" name="leave" id="leave" value="Log Out">
    			</form>
    	    </div>
    	</div>
    	
    	</header>
        <section>
