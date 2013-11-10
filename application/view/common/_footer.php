					<script>
						$("#btn-update").on('click', function(){
							//$('input[type=file]').click();
							$( "#update-avarta" ).toggle('fast');
						});

						$('#btn-upload-avarta').click(function(){
							if($('#avarta_file').val() == "")
					        {
					        	alert("no file selected!");
					        	return false;
					        }

							var formData = new FormData($('#upload_avarta')[0]);

							$.ajax({
								url: "<?php echo BASE_URL; ?>/user/update_avarta",
								type: 'POST',
								data: formData,
								cache: false,
								contentType: false,
								processData: false,

								success: function(resp){
									var result = parseInt(resp);
									if(result == 2){
										//Show message invalid ext
										showFailMsg("Invalid image. Please choose another.", "#error");
									}else if(result == 3){
										//Show message invalid upload
										showFailMsg("Invalid upload", "#error");
									}else{
										img_url = "<?php echo BASE_URL ?>" + "/uploads/" + resp;
										$("#img-avarta").attr('src',  img_url);
										$("#upload_avarta").reset();
										$("#update-avarta").toggle('fast');
										console.log(img_url);
									}
								},
								error: function(error){
									console.log(error);
								},
							});


						});
					</script>
					</div>
				</div>
			</div>

			<hr>
			<footer>
				<div class="container">
					<p>&copy; ByHBT 2013</p>
				</div>
			</footer>
		</div> <!-- /container -->
		<script src="<?php echo BASE_URL; ?>/public_html/js/jquery.history.js"></script>
		<script src="<?php echo BASE_URL; ?>/public_html/js/jquery.colorbox.js"></script>
		<script src="<?php echo BASE_URL; ?>/public_html/js/holder.js"></script>
		<script src="<?php echo BASE_URL; ?>/public_html/js/main.js"></script>
		<script src="<?php echo BASE_URL; ?>/public_html/js/bootstrap.min.js"></script>
		<script src="<?php echo BASE_URL; ?>/public_html/js/jquery.inline-edit.js"></script>
	</body>
</html>
