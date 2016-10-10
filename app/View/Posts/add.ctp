<div class="users form">
<?php echo $this->Form->create('Task'); ?>
    <fieldset>
        <legend><?php echo __('Add Task'); ?></legend>
        <?php 
        echo $this->Form->input('content');
        echo $this->Form->input('status');
         ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
