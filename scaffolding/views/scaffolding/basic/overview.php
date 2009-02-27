<table border="1">
<tr>
<?foreach($fieldnames as $fieldname):?>
<th><?=$fieldname;?></th>
<?endforeach;?>
</tr>
<?foreach($data as $row):?>
<tr>
<?foreach($row as $cell):?><td><?=$cell->render();?></td><?endforeach;?>
</tr>
<?endforeach;?>
</table>
