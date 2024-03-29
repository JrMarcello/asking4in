<?php $url = Router::url(array('controller' => 'perguntas', 'action' => 'typeahead')) ?>
<script>
    $(document).ready(function (){
        $('#PerguntaSearch').typeahead({
            source: function (query, process) {
                return $.get('<?php echo $url ?>', { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    });
</script>

<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <?php echo $this->Html->link('Ask4in', '/', array('class' => 'brand')); ?>

        <div class="nav-collapse collapse">
            <?php if ($isLogged): ?>
            <ul class="nav">
                <?php
                if ($this->request->controller == 'perguntas' && $this->request->action == 'add'):
                    $liClass = 'class="active"';
                else:
                    $liClass = '';
                endif;
                ?>
                <li <?php echo $liClass; ?>><?php echo $this->Html->link(__('Ask'), 
                        array('controller' => 'perguntas', 'action' => 'add'), array('class' => 'ask_btn')); ?></li>
            </ul>
            <?php endif; ?>
            
            <?php echo $this->Form->create('Pergunta',
                    array('class' => 'form-search navbar-search', 'action' => 'index', 'type' => 'get')); ?>
            <div class="input-append">
                <?php
                echo $this->Form->input('search',
                    array(
                        'type' => 'search',
                        'class' => 'search-query',
                        'div' => false,
                        'label' => false,
                        'placeholder' => 'Search',
                        'value' => isset($search) ? $search : '',
                        'autocomplete' => 'off',
                        'data-provide' => 'typeahead',
                    )
                );

                echo $this->Form->button('<i class="icon-search"></i>',
                    array('class' => 'btn', 'type' => 'submit'), array('escape' => false));
                ?>
            </div>
            <?php echo $this->Form->end(); ?>

            <p class="navbar-text pull-right">
                <?php if (!$isLogged): ?>
                <a href="#" class="facebook_login_link"><img src="img/Login.png" style="height: 26px"/></a>
                <?php else: ?>
                <span style="margin-right: 25px"><span style="font-size: 15px"><?php echo __('Hi') ?></span>,
                        <strong><?php echo AuthComponent::user('nome'); ?></strong></span>
                   
                        <?= $this->Html->link($this->Html->image('Logout.png',
                           array('style' => 'height: 26px', 'alt' => 'logout')), 
                           array('controller' => 'usuarios', 'action' => 'logout'),
                           array('escape' => false)); ?>
                <?php endif; ?>
            </p>
        </div>
    </div>
</div>