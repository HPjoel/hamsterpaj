<?php
	require('../include/core/common.php');
	
	ui_top();
	
	if(isset($_POST['username']) && strtolower($_POST['username']) == 'borttagen')
	{
		die('Men g� och l�gg dig j�vla tomte.');
	}
	
	if(login_checklogin())
	{
		echo 'Det kanske l�ter konstigt, men du m�ste <a href="/logout.php">logga ut</a> f�r att byta l�senord.';
	}
	else
	{
		if(isset($_POST['username'], $_POST['old_password'], $_POST['new_password'], $_POST['new_password_repeat']))
		{
			if($_POST['new_password'] == $_POST['new_password_repeat'])
			{
				if($_POST['new_password'] != $_POST['old_password'])
				{
					$query = 'SELECT id FROM login WHERE username = "' . $_POST['username'] . '" AND password_hash = "' . sha1($_POST['old_password'] . PASSWORD_SALT) . '" LIMIT 1';
					$result = mysql_query($query) or report_sql_error($query, __FILE__, __LINE__);
					if(mysql_num_rows($old_result) == 1)
					{
						$data = mysql_fetch_assoc($result);
						$query = 'UPDATE login SET password_hash = "", password = "' . hamsterpaj_password(utf8_decode($_POST['new_password'])) . '" WHERE id = ' . $data['is'];
						mysql_query($query) or report_sql_error($query, __FILE__, __LINE__);
					}
					else
					{
						echo 'Anv�ndaren hittades inte eller s� var <i>det gamla l�senordet<i> inte r�tt.';
					}
				}
				else
				{
					echo 'Du m�ste ange ett nytt l�senord. Och l�senordss�kerhet �r inte n�got fjolligt "kanel" som l�senord - det �r STORA och sm� bokst�ver blandat med s1ffr0r och krum�|ur�r.';
				}
			}
			else
			{
				echo 'L�senorden st�mmde inte �verens med varandra :/. F�rs�k igen.';
			}
		}
		else
		{
			// Fulkod? JAG BRYR MIG FAN INTE S�H�R DAGS!
			?>
			<h1>F�rnya l�senord</h1>
			<p>
				Du kan ha hamnat p� den h�r sidan av tv� sk�l:
				<ul>
					<li>Du f�rs�kte byta l�senord.</li>
					<li>Du hade ett l�senord krypterat med den gamla krypteringen.</li>
				</ul>
				
				Om det �r det senare orkar jag inte f�rklara, bara byt. Klockan �r 04:20 och d� skriver man inte sm� s�ta pedagogiska texter. Punkt. /Joel
			</p>
			
			<p>
				<form method="post">
					<input type="text" name="username" /><br />
					<input type="password" name="old_password" /><br />
					<input type="password" name="new_password" /><br />
					<input type="password" name="new_password_repeat" /><br />
					<input type="submit" value="Byt" /><br />
				</form>
			</p>
			<?php
		}
	}
	
	ui_bottom();
?>