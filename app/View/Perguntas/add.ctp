<div class="perguntas form">
    <?php echo $this->Form->create('Pergunta'); ?>
    <fieldset>
        <legend><?php echo __('Postar Pergunta'); ?></legend>
        <?php
        echo $this->Form->input('conteudo');
        ?>
    </fieldset>
    <?php echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn')); ?>
</div>
