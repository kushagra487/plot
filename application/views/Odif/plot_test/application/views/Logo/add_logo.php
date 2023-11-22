<div class="right_col" role="main">
	<section>
		<div class="create-project">
			<div class="create">
				<p>Add Logo</p>
				<?php echo $message; ?>
				<form role="form" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<input id="uploadFile" placeholder="Choose File" disabled="disabled" />
						<div class="fileUpload">
							<span>Add Logo</span>
							<input id="uploadBtn" type="file" name="image" class="upload btn btn-primary" required/>
						</div>
					</div>
					<div class="form-group bottom">
						<input type="submit" id="send" name="send" value="Go"/>
					</div>
				</form>
				<div class="verticalLine"></div>
			</div>
		</div>
		<div class="existing-project"> 
			<div class="existing">
				<p>Your Current Logo</p>
				<div class="current-logo">
				<div class="imager">
					<img class="img-responsive" src="<?= base_url();?>logo/<?php echo $logo['image_name']; ?>"/>
				</div>	
					<?php //echo '<img src="'.$img.'" style="width:50px; " >'; ?>
				</div>
				<div class="verticalLine"></div>
			</div>	  
		</div>  
	</section>
</div>