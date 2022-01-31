<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      schoolID		</th>
 		<th width="80px">
		      sch_code		</th>
 		<th width="80px">
		      sch_name		</th>
 		<th width="80px">
		      sch_remarks		</th>
 		<th width="80px">
		      sch_deanStatus		</th>
 		<th width="80px">
		      sch_dean		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->schoolID; ?>
		</td>
       		<td>
			<?php echo $row->sch_code; ?>
		</td>
       		<td>
			<?php echo $row->sch_name; ?>
		</td>
       		<td>
			<?php echo $row->sch_remarks; ?>
		</td>
       		<td>
			<?php echo $row->sch_deanStatus; ?>
		</td>
       		<td>
			<?php echo $row->sch_dean; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
