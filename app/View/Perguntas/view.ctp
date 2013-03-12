<div class="perguntas view">
    <h3><?php echo h($pergunta['Pergunta']['titulo']); ?></h3>
    <p><?php echo h($pergunta['Pergunta']['conteudo']); ?></p>
</div>

<div class="respostas form">
    <?php
    echo $this->Form->create('Resposta', array_merge(array('action' => 'add'), Configure::read('Form.Options')));
    echo $this->Form->input('conteudo', array('label' => 'Enviar Resposta', 'type' => 'textarea'));
    echo $this->Form->input('pergunta_id', array('type' => 'hidden', 'value' => $pergunta['Pergunta']['id']));

    echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn'));
    ?>
</div>

<div class="related">
    <h5><?php echo __('Respostas'); ?></h5>
    <?php if (!empty($pergunta['Resposta'])): ?>
        <dl>
            <?php
            foreach ($pergunta['Resposta'] as $resposta):
                ?>
                <fieldset>
                    <dt><?php echo $resposta['Usuario']['nome']; ?></dt>
                    <dd><?php echo $resposta['conteudo']; ?></dd>
                </fieldset>
            <?php endforeach; ?>
        </dl>
    <?php endif; ?>
</div>
