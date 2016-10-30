<script type="text/javascript">
	

</script>
<?php
echo $this->Form->create('User', array('novalidate' => true));
?>
<?php debug($this->request->data); ?>

<table border=1>

<?php
$count=0 ;
if(isset($this->request->data['User'])){
	foreach ($this->request->data['User'] as $key => $value) {
	// debug($key);

	$count+=1 ;
	$row=$count -1;
	debug($count);
	echo '<tr>';
	echo '<td>';
	// echo $this->Form->input('User.' $row '.email',array('type'=>'text'));
	echo $this->Form->input('User.'.$row.'.email',array('type'=>'text'));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('User.'.$row.'.username',array('type'=>'text'));
	echo '</td>';
	echo '<td>';
	echo $this->Form->button('行削除',array('type'=>'submit', 'name'=>$count));
	echo '</td>';
	
	echo '</tr>';
	

	} 

}

?>

<tr>
<?php ?>
<td colspan="3">
<?php
print_r($count);
echo $this->Form->hidden('Table.count',  array('value' => $count ));

	echo $this->Form->button('行追加', array('type'=>'submit','name'=>'buttonType','value'=>'addRow') );
?>
</td>
</tr>
</table>
<?php


echo $this->Form->end();

?>