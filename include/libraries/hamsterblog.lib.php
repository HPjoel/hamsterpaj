<?php
function render_entries($entries, $options)
{
	$content .= '<ul class="group_entries">' . "\n";
	foreach ($entries AS $entry)
	{
		$options['user_id'] = $entry['user_id'];
		$content .= message_top($options);
							$content .= '<div style="border-bottom: 1px solid #ababab;">' . "\n";
								$content .= '<span class="timestamp">' . fix_time($entry['timestamp']) . '</span>' . "\n";
								$content .= '<h2 style="display: inline;">'
								 .  $entry['header'] . '</h2> - <a href="/traffa/profile.php?id=' . $entry['user_id'] . '">' . $entry['username'] . '</a> ' . "\n";
								$content .= $entry['gender'];
								$content .= date_get_age($entry['birthday']);
								$content .= '<p>' . "\n";
								$content .= nl2br(html_entity_decode($entry['content'])) . "\n";
							$content .= '</p>' . "\n";
						$content .= '</div>' . "\n";
						// ----START----
						$content .= ($_GET['action'] != 'show') ? '<a href="/hamsterpaj/hamsterblogg.php?action=show&id=' . $entry['id'] . '">Kommentera &raquo;</a>' : '<a href="/hamsterpaj/hamsterblogg.php">&laquo; Tillbaka</a>';
						// ----END------
		$content .= message_bottom();
		if ($options['enable_comments'] == true)
		{
			$content .= rounded_corners_top();
			$content .= '<label>Kommentera:</label>' . "\n";
			$content .= comments_input_draw($entry['id'], 'hamsterblog');
			$content .= rounded_corners_bottom();
			$content .= '<div style="clear: both;"></div>' . "\n";
			$content .= comments_list($entry['id'], 'hamsterblog');
		}
	}
	$content .= '</ul>' . "\n";
	return $content;
}
?>