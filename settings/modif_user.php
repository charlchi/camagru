
<form name="this" onsubmit="validate_user(); return false" autocomplete="off">
	<div class= "block">

		<h3>Change username</h3>

		<span id="message" style='color:#ff0000'></span><br>

		<label for="username">Username</label><br>
		<input type="text" placeholder="Old username" name="username" required><br>

		<label for="nusername">New username</label><br>
		<input type="text" placeholder="New username" name="nusername" required><br>

		<button type="submit">Submit</button>

	</div>
</form>
