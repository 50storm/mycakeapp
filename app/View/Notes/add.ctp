<div class="users form">
<?php echo $this->Form->create('Note'); ?>
    <fieldset>
        <legend><?php echo __('Add Note'); ?></legend>
        <?php 
        echo $this->Form->input('title');
        echo $this->Form->input('body');
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
