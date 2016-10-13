
<?php
//debug($Note);
?>

<div class="users form">
    <fieldset>
        <legend><?php echo __('ノートを表示しています。'); ?></legend>
        <dl>
        	<dt>作成日</dt>
        	<dd><?php echo h($Note['Note']['created']);?></dd>
        	<dt>更新日</dt>
        	<dd><?php echo h($Note['Note']['modified']);?></dd>
        	
        	<dt>タイトル</dt>
        	<dd><?php echo h($Note['Note']['title']);?></dd>
        	<dt>ノート</dt>
        	<dd><?php echo nl2br(h($Note['Note']['body']));?></dd>
        </dl>
    </fieldset>
<div>

<?php 
  echo $this->Html->link( 'Note編集',    
        array('controller' => 'Notes', 
              'action' => 'edit',
              $Note['Note']['id'])
        );
?>
<?php 
  echo $this->Form->postlink(__('ノート削除'),array('controller'=>'Notes' ,'action'=>'delete',$Note['Note']['id']),array('confirm'=> '本当に削除しますか？')); 
?>
d</div>
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
