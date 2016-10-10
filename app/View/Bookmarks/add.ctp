<div class="users form">
<?php echo $this->Form->create('Bookmark'); ?>
    <fieldset>
        <legend><?php echo __('Add Bookmark'); ?></legend>
        <?php 
        echo $this->Form->input('url');
        echo $this->Form->input('title');
        echo $this->Form->input('tag');
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
