<?php
include 'head.php';
?>
<form action="basvuruyu_kaydet.php" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-xs-6 text-center">
			<button class="btn btn-primary" type="submit">Başvuruyu Kaydet</button>
		</div>
		<div class="col-xs-6 text-center">
		<label for="file_input" id="file_label" class="btn btn-primary">Resim Seç</label>
		<input type="file" name="resim" accept="image/*" id="file_input" style="visibility:hidden;">
		<script type="text/javascript">
		$('#file_input').on("change", function(){ changeLabel(); });
		function changeLabel()
		{
			var filename = $('#file_input').val();
		        if (filename.substring(3,11) == 'fakepath') {
		            filename = filename.substring(12);
		        }
			$('#file_label').text(filename);
		}
		</script>
		</div>
	</div>
	<?php 
	include 'basvuru_formu.php';
	?>
</form>
</div>
</body>
</html>