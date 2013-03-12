<div class="perguntas form">
    <?php echo $this->Form->create('Pergunta', Configure::read('Form.Options')); ?>
    <fieldset>
        <legend><?php echo __('Enviar Pergunta'); ?></legend>
        <?php
        echo $this->Form->input('titulo');
        echo $this->Form->input('conteudo', array('type' => 'textarea'));
        echo $this->Form->input('topico_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn btn-primary')); ?>
</div>
