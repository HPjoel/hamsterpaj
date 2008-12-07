<?php
	require('../include/core/common.php');
	require(INCLUDE_PATH.'libraries/christmas_avatars_polls.lib.php');
	
	if(rand(0, 24) == 6)
	{
		christmas_avatar_recent_updates_check_new();
	}

	####  UI-options ####
	$ui_options['stylesheets'][] = 'christmas_avatar_poll.css';
	$ui_options['javascripts'][] = 'christmas_avatar_poll.js';
	$ui_options['title'] = 'Vem har b�st julavatar? R�sta nu! - Hamsterpaj.net';
	$ui_options['menu_path'] = array('traeffa', 'christmas_avatars_poll');
	ui_top($ui_options);
	
	echo '<h1>Omr�stning: B�sta julavatar!';
	if(is_privilegied('christmas_avatar_poll'))
	{
		echo ' - <a href="/admin/christmas_avatar_poll_admin.php" title="Administration">admin</a>';
	}
	echo '</h1>'."\n";
	
	//show the current polls (only links [#poll_ID] to the polls)
	echo christmas_avatar_current_polls_list();
	
	//list all available polls
	echo christmas_avatar_polls_list();

	echo '<br />'."\n";
	echo '<br />'."\n";
	
	//list all results from previous polls. Polls that have not expired are *NOT* displayed here.
	echo '<h1>Tidigare omr�stningar</h1>'."\n";
	echo christmas_avatar_results_list();
?>