<?php
	
require('../include/core/common.php');
require_once(PATHS_INCLUDE . 'libraries/posts.php');
require_once(PATHS_INCLUDE . 'libraries/markup.php');
//require_once($hp_includepath . '/libraries/markup.php');
//require_once($hp_includepath . '/libraries/games.lib.php');
//require_once($hp_includepath . '/libraries/schedule.lib.php');
//require_once(PATHS_INCLUDE . 'libraries/tips.lib.php');


	preint_r($_GET);
	// HELL NO!
	// Med den h�r raden s� kan man cracka 50% av hamsterpajs l�senord p� n�gra timmar.
	// I och med att den skriver ut sessionen s� f�r man reda p� sin hash, och skriver
	// man d� ett program som byter l�senord <generalsettings.php> och h�mtar hashen <$_SERVER['SCRIPT_NAME']> (FFS!)
	// S� kan man komma ganska l�ngt. [reformaterat]
	// H�lsar LordDanne.
	// preint_r($_SESSION);

	

?>
