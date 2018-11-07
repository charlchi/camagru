
<form name="this" onsubmit="validate_pass(); return false" autocomplete="off">
	<div class= "block">

		<h3>Change password</h3>

		<span id="message" style='color:#ff0000'></span><br>

		<label for="pass">Password</label><br>
		<input type="password" placeholder="Old Password" name="pass" required><br>

		<label for="npass">New password</label><br>
		<input type="password" placeholder="New Password" name="npass" required><br>

   		<button type="submit">Submit</button>

	</div>
</form>
