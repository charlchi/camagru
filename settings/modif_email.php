
<form name="this" onsubmit="validate_email(); return false" autocomplete="off">
	<div class= "block">

		<h3>Change email</h3>

		<span id="message" style='color:#ff0000'></span><br>

		<label for="email">Email</label><br>
		<input type="text" placeholder="Old email" name="email" required><br>

		<label for="nemail">New email</label><br>
		<input type="text" placeholder="New email" name="nemail" required><br>

		<button type="submit">Submit</button>

	</div>
</form>
