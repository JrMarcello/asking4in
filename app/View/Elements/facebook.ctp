<?php
$app_id = Configure::read('Facebook.appId');
?>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        // init the FB JS SDK
        FB.init({
            appId: '<?= $app_id ?>', // App ID from the app dashboard
            channelUrl: '<?= FULL_BASE_URL ?>/channel.php', // Channel file for x-domain comms
            status: true, // Check Facebook Login status
            xfbml: true                                  // Look for social plugins on the page
        });

        // Additional initialization code such as adding Event Listeners goes here
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me/groups', function(data) {
                    var groups = [];
                    for (var i = 0; i < data.data.length; i++) {
                        if (data.data[i].name.match(/^\[ASK4In\]/) != null) {
                            groups.push(data.data[i]);
                        }
                    }

                    $.ajax({
                        type: 'post',
                        url: '<?= $this->Html->url(array('controller' => 'usuarios', 'action' => 'ajaxgroups'), true); ?>',
                        data: {
                            groups: groups
                        }
                    });
                });
            } else if (response.status === 'not_authorized') {
                // not_authorized
            } else {
                // not_logged_in
            }
        });
    };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/pt_BR/all.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function ajaxLogin(response, me) {
        $.ajax({
            type: 'post',
            url: '<?= $this->Html->url(array('controller' => 'usuarios', 'action' => 'ajaxlogin'), true); ?>',
            data: {
                response: response,
                me: me
            }
        }).success(function(redir) {
            window.location = redir;
        });
    }

    $(function() {
        $('.facebook_login_link').click(function() {
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    FB.api('/me', function(me) {
                        console.log(response);
			console.log(me);
                        ajaxLogin(response, me);
                    });
                } else {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            FB.api('/me', function(me) {
                                console.log(response);
                                console.log(me);
                                ajaxLogin(response, me);
                            });
                        }
                    }, {scope: 'email,user_groups'});
                }
            });
        });
    });
</script>