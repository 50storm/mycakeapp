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

<?php //下側 ?>
<div class="nav">
  <ul>
  <li>
    <?php 
    echo $this->Html->link( 'マイページ',  array('controller' => 'Mypages', 'action' => 'index'));
    ?>
  </li>
  <li>
    <?php 
    echo $this->Html->link( 'ブックマーク登録',  array('controller' => 'Bookmarks', 'action' => 'add'));
    ?>
  </li>
  <li>
    <?php
    echo $this->Html->link( 'Note登録',   array('controller' => 'Notes',  'action' => 'add'));
    ?>    
  </li>
  </ul>
</div>