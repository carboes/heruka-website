<!--<div class="newsletter">-->
	<!--<button>Sign up now</button>-->
	<form method="post" class="iContactForm" action="http://app.icontact.com/icp/signup.php" name="icpsignup" id="icpsignup27042" accept-charset="UTF-8" onsubmit="return verifyRequired27042();" >
  		<input type="hidden" name="redirect" value="http://<?php echo $_SERVER['HTTP_HOST'] . $instance['successurl']; ?>" />
 		<input type="hidden" name="errorredirect" value="http://<?php echo $_SERVER['HTTP_HOST'] . $instance['errorurl']; ?>" />
		<p>
			<label for="fields_fname">First name:</label>
			<input id="fields_fname" type="text" size="20" name="fields_fname" class="firstname" placeholder="First name" />
		</p>
		<p>
			<label for="fields_lname">Last name:</label>
			<input id="fields_lname" type="text" size="20" name="fields_lname" class="lastname" placeholder="Last name" />
			
		</p>
		<p>
			<label for="fields_email">E-mail:</label>
			<input id="fields_email" type="text" size="20" name="fields_email" class="email" placeholder="Email address" />
		</p>
		<div>
			<input type="submit" name="Submit" value="Sign up" />
  		</div>
  		<input type="hidden" name="listid" value="85141" />
  		<input type="hidden" name="specialid:85141" value="30OH" />
  		<input type="hidden" name="clientid" value="1059765" />
  		<input type="hidden" name="formid" value="2704" />
  		<input type="hidden" name="reallistid" value="1" />
  		<input type="hidden" name="doubleopt" value="0" />
	</form>
<!--</div>-->