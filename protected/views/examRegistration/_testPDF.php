<?php if ($model !== null):?>
<table border="1">
    <thead>
	<tr>
                <th class="span-2">
		      module Code		
                </th>
		<th >
		      module Name	
                </th>
 		
 	</tr>
    </thead>
    <tbody>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row['moduleCode']; ?>
		</td>
       		<td>
			<?php echo $row['mod_name']; ?>
		</td>
       		
       	</tr>
    </tbody>
     <?php endforeach; ?>
</table>
<?php endif; ?>
