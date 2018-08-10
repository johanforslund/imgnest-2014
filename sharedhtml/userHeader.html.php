<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messagechecker.inc.php'; ?>

<div class="header">
	<div class="useractioncontainer">
		<a href="/messages"><div class="unreadmessages"><p class="<?php htmlout($unreadnumberstyle); ?>"><?php htmlout($total); ?></p> <p class="unreadtext">UNREAD MESSAGES</p><img class="unreadicon" src="<?php htmlout($messageiconsrc); ?>" /></div></a>
		<div onclick="dropdown()" class="useraction">
			<p class="usernametext"><?php htmlout($_SESSION['user_name']);?></p>
			<img class="arrow_down" src="/images/arrow_down.png" />
		</div>
	</div>
	<div id="submenu" class="submenu">
		<ul class="dropdownpanel">
			<li class="dropdownpanelbutton"><i class="fa fa-cog fa-fw"></i><a href="/settings">Settings</a></li>
			<li class="dropdownpanelbutton"><i class="fa fa-user fa-fw"></i><a href="/profile/?profileid=<?php htmlout($_SESSION['user_name']); ?>">Profile</a></li>
			<li class="dropdownpanelbutton"><a href="?logout"><div class="logoutbutton"><p style="position: relative; top: 7px;">Log out</p></div></a></li>
		</ul>
	</div>

	<a href="/"><img src="/images/logo.png" class="logo" /></a>
	
	<div class="desctext">
		<p style="color: #fdeac5; margin: 1em 0px">Upload a picture which you want edited.</p>
		<p style="color: #edfeff; margin: 1em 0px">Other users edit your image after your demands.</p>
		<p style="color: #fdeac5; margin: 1em 0px">Download the edited image.</p>
	</div>
		
</div>