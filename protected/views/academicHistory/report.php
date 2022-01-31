
		<style type="text/css">
			@import "<?php echo Yii::app()->request->baseUrl; ?>/media/css/dataTables.bootstrap.css";
		</style>
		<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/media/js/TableTools.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/media/js/dataTables.bootstrap.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				$('#example').dataTable( {
					"sDom": "<'row-fluid'<'span6'T><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
					"oTableTools": {
						"sSwfPath": "<?php echo Yii::app()->request->baseUrl; ?>/media/swf/copy_csv_xls_pdf.swf"
					},
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource":'schoolajaxdata',
				} );
			} );
		</script>
	
                
<div id="container">
    <div id="demo">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                <thead>
                        <tr class="myttt">
                                <th>Code</th>
                                <th>Name</th>
                                <th>Remarks</th>
                        </tr>
                </thead>

                <tbody>
                        <tr>
                                <td colspan="3" class="dataTables_empty">Loading data from server</td>
                        </tr>
                </tbody>
        </table>
    </div>
    
</div>
	