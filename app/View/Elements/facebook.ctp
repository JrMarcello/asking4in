<?php
$app_id = Configure::read('Facebook.appId');
?>
<div id="fb-root"></div>
<script src="https://connect.facebook.net/pt_BR/all.js"></script>
<!--<script src="https://connect.facebook.net/pt_BR/all/debug.js"></script>-->
<script>
    window.fbAsyncInit = function() {
        // init the FB JS SDK
        fbInit(); 

        // Additional initialization code such as adding Event Listeners goes here
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me/groups', function(data) {
                    var groups = [];
                    for (var i = 0; i < data.data.length; i++) {
                        if (data.data[i].name.match(/^\[ASK4In\]/) != null) {
                            groups.push(data.data[i]);
                            console.log(data.data[i]);
                        }
                    }
                    //console.log(groups);
                    $.ajax({
                        type: 'post',
                        url: '<?= $this->Html->url(array('controller' => 'usuarios', 'action' => 'ajaxgroups'), true); ?>',
                        data: {
                            groups: groups
                        }
                    });
                });
            } else if (response.status === 'not_authorized') {
                FB.login(function(response) {}, 
                    {scope: 'email, user_groups, publish_stream, read_stream'});
            } else {
               /*FB.login(function(response) {}, 
                    {scope: 'email, user_groups, publish_stream, read_stream'});*/
            }
        });
    };
    
    // Load the SDK asynchronously
    /*(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/pt_BR/all.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));*/
    
    // init the FB JS SDK
    function fbInit(){
        FB.init({
            appId: '<?= $app_id ?>', // App ID from the app dashboard
            channelUrl: '<?= FULL_BASE_URL ?>/channel.php', // Channel file for x-domain comms
            status: true, // Check Facebook Login status
            xfbml: true                                  // Look for social plugins on the page
        });
    }
    
    //
    function postQuestionInGroup(grupoID, perguntaID, topico, titulo, conteudo){
        var mensagem = '#' + topico + '\n' + conteudo;
        
        fbInit(); 
        FB.getLoginStatus(function(response) {
               if (response.status === 'connected') {
                   FB.api('/' + grupoID + '/feed', 'post', { message: mensagem, link: 'http://localhost/ask4in/', name: titulo }, 
                        function(response) {
                            if (!response || response.error) {
                                //alert('Post error: ' + response.error.message);
                                console.log(response.error.message);
                            } else {
                                //alert('Post ID: ' + response.id);
                                $.ajax({
                                    type: 'post',
                                    url: '<?= $this->Html->url(array('controller' => 'perguntas', 'action' => 'updatefbid'), true); ?>',
                                    data: {
                                        fbid: response.id,
                                        pgid: perguntaID
                                    }
                                });
                            }
                        }
                    );
               }else if (response.status === 'not_authorized') {
                FB.login(function(response) {}, 
                    {scope: 'email, user_groups, publish_stream, read_stream'});
            }
        });
    }
        
    //
    function doCommentInPost(postID, respID, comentario){      
        fbInit(); 
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/' + postID + '/comments', 'post', { message: comentario }, 
                    function(response) {
                        if (!response || response.error) {
                            //alert('Comment error: ' + response.error.message);
                            console.log('Comment error: ' + response.error.message);
                        } else {
                            //alert('Comment ID: ' + response.id);
                            $.ajax({
                                    type: 'post',
                                    url: '<?= $this->Html->url(array('controller' => 'respostas', 'action' => 'updatefbid'), true); ?>',
                                    data: {
                                        fbid: response.id,
                                        respid: respID
                                    }
                                });
                        }
                    }
                );
            }else if (response.status === 'not_authorized') {
                FB.login(function(response) {}, 
                    {scope: 'email, user_groups, publish_stream, read_stream'});
            }
        });
    }
    
    function getQuantidadeLikes(){
        //alert('Num Likes');
        $.ajax({
            type: 'post',
            url: '<?= $this->Html->url(array('controller' => 'perguntas', 'action' => 'setnumlikes'), true); ?>',
            data: {
                fblikes: 10
            }
        });
    }
    
    //
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
    };
    
    //
    $(function() {
        $('.facebook_login_link').click(function() {
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    FB.api('/me', function(me) {
                        //console.log(response);
			//console.log(me);
                        //alert(me.name);
                        ajaxLogin(response, me);
                    });
                } else {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            FB.api('/me', function(me) {
                                //console.log(response);
                                //console.log(me);
                                ajaxLogin(response, me);
                            });
                        }
                    }, {scope: 'email,user_groups,publish_stream,read_stream'});
                }
            });
        });
    });
    
</script>