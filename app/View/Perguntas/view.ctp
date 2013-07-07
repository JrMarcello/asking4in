<div class="perguntas view">
    <h3><?php echo h($pergunta['Pergunta']['titulo']); ?></h3>
    <p><?php echo h($pergunta['Pergunta']['conteudo']); ?></p>
    <small class="muted"><?= h($pergunta['Usuario']['nome']); ?></small><br/><br/>
</div>

<?php if ($isLogged): ?>
    <div class="respostas form">
        <?php
        echo $this->Form->create('Resposta', array_merge(array('action' => 'add'), Configure::read('Form.Options')));
        echo $this->Form->input('conteudo', array('label' => 'Answer', 'type' => 'textarea', 'class' => 'input-xxlarge'));
        echo $this->Form->input('pergunta_id', array('type' => 'hidden', 'value' => $pergunta['Pergunta']['id']));

        $niveisExpertises = array('1' => 'Low', '2' => 'Medium', '3' => 'High');
        echo $this->Form->input('expertiseLevel', array('options' => $niveisExpertises, 'default' => '1'));

        echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn'));
        ?>
    </div>
<?php else: ?>
    <div class="clearfix">&nbsp;</div>
    <div class="alert alert-info span8">You need do login to answer this question</div>
    <div class="clearfix"></div>
<?php endif; ?>

<div class="related respostas">
    <h5><?php echo __('Answers'); ?></h5>
    <?php if (!empty($respostas)): ?>
        <?php
        foreach ($respostas as $resposta):
            //debug($resposta);
            ?>
            <div class="span8">
                <small class="muted"><?php echo $resposta['Usuario']['nome']; ?></small>
                <p class="conteudo_resposta"><?php echo $resposta['Resposta']['conteudo']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
