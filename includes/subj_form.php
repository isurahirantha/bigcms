<?php
if(!isset($new_page)){
  $new_page=false;
}
?>
            <h1><?php if($new_page===false && isset($sel_sid['menu_name'])){
                          echo "Edit :&nbsp;", strtoupper($sel_sid['menu_name']) ;}else{
                              echo "Add a Subject!";
                              }  ?> </h1>
                  
            
            <label>
            <span>Subject name:</span>
            <input type="text" name="menu_name" value="<?php if($new_page===false && isset($sel_sid['menu_name'])){
                                                             echo $sel_sid['menu_name'];} ?>">
            </label>

            <label>
            <span>Key words:</span>
            <input type="text" name="key_words" value="<?php if($new_page===false && isset($sel_sid['keyword'])){
                                                                echo $sel_sid['keyword'];} ?>">
            </label>

<?php if($new_page==true){
        $query = "SELECT id, category, editor_preference FROM category";
        $query = mysql_query($query,$connection);
        echo "<label><span>Select a category</span>";
        echo    "<select name='preference' id='preference'>";
        echo "<option value='Default'>Choose...</option> ";
        while($cat_set = mysql_fetch_array($query)){
          $cat_id=$cat_set['id'];
          $cat_name =$cat_set['category'];
          echo "<option value=\"{$cat_id}\">{$cat_name}</option> ";
        }
        echo "</select></label>";
}        
?>    
<!--in the head, jquery have been enebled-->    
<script type="text/javascript">
//if noselected, or attr == default, disable save button//
$(document).ready(function(){
  $("#preference").change(function(){
    value = $(this).attr('value');
    if(value!='Default'){
      $("#bttn").removeAttr("disabled");
    }
  });
});
</script>
            <p>
            Visible: <input type="radio" name="visible" value="0" >NO
            &nbsp;
            <input type="radio" name="visible" value="1"  checked >YES
            </p>
           
            <label>
            <?php
           if($new_page==true){
           echo  '<input type="submit" value="Save" name="submit" class="btn" id="bttn" disabled="disabled">';
           }else{
           echo '<input type="submit" value="Save" name="submit" class="btn">';
           }
           ?>
            </label>