<table>
<tr>
<th>Id</th>
<th>タスク内容</th>
<th>状態</th>
<th>作成日</th>
</tr>
<?php foreach ($Posts as $post) { ?>
<?php //debug ($post) ;	 ?>

<tr>
<td><?php echo h($post['Post']['id']) ?></td>
<td><?php echo h($post['Post']['title']) ?></td>
<td><?php echo h($post['Post']['body']) ?></td>
<td><?php echo h($post['Post']['created']) ?></td>
</tr>
<?php } ?>
</table>

