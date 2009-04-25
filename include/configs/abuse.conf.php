<?php
	/* ###############################################################
				When adding a new abuse_type you also have to add it
				in the database. 
				Table:	Abuse
				Column: abuse_type
		 ############################################################### */

	$abuse_headers['forum_post'] = 'Anmäl ett inlägg i forumet';
	$abuse_info['forum_post'] = '<b>Trådar låses bara om de spårat ur!</b>';

	$abuse_headers['guestbook_entry'] = 'Rapportera ett gästboksinlägg';
	$abuse_info['guestbook_entry'] = '<p>Anmäl inte dina klasskompisar eller personer du känner IRL. Använd blockeringsfunktionen och prata med dina föräldrar istället!</p>';

	$abuse_headers['photo'] = 'Anmäl en bild i fotoalbumet';
	$abuse_info['photo'] = '<p>Bilder som är pornografiska, rasistiska eller på något annat sätt upplevs som stötande plockas bort.</p>';
	
	$abuse_headers['photo_comment'] = 'Anmäl en kommentar till en bild i fotobloggen';
	$abuse_info['photo_comment'] = '<p>Du kan själv ta bort kommentarer, men om du tycker att det som skrivits bryter mot några regler så är det bra att rapportera, så kanske vi tom slänger ut användaren.</p>';

	$abuse_alternatives_by_type['forum_post'] = array('hmf', 'off_topic', 'hot', 'kedjebrev', 'spam', 'posthunt');
	$abuse_alternatives_by_type['guestbook_entry'] = array('hmf', 'hot', 'kedjebrev','cammsn');
	$abuse_alternatives_by_type['photo'] = array('offensive', 'nudity');
	$abuse_alternatives_by_type['photo_comment'] = array('hmf', 'hot', 'kedjebrev', 'spam', 'posthunt');
	
	$abuse_types['hmf']['label'] = 'Hets mot folkgrupp';
	$abuse_types['hmf']['description'] = 'Brottsbalken, 16 kapitlet, Om brott mot allmän ordning, paragraf 8:<br />Den som i uttalande eller i annat meddelande som sprids hotar eller uttrycker missaktning för folkgrupp eller annan sådan grupp av personer med anspelning på ras, hudfärg, nationellt eller etniskt ursprung, trosbekännelse eller sexuell läggning, döms för hets mot folkgrupp';

	$abuse_types['off_topic']['label'] = 'Off topic';
	$abuse_types['off_topic']['description'] = 'Har någon skrivit ett oseriöst inlägg eller klivit iväg ordentligt från ämnet i en seriös forumtråd så väljer du det här alternativet.';

	$abuse_types['hot']['label'] = 'Olaga hot';
	$abuse_types['hot']['description'] = 'Om någon hotar med att misshandla eller på annat sätt skada dig skall du självklart anmäla detta! Om du känner personen är det många gånger mer effektivt att prata med dina föräldrar, om du inte flyttat hemifrån än, det vill säga.';

	$abuse_types['kedjebrev']['label'] = 'Kedjebrev';
	$abuse_types['kedjebrev']['description'] = 'Kedjebrev innhåller uppmaningar om att skicka vidare texten, ofta med hot om otur i kärlek eller flickor utan ögon som skall besöka läsaren på natten. Vi har spärrat de flesta kedjebrev, men tar tacksamt emot rapporter om nya varianter.';	

	$abuse_types['ref']['label'] = 'Reklam- eller tipslänk';
	$abuse_types['ref']['description'] = '';
	
	$abuse_types['spam']['label'] = 'Spam';
	$abuse_types['spam']['description'] = 'Spam är nonsenstext eller annat skräp som inte hör hemma på Hamsterpaj.';
	
	$abuse_types['posthunt']['label'] = 'Posthunting';
	$abuse_types['posthunt']['description'] = 'Posthunting är när någon vill få upp sin inläggsräknare lite, och skriver en massa skräp i förumet. Jobbigt, och inte tillåtet på Hamsterpaj.';

	$abuse_types['cammsn']['label'] = 'Cam/msn förfrågan';
	$abuse_types['cammsn']['description'] = 'Har du P12-skölden aktiverad i gästboken, och frågar folk fortfarande om msn eller cam?';

	$abuse_types['offensive']['label'] = 'Stötande bilder';
	$abuse_types['offensive']['description'] = 'Rasistiska, nazistiska eller på något annat sätt upplevs som kränkande. Om någon här på Hamsterpaj är drabbad så glöm inte att ange dess användarnamn.';
	
	$abuse_types['nudity']['label'] = 'Nakenbilder';
	$abuse_types['nudity']['description'] = 'Bilder som är lite för lättklädda.';
?>