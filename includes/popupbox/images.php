<div id='up_image' class='w_processor'>
		<div class='notice-wrapper'>
			<div class='notice-header'><code>
			<span> පින්තුරයේ මුලාශ්‍රය පිටපත් කොට පහළින් අලවන්න.</span><br>
			<span>Copy image link, Then past it in lessons area.</span></code>
			</div>
			<hr>
		<div class='noticebody'>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>

        <script type="text/javascript" >
            $(document).ready(function() {
                $('#submitbtn').click(function() {
                    $("#viewimage").html('');
                    $("#viewimage").html('loading..');
                    $(".uploadform").ajaxForm({
                        target: '#viewimage'
                    }).submit();
                });
            });
        </script> 

        <h2>Upload Image Without Page Refresh!</h2>
 
            <form class="uploadform" method="post" enctype="multipart/form-data" action='upload.php'>
                Upload your image <input type="file" name="imagefile" />
				<input type="submit" value="Submit" name="submitbtn" id="submitbtn">
			</form>
			
            <div id='viewimage'>status</div>


			<?php
			$ses_user_id=$_SESSION['user_id'];
 			$files = array_slice(scandir("usersfolder/user{$ses_user_id}/page{$ses_user_id}"), 2);  
 			foreach($files as $pic){
 			$pic_files="<img src='usersfolder/user{$ses_user_id}/page{$ses_user_id}/{$pic}' width='200px' height='200px'>";
 			echo  $pic_files;
 			echo "<div>", htmlentities($pic_files),"</div>";
 			echo "<br>";
 			}
			?>
			<br>
			<code></code>
			</div>
			<div class='notice-footer'>
			<button class='wbutton' >&nbsp; &cross; &nbsp;</button>
			</div>
		</div>
</div>
<script type="text/javascript" src="js/jquery"></script>
<script type="text/javascript" src="js/auto_upload.js"></script>