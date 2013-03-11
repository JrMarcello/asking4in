<div class="perguntas form">
    <?php echo $this->Form->create('Pergunta', array('inputDefaults' => Configure::read('Form.Defaults'))); ?>
    <fieldset>
        <legend><?php echo __('Enviar Pergunta'); ?></legend>
        <?php
        echo $this->Form->input('conteudo', array('type' => 'textarea', 'label' => false));
        echo $this->Form->input('topico_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn')); ?>
</div>
