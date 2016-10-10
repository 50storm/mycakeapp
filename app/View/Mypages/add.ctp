<h1>MyPage</h1>
<div>
<?php 
//例
/*
echo $this->Html->link( 'クリックしてね',    
        array('controller' => 'コントローラー名', 
              'action' => 'アクション名', 
              渡したいパラメーター),

       array('class'=>'link_style'),    
      "本当にクリックしていいの");
*/
echo $this->Html->link( 'ブックマーク登録',    
        array('controller' => 'Bookmarks', 
              'action' => 'add')
);
?>
</div>
<hr/>
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

