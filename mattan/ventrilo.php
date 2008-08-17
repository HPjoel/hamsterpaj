<?php
  require('../include/core/common.php');
  $ui_options['menu_path'] = array('mattan', 'ventrilo');
  $ui_options['title'] = 'Ventrilo';
  ui_top($ui_options);

	if($_GET['do'] == "check") {
		if(empty($_POST['channelname']) || empty($_POST['channelpass'])) {
			$output .= '<p>Du gl�mde fylla i ett f�lt.</p>';
		} else {
			//$query = 'INSERT INTO ventrilo (uid, channelname, channelpass, adminpass, expire) VALUES (' . ;
			$output .= '<p>Din kanal �r skapad, den kommer aktiveras 04:00 inatt.</p>';
		}
	} else {

		$output = '<h1>Ventrilo p� Hamsterpaj.net</h1>';
		$output .= '<p>S� h�r ansluter du till vent-servern...</p>';
	
		if(login_checklogin()) {
			$output .= '<p>H�r under kan du skapa ett eget rum. <br /><br />';
			$output .= '<form action="?do=check" method="post">';
			$output .= 'Kanalnamn: <input type="text" name="channelname" /><br />';
			$output .= 'Kanall�sen: <input type="text" name="channelpass" /><br />';
			$output .= 'Adminl�sen: <input type="text" name="adminpass" /><br /></p>';
			$output .= '<input type="submit" value="Skicka" />';
			$output .= '</form>';
		} else {
			$output .= 'Om du vill ha ett eget rum p� Hamsterpajs-vent m�ste du logga in eller skapa ett konto.<br />';
		}
	}

	echo utf8_encode($output);
  ui_bottom();
?>
