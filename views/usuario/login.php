<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
                     <form action="<?=base_url?>usuario/login" method="POST">
			<div class="sign-in-htm">
				<div class="group">
					<label for="mail" class="label">Mail</label>
					<input name="mail" type="email" class="input">
				</div>
				<div class="group">
					<label for="password" class="label">Password</label>
					<input name="password" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>
			</div>
                     </form>
                    <form action="<?=base_url?>usuario/save" method="POST">
			<div class="sign-up-htm">
				<div class="group">
					<label for="mail" class="label">Email Address</label>
                                        <input name="mail" type="email" class="input">
				</div>
				<div class="group">
					<label for="password" class="label">Password</label>
					<input name="password" type="password" class="input" data-type="password">
				</div>
<!--				<div class="group">
					<label for="password" class="label">Repeat Password</label>
					<input name="password" type="password" class="input" data-type="password">
				</div>-->
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
                    </form>
		</div>
	</div>
</div>