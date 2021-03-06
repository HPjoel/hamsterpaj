jQuery.fn.extend({
 	isHas: function(selector) {
		var ret = false;
		var chk = $(selector);
		this.each(function() {
			if ( ! ret ) {
				var el = this;
					do {
					 	if ( chk.index(el) !== -1 )
					 		ret = true;				
					} while ( el = el.parentNode );
			}
		});
		return ret;
	},
	
	business_card: function() {
	 	var html = '<div id="ui_business_card">' +
	 					'<a id="ui_business_card_close" href="#">x</a>' +
		 				'<a href="/foo/Erkie"><img class="ui_avatar" src="http://images.hamsterpaj.net/images/users/thumb/557316.jpg" alt="" /></a>' +
		 				'<h1><img src="http://images.hamsterpaj.net/famfamfam_icons/status_offline.png" /> <a href="#">Johan</a></h1>' +
		 				'<div id="ui_business_card_about">' +
		 					'<p>P12 fr&aring;n Flen</p>' +
		 					'<p>Adda min MSN: kat_ turk_ med_ liten_dase @hotmale. com</p>' +
		 					'<p>' +
								'<img src="http://images.hamsterpaj.net/user_flags/computer_geek.png" alt="Datan�rd" title="Datan�rd" id="30">' +
								'<img src="http://images.hamsterpaj.net/user_flags/soccer.png" alt="Fotbollsspelare" title="Fotbollsspelare" id="38">' +
								'<img src="http://images.hamsterpaj.net/user_flags/swimming.png" alt="Simmare" title="Simmare" id="48">' +
								'<img src="http://images.hamsterpaj.net/user_flags/sweden.png" alt="Mitt land: Sverige" title="Mitt land: Sverige" id="74">' +
								'<img src="http://images.hamsterpaj.net/user_flags/teachers_pet.png" alt="Pluggh�st" title="Pluggh�st" id="78">' +
								'<img src="http://images.hamsterpaj.net/user_flags/gamer.png" alt="Gamer" title="Gamer" id="83">' +
							'</p>' +
		 				'</div>' +
		 				'<div id="ui_business_card_guestbook">' +
		 					'<form action="#" method="post">' +
		 						'<textarea rows="3"></textarea>' +
		 						'<input type="submit" value="Skicka g&auml;stboksinl&auml;gg" />' +
		 					'</form>' +
		 				'</div>' +
		 			'</div>';
		var card = $(html).hide().appendTo(document.body);
		var close = $('#ui_business_card_close');
		var avatar = $('#ui_business_card_avatar');
		
		close.click(function() {
		 	card.fadeOut();
			return false;
		});
		
		this.click(function(e) {
			var target = $(e.target);
			if ( target.isHas('.ui_business_card') === true ) {
				// we caught it!
				
				var w = $(window);
				card.css({
					'left': ($('#ui_content').width() / 2) - (card.width() / 2),
				 	'top': w.scrollTop() + (w.height() / 2) - (card.height() / 2)
				}).fadeIn(function() {
					// center avatar
					var height = card.height() - parseInt(card.css('padding-top'), 10) - parseInt(card.css('padding-left'), 10);
					avatar.height(height);
				});
				
				var d = $(document);
				d.bind('click.cardclose', function(ev) {
				 	var targ = $(ev.target);
				 	if ( ! targ.isHas('.ui_business_card, #ui_business_card') ) {
						d.unbind('click.cardclose');
						card.fadeOut();
					}
				});
				
				return false;
			}
		});
	}
});

$(document).ready(function() {
	$(document).business_card();
});