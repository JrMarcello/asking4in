window.fbAsyncInit = function() {
	FB.init({
		appId : '305293582907317', // App ID
		channelUrl : '//' + window.location.hostname + '/channel.html', // Channel File
		status : true, // check login status
		cookie : true, // enable cookies to allow the server to access the session
		xfbml : true
		// parse XFBML
	});
	
	FB.Event.subscribe('auth.logout', function() {
		window.location = "index.jsf";
	});
	
	FB.getLoginStatus(function(response) {
	     if (response.status == 'connected') {
	    	 
	    	 FB.api('/me', function(me) {
					if (me.name) {
						console.log('\n##### Me #####');
						console.log(me);
						$('#userName').text(me.name);
					}
				});
	     } 
	     
	   });
	
	/*FB.Event.subscribe('auth.statusChange', function(response) {
		if(response.authResponse){
			console.log('\n##### reponse #####');
			console.log(response);
			console.log('\n##### authResponse #####');
			console.log(response.authResponse);

			//var accessToken = response.authResponse.accessToken;
			//var userId = response.authResponse.userID;

			FB.api('/me', function(me) {
				if (me.name) {
					console.log('\n##### Me #####');
					console.log(me);
					$('#userName').text(me.name);
				}
			});

			FB.api('/me/groups', function(response) {
				if(response.data.length != 0){
					console.log('\n##### Groups #####');
					console.log('Qauntidade de grupos: ' + response.data.length);
					console.log(response);
					console.log('\n##### Nomes dos Groups #####');
					$.each(response.data, function(index, grupo){
						console.log(grupo.name);
						console.log(' -- [' + grupo.owner + ']');
						//$('#fb-grupos').text("<li>" + grupo.name + "</li>");
					});

				}else{
					console.log('esle');
					//$('#grupos').text("<li>Voce ainda nao curtiu nenhum filme no Facebook</li>");
				}
			});

			$('#noLogged').hide();
			$('#logged').show();
		} else {
			// App nao autorizada ou nao logado no Facebook
			$('#noLogged').show();
			$('#logged').hide();
		}
	});*/
};

/*function login() {
	FB.login(function(response) {}, {scope:'user_groups, friends_groups'});
};*/

function logout() {
	FB.logout(function(response) {
		console.log('O usuario foi deslogado!');
	});
	
}