<?php
	$locked_flags = array('mh', 'sysop', 'ov', 'admin', 'guldstjaerna', 'nord');

	require('../include/core/common.php');
	foreach($_GET AS $field => $value)
	{
		if(in_array(strtolower($field), $locked_flags) || in_array(strtolower($value), $locked_flags))
		{
			die('Jag vill k�pa n�t annat, typ en AK, handgranat, kevlar och hj�lm - sen �r det bra s�');
		}
		if($field == 'action')
		{
			continue;
		}
		if($value == 'disabled')
		{
			$query = 'DELETE FROM user_flags WHERE user = "' . $_SESSION['login']['id'] . '" AND flag IN(SELECT id FROM user_flags_list WHERE handle LIKE "' . $field . '%")';
			mysql_query($query) or die(report_sql_error($query, __FILE__, __LINE__));
		}
		elseif($value == 'enable') /* This is a checkbox */
		{
			$query = 'SELECT id FROM user_flags_list WHERE handle = "' . $field . '" LIMIT 1';
			$result = mysql_query($query) or die(report_sql_error($query, __FILE__, __LINE__));
			if(mysql_num_rows($result) == 1)
			{
				$data = mysql_fetch_assoc($result);
				$query = 'INSERT INTO user_flags (user, flag) VALUES("' . $_SESSION['login']['id'] . '", "' . $data['id'] . '")';
				mysql_query($query);
			}
		}
		else /* For radio buttons */
		{
			$query = 'DELETE FROM user_flags WHERE user = "' . $_SESSION['login']['id'] . '" AND flag IN(SELECT id FROM user_flags_list WHERE `group` = "' . $field . '")';
			
			mysql_query($query);
			
			$query = 'SELECT id FROM user_flags_list WHERE `group` = "' . $field . '" AND handle = "' . $value . '" LIMIT 1';
			$result = mysql_query($query);
			$data = mysql_fetch_assoc($result);
				
			$query = 'INSERT INTO user_flags (user, flag) VALUES("' . $_SESSION['login']['id'] . '",  "' . $data['id'] . '")';
			mysql_query($query);
		}
	}

	if($_GET['hacker'] == 'enable')
	{
		echo '<h1>Gratulerar</h1>' . "\n";
		echo '<p>Du har fulat iv�g data och f�tt scriptet att aktivera en flagga som inte g�r att v�lja. Just denna g�ngen �r luckan �ppnad bara f�r denna flaggan, tidigare gick det att f� en sysop-flagga p� samma s�tt.<br />Liknande luckor finns �verallt p� n�tet, det �r s�rskilt kul n�r det �r po�ng i en t�vling som skickas in ;)<br />Men du, g�r inget allt f�r dumt, sabotage �r olagligt.</p>' . "\n"; 
	}

?>