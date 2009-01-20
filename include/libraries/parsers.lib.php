<?php
	// Note to open source developers: not a single one of these old, ugly, functions
	// conforms to the name- and formatting standards. This is because they're really
	// old - some from the very beginnig of Hamsterpaj 2.0!
	
	function url_secure_string($label)
	{
		//$label = strtolower(trim($label));
		$label = trim($label);
		
		$replace =     array(' ', '�',  '�',  '�',  '�',  '�',  '�',  '�', '�', '�', '�');
		$replacement = array('_', 'aa', 'aa', 'ae', 'ae', 'oe', 'oe', 'e', 'e', 'e', 'e');
		$label = str_replace($replace, $replacement, $label);
		
		// !!!
		$label = mb_strtolower($label);
		
		$handle = preg_replace('/([^[:lower:]\d_])/', '', $label);
	
		return $handle;
	}

	function fix_time($timestamp, $day_relative = true, $short_day = false)
	{
		if($short_day == 'true')
		{
			$days = array('S�n', 'M�n', 'Tis', 'Ons', 'Tors', 'Fre', 'L�r');
		}
		else
		{
			$days = array('S�ndag', 'M�ndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'L�rdag');
		}
		
		if(date('Y-m-d') == date("Y-m-d",$timestamp) && $day_relative == true)
		{
			return 'Idag ' . date('H:i', $timestamp);
		}
		elseif(date('Y-m-d', time()-86400) == date('Y-m-d',$timestamp) && $day_relative == true)
		{
			return 'Ig�r ' . date('H:i',$timestamp);
		}
		elseif($timestamp > time() - 86400*5)
		{
			return 'I ' . $days[date('w', $timestamp)] . 's ' . date('H:i', $timestamp);
		}
		elseif(date('Y', $timestamp) == date('Y'))
		{
			return $days[date('w', $timestamp)] . ' ' . date('j/n H:i',$timestamp);
		}
		else
		{
			return date('Y-m-d H:i', $timestamp);
		}
	}

	function cute_number($number) // Puts spaces in large numbers 222431242 to 222 431 242
	{
		return strrev(chunk_split(strrev($number), 3,' '));
	}
	
	function date_get_age($birthday) // Gets the age from birthday
	{
		$newbday = str_replace("-", "", $birthday);
		$age = floor((date("Ymd") - $newbday)/10000);
		
		if($newbday == 00000000 || $age == 0)
		{
			return false;
		}
		return $age;
	}
	
	function getSmiliesArray()
	{
			$smilies = array(
			array('[angel]', 'angel.gif'),
//			array('[clap]', 'clap.gif'),
			array('[eh]', 'eh.gif'),
			array('[stop]', 'stop.gif'),
//			array('[liar]', 'liar.gif'),
//			array('[no]', 'no.gif'),
//			array('[shhh]', 'shhh.gif'),
//			array('[fatty]', 'fatty.gif'),
//			array(':-X', 'gagged.gif'),
//			array('[whistle]', 'whistle.gif'),
			array(':(', 'sad.gif'),
			array(':@', 'angry.gif'),
			array('[dead]', 'dead.gif'),
			array(';)', 'semikolonparentes.gif'),
//			array('[killed]', 'killed.gif'),
			array(':D', 'kolonD.gif'),
//			array('XD', 'XD.gif'),
			array('O_o', 'O_o.gif'),
			array('[surprised]', 'surprised.gif'),
			array('[onetooth]', 'one_tooth.gif'),
			array('[sur]', 'sur.gif'),
			array('[glasses]', 'glasses.gif'),
			array('[cute]', 'cute.gif'),
//			array('o-)', 'cyklop.gif'),
//			array('[evil]', 'evil.gif'),
//				array(':emo:', 'emo.png'),
			array(':S', 'kolonS.gif'),
			array(':P', 'kolonP.gif'),
		);
		return $smilies;
	}
	
	function listSmilies($adress)
	{
		$smilies = getSmiliesArray();
		for($i = 0; $i < count($smilies); $i++)
		{
			$return .= '<img src="' . IMAGE_URL . '/images/smilies/' . $smilies[$i][1] . '" onclick="javascript: forum_insert_smilie(\'' . $smilies[$i][0] . '\');" alt="' . $smilies[$i][0] . '" /> ';
		}	
		return $return;
	}
	
	function setSmilies($text, $limit = 0)
	{
		if(substr($text, 0, 11) == '[nosmilies]')
		{
			return substr($text, 11);
		}
		
		$smilies = getSmiliesArray();
		$search = array();
		$replace = array();
		foreach($smilies as $index => $smilie)
		{
			$search[$index] = $smilie[0];
			$replace[$index] = '<img src="' . IMAGE_URL . '/images/smilies/' . $smilie[1] . '" alt="" />';
		}
		$text = str_replace($search, $replace, $text);
		return $text;
	}
	
	function unset_smilies($text)
	{
		$smilies = getSmiliesArray();
		
		// Must be done in reverse order (running 'a' --> 'b', 'b' --> 'c' on 'a' would result in 'c' with str_replace).
		$smilies = array_reverse($smilies);
		
		foreach($smilies as $smily)
		{
			$text = str_replace('<img src="' . IMAGE_URL . '/images/smilies/' . $smily[1] . '" alt="" />', $smily[0], $text);
		}
		
		return $text;
	}
	
	function content_check($text)
	{
		$text = strtolower(' ' . $text . ' '); //L�gg till lite mellanslag f�r att fixa buggen som g�r att filtren inte funkar om det saknas tecken innan den f�rbjudna teckenkombinationen.
		$banned_strings = array(
			'?r=',
			'msn-tools.de/?nr=', 
			'fragbite.com/?userID',
			'?refer=',
			'?ragga=',
			'?ref=',
			'gangstawar',
			'kingsofchaos',
			'referralid=',
			'sexy-lena.com',
			'emocore.se',
			'monstersgame.se',
			'alltgratis.se',
			'?pundare=',
			'rochas.se',
			'th0nd-elajt.no-ip.org',
			'albanau',
			'xth.nu',
			'gamblingcommunity.se',
			'oddsite',
			'adduser.php',
			'liferace',
			'studiotraffic.com',
			'gurk.php/',
			'?Tipsare',
			'clickltad.php?uid',
			'?tipsa',
			'tribalwars',
			'?referral=',
			'?ac=vid&',
			'index.php?ac=main',
			'charles.tk',
			'travian.se',
			'monstersgame',
			'nogg.se',
			'egenbild.se/?i',
			'c.php?uid=',
			'pimpland.se',
			'myminicity.com', 
			'neopets.com',
			'ref.php?user=',
			'?r=',
			'page.php?id=',
			'vinnpris.se', 
			'/skiten/lur.php?id=',
			'sexyemilie',
			'sexye.milie',
			'www.rivality.notlong.com',
			'rivality.com/'
			);
		foreach($banned_strings AS $banned)
		{
			if(strpos($text, $banned) == true)
			{
				return 'En f�rbjuden webbadress hittades i ditt meddelande. Var sn�ll och spamma inte h�r p� hamsterpaj.net';
			}
		}
		$kedjebrev_strings = array(
			'skicka du detta brev till tio personer s� kommer den du �lskar kyssa dig om sex dagar',
			'skicka till tio av dina v�nner',
			'om du skickar till 15 st kommer',
			'denna text m�ste du skicka till 10 personer',
			'denna text m�ste du skicka �t 10',
			'du den till 20 personer kommer',
			'om du skickar till 10 st kommer du att',
			'om du bryter den h�r kedjan kommer du att f� k�rleksproblem',
			'skickar det till minst 15 pers inom 10 min',
			'Mitt namn �r Caroline. Jag dog i en brand f�r 3 �r sedan',
			'You will get kissed on the nearest possible',
			'post this comment to at least 3 videos, you will die within 2 days',
			'a young girl named Jenn was walking down a river',
			'Hejsan jag �r en gubbe p� 61bast som heter G�sta',
			'Mitt arbete �r Cilit-BANG och jag strippar',
			'DONT READ THIS! In',
			'There are 20 angels in',
			'4 video comments',
			'this comment to at least',
			'Hamsterpaj V.I.P',
			'send this to five other videos',
			'this comment on 10 videos in the next hour'
			);
		foreach($kedjebrev_strings AS $kedjebrev)
		{
			if(strpos($text, $kedjebrev) == true)
			{
				return 'Kedjebrev �r f�rbjudna h�r p� hamsterpaj.net. De �r bara st�rande och tillf�r inget vettigt, det som st�r i dem �r inget annat �r ren l�gn.';
			}
		}
/*		
		$disturb_strings = array(
			'??????',
			'!!!!!!',
			'!?!?!?!',
			'.......',
			"\n\n\n\n\n\n",
			"\r\n\r\n\r\n\r\n\r\n\r\n\r\n"
			);
		foreach($disturb_strings AS $disturb)
		{
			if(strpos($text, $disturb) == true)
			{
				return 'Ta det lite lugnt med tecknen. Det blir bara jobbigt att l�sa med massa punkter, fr�getecken, utropstecken eller radbrytningar i rad.';
			}
		}
		*/
		if(strpos($text, 'sms') == true)
		{
			$sms_numbers = array(
				' 75520',
				' 72777',
				'0939-1040800'
				);
			foreach($sms_numbers AS $number)
			{
				if(strpos($text, $number) == true)
				{
					return 'Reklam f�r SMS-tj�nster �r f�rbjudet h�r p� hamsterpaj.net.';
				}
			}
		}
		
		if(strpos($text, 'wowglider') == true)
		{
			return 'Sluta tjata om detta f�rbannade wowglider. Ingen �r intresserad av scam, begrips!';
		}
		
		/* Block posts about "Aprils fool" on the 1st of april every year */
		/*
		$aprils_fool_blocks = array(
				'april', 
				'almanacka', 
				'aprilsk�mt',
				'almanackan',
				'almenacka',
				'almenackan',
				'a p r i l',
				'kolla datum',
				'a-p-r-i-l',
				'dagens datum',
				'a_p_r_i_l',
				'kolla vilken dag',
				'a.p.r.i.l',
				'4pril',
				'4pr1l'
			);
			foreach($aprils_fool_blocks AS $banned)
			{
				if(strpos($text, $banned) == true)
				{
					return 'Sn�lla, du kan v�l l�ta bli att avsl�ja f�r alla att det �r f�rsta april idag? Det f�rst�r liksom hela po�ngen...';
				}
			}
			*/
			
			/* Block everything that has to do with cool-guy or star-mia */
		
		$irritating_fools_blocks = array(
				'cool-guy', 
				'star-mia', 
				'cool_guy',
				'star_mia',
				'cool guy',
				'star mia',
			);
			foreach($irritating_fools_blocks AS $banned)
			{
				if(strpos($text, $banned) == true)
				{
					return 'Nu var det f�rdigdampat med allt star-mia och cool-guy chatter. Och f�rs�ker ni komma runt systemet med stlar-mia lr clool-guy s� kan ni v�nta er en fet bann. Puss p� dig med :) //Lef-91';
				}
			}
			

		return 1;
	}
	
	function duration($time)
	{
		// Note: This is a old function, which doesn't conform to the code standards at all.
		// Please, don't write such nasty code in the future!
		
		// calculate elapsed time (in seconds!)
		$diff = $time;
		$yearsDiff = floor($diff/60/60/24/365);
		$diff -= $yearsDiff*60*60*24*365;
	 	$daysDiff = floor($diff/60/60/24);
	 	$diff -= $daysDiff*60*60*24;
	 	$hrsDiff = floor($diff/60/60);
	 	$diff -= $hrsDiff*60*60;
	 	$minsDiff = floor($diff/60);
	 	$diff -= $minsDiff*60;
		$secsDiff = $diff;
		$doutput='';

		if ($yearsDiff != '0')
		{
			$doutput.=$yearsDiff.' �r ';
		}
		
    if ($daysDiff != '0')
    {
      $doutput.=$daysDiff;
      if ($daysDiff == '1')
      {
        $doutput.=' dag ';
      }
      else
      {
        $doutput.=' dagar ';
      }
    }

    if ($hrsDiff != '0')
    {
      $doutput.=$hrsDiff;
      if ($hrsDiff == '1')
      {
        $doutput.= ' timme ';
      }
      else
      {
        $doutput.=' timmar ';
      }
    }

		if ($minsDiff != '0')
		{
      $doutput.=$minsDiff;
      if ($minsDiff == '1')
      {
        $doutput.=' minut';
      }
      else
      {
        $doutput.=' minuter';
      }
		}

		if ($doutput == '')
		{
			$doutput = $secsDiff . ' sekund';
			if ($secsDiff != '1')
			{
				$doutput .= 'er';
			}
		}

    return $doutput;
  }
  
  function rt90_distance($x1, $y1, $x2, $y2)
	{
		$distance = sqrt(pow(($x2-$x1),2) + pow(($y2-$y1),2));
		return $distance;
	}

	function rt90_readable($distance)
	{
		if ($distance > 12000)
		{
			$distance = round($distance/10000,1) . ' mil';
		}
		else if ($distance > 1000)
		{
			$distance = round($distance/1000,1) . ' kilometer';
		}
		else
		{
			$distance = round($distance) . ' meter';
		}
		return $distance;
	}
	
	function shorten_string($string, $max_length, $options)
	{
		// This is probably not multibyte-safe. Used in the old forum I think (libraries/discussions.php)
		if(strlen($string) > $max_length)
		{
			return substr($string, 0, ($max_length - 3)) . '...';
		}
		else
		{
			return $string;
		}
	}
	
	function clickable_links($str)
	{
	
		// Lagra [img] i array
		$matches = array();
		
		$forum_image_regex = '#\[img](.*?)\[/img]#is';
		
		preg_match_all($forum_image_regex, $str, $matches);
		
		// Byta ut [img] mot  mark�r
		$str = preg_replace($forum_image_regex, '[IMAGE]', $str);
		// GAMMAL #((http://|https://|ftp://|www\.)(www\.)?)([a-zA-Z0-9������$\#_%?&-/=+@.:-~()]{4,})#eis
		// Leta upp l�nkar
			$str = preg_replace('#((http://|https://|ftp://|www\.)(www\.)?)([a-zA-Z0-9������$\#_%?&-/=+@.:-~()]{4,})(<|\s|\[/|)#eis', 
								"
								('$2' != 'http://' && '$2' != 'https://' && '$2' != 'ftp://') ? 
									'<a href=\"http://$1$4\" target=\"_blank\">' . 
										(strlen('$1$4') > 40 ? substr('$1$4', 0, (strlen('$1$4') / 2)) . '...' . substr('$1$4', -10) 
										: 
										'$1$4') 
									. '</a>' 
								: 
									'<a href=\"$1$4\" target=\"_blank\">' . 
										(strlen('$1$4') > 40 ? substr('$1$4', 0, (strlen('$1$4') / 2)) . '...' . substr('$1$4', -10) 
										: 
										'$1$4') 
									. '</a>'
								", 
							$str
							);
						
		// L�gga tillbaka [img]
		foreach($matches[0] as $row)
		{
			$pos = strpos($str, '[IMAGE]');
			$str = substr_replace($str, $row, $pos, strlen('[IMAGE]'));
		}
		
		return $str;
	}
?>