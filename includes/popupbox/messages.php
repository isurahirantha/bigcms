<div id='msg' class='messages'>
			<div class="msgheader">
			<?php if(isset($message)){echo "Hello, ",$ses_user_id,"!";}?></h1>
			</div>
			<hr>
			<div class="msgbody">
			<?php if(isset($message)){echo"<p>", $meaasege,"</p>";} ?>

			<?php if(!empty($error)){ echo "<code>", show_error($error),"</code>";} ?>
			</div>
</div>