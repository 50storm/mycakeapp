<?php// debug($Bookmark);?>
<div class="users form">
<h2>view</h2>
<p><?php  echo h($Bookmark['Bookmark']['created']);?></p>
<p><?php  echo h($Bookmark['Bookmark']['tag']);?></p>
<p><a href="<?php echo h($Bookmark['Bookmark']['url']); ?>  target="_blank" ><?php echo h($Bookmark['Bookmark']['title']); ?></a></p>

<?php echo $this->Html->link('編集',array('controller'=>'Bookmarks','action'=>'edit',$Bookmark['Bookmark']['id'])); ?>
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