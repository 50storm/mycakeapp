<table>
<tr>
<th>Id</th>
<th>Title</th>
<th>Body</th>
<th></th>
<th></th>

</tr>
<?php foreach ($Notes as $note) { ?>
<?php // debug ($note) ;	 ?>

<tr>
<td><?php echo h($note['Note']['id']); ?></td>
<td><?php echo h($note['Note']['title']); ?></td>
<td><?php echo nl2br(h($note['Note']['body'])); ?></td>
<td>
	<?php echo $this->Html->link('表示',array('controller'=>'Notes' ,'action'=>'view',$note['Note']['id'])); ?>
</td>
<td>
	<?php echo $this->Html->link('編集',array('controller'=>'Notes' ,'action'=>'edit',$note['Note']['id'])); ?>
</td>
</tr>
<?php } ?>
</table>

<div>
<?php
echo $this->Html->link( 'Note登録',    
        array('controller' => 'Notes', 
              'action' => 'add'));
?>
</div>