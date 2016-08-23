    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="dark-css" id="regform">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
    $(document).tooltip({track:true});
    </script>
    <h1>REGISTER FORM 
        <span>Please fill all the texts in the fields.</span>
    </h1>
    <label>
        <span>First Name :</span>
        <input id="name" type="text" name="fname" placeholder="Your First Name" />
        <p class ="regmsg" id="nametxt"></p>
    </label>
     <label>
        <span>Last Name :</span>
        <input id="lname" type="text" name="lname" placeholder="Your Last Name" />
        <p class ="regmsg" id="lnametxt"></p> 
    </label>   
     <label>
        <span> I'm Good at:</span>
        <input id="goodat" type="text" name="goodat" placeholder="example:science" />
        <p class ="regmsg" id="goodattxt"></p> 
    </label>
    <label>
        <span>Your Email :</span>
        <input id="email" type="text" name="email" placeholder="Valid Email Address" />
        <p class ="regmsg" id="emailtxt"></p>
    </label>
    
     <label>
        <span>Your Password :</span>
        <input id="password" type="password" name="password" placeholder="password" />
        <p class ="regmsg" id="passwordtxt"></p>
    </label>

     <label>
        <span>Retype Password :</span>
        <input id="Retype_password" type="password" name="password" placeholder="Retype Password" />
        <p class ="regmsg" id="confirm_pass"></p>
    </label> 
     <label>
        <span>I am:</span> <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
        </select>
    </label>
     <label>
        <span>&nbsp;</span>
        <input id="agreed" type="checkbox" name="agree" value="agree"><a href="condition">I agree to terms & conditions:</a>
    </label>  
     <label>
        <span>&nbsp;</span> 
        <input id="regbutton" type="submit" class="button" value="Register" name="submit" disabled="disabled" /> 
    </label>
<script type="text/javascript" src="js/validate_email.js"></script>
</form>


