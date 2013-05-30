<div class="perguntas view">
    <h3><?php echo h($pergunta['Pergunta']['titulo']); ?></h3>
    <p><?php echo h($pergunta['Pergunta']['conteudo']); ?></p>
    <small class="muted"><?= h($pergunta['Usuario']['nome']); ?></small>
</div>

<?php if ($isLogged): ?>
<div class="respostas form">
    <?php
    echo $this->Form->create('Resposta', array_merge(array('action' => 'add'), Configure::read('Form.Options')));
    echo $this->Form->input('Resposta.conteudo', array(
        'label' => 'Enviar Resposta',
        'type' => 'textarea',
        'class' => 'input-xxlarge'
    ));
    echo $this->Form->input('Resposta.pergunta_id', array(
        'type' => 'hidden',
        'value' => $pergunta['Pergunta']['id']
    ));
    
    
    if (!empty($expertise)) {
        echo $this->Form->input('Expertise.id', array('type' => 'hidden'));
        echo $this->Form->input('Expertise.nivel', array(
            'label' => 'Expertise neste Tópico',
            'options' => array('baixo', 'medio', 'alto'),
            'value' => $expertise['Expertise']['nivel']
        ));
    }
    else {
        echo $this->Form->input('Expertise.nivel', array(
            'label' => 'Expertise neste Tópico',
            'options' => array('baixo' => 'baixo', 'medio' => 'medio', 'alto' => 'alto')
        ));
    }
    
    echo $this->Form->input('Expertise.usuario_id', array('type' => 'hidden', 'value' => AuthComponent::user('id')));
    echo $this->Form->input('Expertise.topico_id', array('type' => 'hidden', 'value' => $pergunta['Topico']['id']));
    
    
    echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn'));
    ?>
</div>
<?php else: ?>
<div class="clearfix">&nbsp;</div>
<div class="alert alert-info span8">Faça login para enviar sua resposta</div>
<div class="clearfix"></div>
<?php endif; ?>

<div class="related respostas">
    <h5><?php echo __('Respostas'); ?></h5>
    <?php if (!empty($respostas)): ?>
        <?php
        foreach ($respostas as $resposta):
            ?>
            <div class="span8">
                <small class="muted"><?php echo $resposta['Usuario']['nome']; ?></small>
                <p class="conteudo_resposta"><?php echo $resposta['Resposta']['conteudo']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
