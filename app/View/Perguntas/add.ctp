<div class="perguntas form">
    <?php echo $this->Form->create('Pergunta', Configure::read('Form.Options')); ?>
    <fieldset>
        <legend><?php echo __('Ask'); ?></legend>
        <?php
        echo $this->Form->input('titulo', array('label' => 'Title'));
        echo $this->Form->input('conteudo', array('type' => 'textarea', 'label' => 'Content'));
        echo $this->Form->input('topico_id', array('label' => 'Topic'));
        /*$expertises = array('1' => 'Baixo', '2' => 'Médio', '3' => 'Alto');
        echo $this->Form->input('expertise', 
                array('options' => $expertises, 'default' => '1'));*/
        ?>
    </fieldset>
    <?php echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn btn-primary addQuestion')); ?>
</div>
