<div class="perguntas view">
    <h3><?php echo h($pergunta['Pergunta']['titulo']); ?></h3>
    <p><?php echo h($pergunta['Pergunta']['conteudo']); ?></p>
    <small class="muted"><?= h($pergunta['Usuario']['nome']); ?></small>
</div>

<div class="respostas form">
    <?php
    echo $this->Form->create('Resposta', array_merge(array('action' => 'add'), Configure::read('Form.Options')));
    echo $this->Form->input('conteudo', array('label' => 'Enviar Resposta', 'type' => 'textarea', 'class' => 'input-xxlarge'));
    echo $this->Form->input('pergunta_id', array('type' => 'hidden', 'value' => $pergunta['Pergunta']['id']));

    echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn'));
    ?>
</div>

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
