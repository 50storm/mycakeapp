<?php
//debug($Notes);
?>
<?php echo $this->Html->css('mypage.css'); ?>
<?php
// echo $this->My->sysName();
?>
<div class="nav">
  <ul>
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
<div class="note">
  <?php if(empty($Notes)): ?>
      <?php echo "ノートはありません。"; ?>
  <?php else: ?>
      <h3>ノート</h3>
      <table>
      <?php //debug($Notes); ?>
      <tr>
        <th>
        <span>作成日</span>
        </th>
        <th>
        <span>修正日</span>
        </th>
        <th>
        <span>タイトル</span>
        </th>
        <th>
         <span>内容</span>
        </th>
        <th>
        </th>
        <th>
        </th>
      </tr>
      <?php foreach($Notes as $note ): ?>
        <tr>
          <td><?php echo $note['Note']['created']; ?></td>
          <td><?php echo $note['Note']['modified']; ?></td> 
          <td><?php echo $note['Note']['title']; ?></td>
          <td><?php echo nl2br(h($note['Note']['body'])); ?></td>
          <td>
            <?php echo $this->Html->link(__('表示'),array('controller'=>'Notes' ,'action'=>'view',$note['Note']['id'])); ?>
          </td>
          <td>
             <?php echo $this->Html->link(__('編集'),array('controller'=>'Notes' ,'action'=>'edit',$note['Note']['id'])); ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </table>

      
  <?php endif; ?>
</div>

<div class="tag" >
      <h3>Bookmarkタグ</h3>
      <ul>
      <?php foreach($tags as $tag ): ?>
      <li>
      	<?php
      	//GET
      		echo $this->Html->link($tag['Bookmark']['tag'], array(
  		                            'controller' => 'Mypages',
  		                            'action' => 'index',
  		                            'param_tag' => $tag['Bookmark']['tag']));
  	   ?>
      </li>
      <?php endforeach;?>
      </ul>
</div>
<!--
<div style="border: medium solid black;float:left;width:10px;height:300px;">
</div>
-->
<div  class="bookmark-tag" >
<?php if (!empty($bookmarks_bytag)): ?>
      <h3>Bookmark</h3>
      </ul>
      <!-- Bookmarks selected by  tag -->
      <h2> Tag: <?php echo $bookmarks_bytag[0]['Bookmark']['tag']; ?> </h2>
      <table>
      <tr>
      <th>Id</th>
      <th>bookmark</th>
      </tr>
      <?php foreach ($bookmarks_bytag as $bookmark): ?>
      <?php // debug ($bookmark) ;	 ?>

      <tr>
      <td><?php echo h($bookmark['Bookmark']['id']); ?></td>
      <td>
          <a href="<?php echo h($bookmark['Bookmark']['url']); ?>" target="_blank" ><?php echo h($bookmark['Bookmark']['title']); ?></a>
      </td>
      </tr>
      <?php endforeach; ?>
      </table>
<?php endif;?>
</div>
<div class="bookmark">
      <h3>Bookmark</h3>
      <table  style="width:500px;">
      <tr>
      <!-- <th>Id</th> -->
      <!-- <th>bookmark</th> -->
      <!-- <th></th> -->
      <th><?php echo $this->Paginator->sort('title','並び替え ') ?></th>
<!--
      <th></th>
 -->
      <th></th>
      <th></th>
    
      </tr>
      <?php foreach ($Bookmarks as $bookmark) { ?>
      <?php // debug ($bookmark) ;	 ?>
      <tr>
      <!--
      <td><?php echo h($bookmark['Bookmark']['id']); ?></td>
      -->
      <?php 
        $title = $bookmark['Bookmark']['title'] =='' ? h($bookmark['Bookmark']['url']): h($bookmark['Bookmark']['title']); 
      ?>
      <td><a href="<?php echo h($bookmark['Bookmark']['url']); ?>" target="_blank" ><?php echo $title;?></a>
      </td>
<!--
      <td>
        <?php echo $this->Html->link(__('表示'),array('controller'=>'Bookmarks' ,'action'=>'view',$bookmark['Bookmark']['id'])); ?>
      </td>
-->
      <td>
      	<?php echo $this->Html->link(__('編集'),array('controller'=>'Bookmarks' ,'action'=>'edit',$bookmark['Bookmark']['id'])); ?>
      </td>
      <td>
        <?php echo $this->Form->postlink(__('削除'),array('controller'=>'Bookmarks' ,'action'=>'delete',$bookmark['Bookmark']['id']),array('confirm'=> '本当に削除しますか？')); ?>
      </td>
      
      </tr>
      <?php } ?>
      </table>
      <?php
      echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
      echo $this->Paginator->numbers(array('separator' => ''));
      echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
      ?>
</div>

<?php
 //例
    /*
    echo $this->Html->link( 'クリックしてね',    
            array('controller' => 'コントローラー名', 'action' => 'アクション名',  渡したいパラメーター),
            array('class'=>'link_style'), "本当にクリックしていいの");
    */
?>