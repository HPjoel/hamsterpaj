<?php
		$ui_options['ui_modules']['photoblog_user'] = 'User';
		$ui_options['ui_modules']['photoblog_calendar'] = 'Kalender';
		$ui_options['ui_modules']['photoblog_albums'] = 'Album';
		
		// this should probably be added to som .lib
		$query .= 'SELECT l.id FROM login AS l';
		$query .= ' WHERE l.username = "' . $username . '"';
		$query .= ' LIMIT 1';
		$result = mysql_query($query) or die(report_sql_error($query, __FILE__, __LINE__));
		$user = mysql_fetch_assoc($result);
		
		$user_id = $user['id'];
		$options = array(
			'user' => $user_id
		);
		
		$photos = photoblog_photos_fetch($options);			
		$out .= '<div id="photoblog_thumbs">';
			$out .= '<div id="photoblog_thumbs_container">';
				$out .= '<dl>';
				$out .= '<dt id="photoblog_prevmonth"><a title="F&ouml;reg&aring;ende m&aring;nad" href="#">F&ouml;reg&aring;ende m&aring;nad</a></dt>';
				$is_first = true;
				$last_day = array('date' => null, 'formatted' => null);
				foreach ( $photos as $photo )
				{
					if ( $last_day['date'] != $photo['date'] )
					{
						$last_day['date'] = $photo['date'];
						$last_day['formatted'] = date('j/n', strtotime($photo['date']));
						$out .= '<dt>' . $last_day['formatted'] . '</dt>';
					}
					$out .= '<dd><a title="' . $photo['date'] . '" rel="imageid_' . $photo['id'] . '" ' . ($is_first ? 'class="photoblog_active"' : '') . ' href="#image-' . $photo['id'] . '"><img src="' . IMAGE_URL . 'photos/mini/' . floor($photo['id']/5000) . '/' . $photo['id'] . '.jpg" title="' . $photo['username'] . '" /></a></dd>';
					$is_first = false;
				}
				
				$out .= '<dt id="photoblog_nextmonth"><a title="N&auml;sta m&aring;nad" href="#">N&auml;sta m&aring;nad</a></dt>';
				$out .= '</dl>';
			$out .= '</div>';
		$out .= '</div>';
		$out .= '<div id="photoblog_image">';
		$first_photo = $photos[0];
		$out .= '<p><img src="http://images.hamsterpaj.net/photos/full/' . floor($first_photo['id'] / 5000) . '/' . $first_photo['id'] . '.jpg" alt="" /></p>';
		$out .= '</div>';
		$out .= '<div id="photoblog_description">';
		$out .= '<div id="photoblog_description_text">';
			$out .= '<p>Jag tänkte att jag skulle kunna äta upp dig.';
			$out .= '<br />';
			$out .= '<br />';
			$out .= 'Not.</p>';
			$out .= '</div>';
		$out .= '</div>';
		$out .= '<div id="photoblog_comments">';
			$out .= '<h3>Kommentarer</h3><ul>';
			
					$options['user_id'] = "625058";
						$out .= message_top($options);
						$out .= '<form action="#" method="post">' . "\n";
						$out .= '<p><label><span>Kommentar:</span> <textarea value="Kommentar..." name="comment"></textarea></label><br /> <input class="submit" type="submit" value="Skicka" /></p>' . "\n";
						$out .= '</form>' . "\n";
						$out .= message_bottom();
					$out .= '</ul>
				
				<br style="clear: both;" />
				<div id="photoblog_comments_container">
					<ul>' . "\n";
					$comment1 = array('user_id' => 625058, 'comment' => 'Din mamma är så fet!');
					$comment2 = array('user_id' => 3, 'comment' => 'Din med! :(');
					$comments = array($comment1, $comment2);
					foreach ($comments as $comment)
					{
						$options['user_id'] = $comment['user_id'];
						$out .= message_top($options);
						$out .= '<p>' . $comment['comment'] . '</p>' . "\n";
						$out .= message_bottom();
					}
						
						$out .= '
					
					</ul>
				</div>
			';
		$out .= '</div>';
?>