<?php	
	trace('joel_hacker', __FILE__);
	die('S�h�r kanske det inte ska st�? D� kanske du kan skicka GB till Joel h�r p� siten?');
	include('/storage/www/standard.php');

	$query = 'SELECT category FROM user_photos WHERE deleted != 1';
	$result = mysql_query($query);
	
	while($data = mysql_fetch_assoc($result))
	{
		$categories[$data['category']]++;
	}
	
	foreach($categories AS $category => $count)
	{
		$query = 'UPDATE user_photo_categories SET photo_count = "' . $count . '" WHERE id = "' . $category . '" LIMIT 1';
		mysql_query($query);
	}

?>