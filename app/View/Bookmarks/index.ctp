<table>
<tr>
<th>Id</th>
<th>bookmark</th>
<th>Title</th>
<th>tag</th>
<th>created_at</th>
</tr>
<?php foreach ($Bookmarks as $bookmark) { ?>
<?php debug ($bookmark) ;	 ?>

<tr>
<td><?php echo h($bookmark['Bookmark']['id']); ?></td>
<td><a href="<?php echo h($bookmark['Bookmark']['url']); ?>" target="_blank" ><?php echo h($bookmark['Bookmark']['title']); ?></a></td>
<td><?php echo h($bookmark['Bookmark']['title']); ?></td>
<td><?php echo h($bookmark['Bookmark']['tag']); ?></td>
<td><?php echo h($bookmark['Bookmark']['created_at']); ?></td>
</tr>
<?php } ?>
</table>

