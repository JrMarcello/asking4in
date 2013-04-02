<div class="pagination">
    <ul>
        <?= $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'span', 'escape' => false)); ?>
        <?= $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'span')); ?>
        <?= $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'span', 'escape' => false)); ?>
    </ul>
</div>