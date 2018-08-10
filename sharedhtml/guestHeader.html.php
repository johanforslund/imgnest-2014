<div class="header">
	<div class="useractioncontainer">
		<div onclick="dropdown()" class="useraction" id="useraction">
			<p class="logintext">Log in</p>
		</div>
	</div>
	<div id="submenu" class="submenu">
		<form action="/login/index.php?login" method="post" name="loginform" class="loginform">
			<input id="user_name" name="user_name" class="logininput" placeholder="Username" type="text" required autofocus/>
			<input id="user_password" name="user_password" style="margin-top: 5px;" class="logininput" placeholder="Password" type="password" required/>
			<input class="loginsubmit" type="submit" value="Log in" name="login" />
			<input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
			<label class="keepmeloggedin" for="user_rememberme">Keep me logged in</label>
			<a class="forgotpw" href="/forgotpassword">Forgot password</a>
		</form>
	</div>
	
	<a href="/"><img src="/images/logo.png" class="logo" /></a>
	
	<div class="desctext">
		<p style="color: #fdeac5; margin: 1em 0px">Upload a picture which you want edited.</p>
		<p style="color: #edfeff; margin: 1em 0px">Other users edit your image after your demands.</p>
		<p style="color: #fdeac5; margin: 1em 0px">Download the edited image.</p>
	</div>
	
	<div class="headerbuttons">
		<a href="/readmore"><div class="readmore"><p class="buttontext">READ MORE</p></div></a>
			<p class="or">OR</p>
		<a href="/signup"><div style="margin-right: 0;" class="signup"><p class="buttontext">SIGN UP</p></div></a>
	</div>	
		
</div>