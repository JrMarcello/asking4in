<div class="respostas form">
    <?php echo $this->Form->create('Resposta'); ?>
    <fieldset>
        <legend><?php echo __('Add answer'); ?></legend>
        <?php
        echo $this->Form->input('conteudo');
        echo $this->Form->input('score');
        echo $this->Form->input('pergunta_id');
        echo $this->Form->input('usuario_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
