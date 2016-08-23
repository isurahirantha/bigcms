<?php
if(!isset($new_page)){
  $new_page=false;
}
?>
<script type="text/jvascript" src="js/jquery"></script>
           <h1><?php if($new_page===false){echo "Edit: &nbsp;", $sel_pid['menu_name'];}else{echo "Add new page to:",strtoupper($sel_sid['menu_name']);}?> </h1>
            
            <label>
            <span>Lesson name:</span>
            <input type="text" name="lesson_name" value="<?php if($new_page===false){echo $sel_pid['menu_name'];}?>">
            </label>

        
            <label>
            <span>Key words:</span>
            <input type="text" name="key_words" value="<?php if($new_page===false){echo $sel_pid['keyword'];}?>">
            </label>

            <label>
            <span>Content:</span>
            <textarea name="content" id="content" ><?php if($new_page===false){echo $sel_pid['content'];}?></textarea>
            </label>

            <label>
            <span>youtube:</span><input type="text" name="vedio" maxlength="255" value="<?php if($new_page===false){echo htmlspecialchars($sel_pid['youtube_link']);}?>">
            </label>

            <!--if Editor want to publish a programming codes -->
            <label>
            <span id="source_code_button">Source code:</span>
            <textarea name="source_code" id="source_code" ><?php if($new_page===false){echo $sel_pid['source_code'];}?></textarea>
            <input type="text" id="msg_source_code" value="Click here to add your Source Code" readonly="readonly">
            </label>
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/source_code_button.js"></script>
            <script type="text/javascript">
            $(document).ready(function(){
                $("#msg_source_code").css({"background-color":"yellow"});
                $("#source_code_button").css({"color":"yellow"});
            });
            </script>
            <label>
            <span>position:</span><select name="position">         
            <?php 
          if(!$new_page){
            $page_set = get_all_pages_by_sid($sel_pid['subject_id']);
            $page_count = mysql_num_rows($page_set);
          }else{
            $page_set = get_all_pages_by_sid($sel_sid['id']);
            $page_count = mysql_num_rows($page_set)+1;
          }
          
          for($count=1;$count<=$page_count;$count++){
            echo "<option value=\"{$count}\"";
              if($count==$sel_pid['position']){
                echo "selected";
              }
            echo ">{$count}</option>";
          }
          ?>
                      </select>
            </label>
            


            <p><span>visible:</span>
            <input type="radio" name="visible" value="0" 
            <?php if($new_page===false && $sel_pid['visible']==0 ){echo "checked";}?>
            >NO
            <input type="radio" name="visible" value="1" 
            <?php if($new_page===false && $sel_pid['visible']==1 ){echo "checked";}?>
            >YES
            </p>

           
  
           

            <label>
            <input type="submit" value="Save" name="submit" class="btn" id="submit">
            </label>
