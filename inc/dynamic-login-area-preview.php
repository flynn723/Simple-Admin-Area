<?php
/*
Admin Class for the Simple Admin Area
Version 1.0

Author: Justin Estrada
Plugin URI: http://justinestrada.com/wordpress-plugins?plugin=simple-admin-area
*/
    $loginLogoID = get_option('login_logo');
    $imgSRC = wp_get_attachment_image_src($loginLogoID);
    $loginFormBGClr = get_option('login_form_bg_clr');
    $loginFormTxtClr = get_option('login_form_text_clr');
    $addLoginFormAreaCSS = get_option('add_login_area_css');
?>
<style type="text/css">
.login {
    background: #fff;
    padding: 15px;
}
#login {
    width: 320px;
    padding: 0;
    margin: auto;
}
.login * {
    margin: 0;
    padding: 0;
}
.login h1 {
    text-align: center;
}
.login h1 a {
    <?php if ($imgSRC['0']):
        echo 'background-image: url("'.$imgSRC['0'].'") !important;';
    else:
        echo 'background-image: url(images/w-logo-blue.png?ver=20131202);';
    endif; ?>
    -webkit-background-size: 84px;
    background-size: 84px;
    background-position: center top;
    background-repeat: no-repeat;
    color: #444;
    height: 84px;
    font-size: 20px;
    line-height: 1.3em;
    margin: 0 auto 25px;
    padding: 0;
    width: 84px;
    text-indent: -9999px;
    outline: 0;
    display: block;
}
.login #example-loginform {
    margin-top: 20px;
    margin-left: 0;
    padding: 26px 24px 46px;
    <?php if ($loginFormBGClr):
        echo 'background: '.$loginFormBGClr.';';
    else:
        echo 'background: #fff;';
    endif; ?>
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
    box-shadow: 0 1px 3px rgba(0,0,0,.13);
}
#login #example-loginform p {
    margin-bottom: 0;
}
.login label {
    <?php if ($loginFormTxtClr):
        echo 'color: '.$loginFormTxtClr.';';
    else:
        echo 'color: #72777c;';
    endif; ?>
    font-size: 14px;
}
.login #example-loginform .input, .login #example-loginform input[type=checkbox], .login input[type=text] {
    background: #fbfbfb;
}
.login #example-loginform .input, .login input[type=text] {
    font-size: 24px;
    width: 100%;
    padding: 3px;
    margin: 2px 6px 16px 0;
}
.login #example-loginform .forgetmenot {
    font-weight: 400;
    float: left;
    margin-bottom: 0;
}
#login #example-loginform p.submit {
    margin: 0;
    padding: 0;
}
.login .button-primary {
    float: right;
}
.login .wp-core-ui .button-primary {
    background: #0085ba;
    border-color: #0073aa #006799 #006799;
    -webkit-box-shadow: 0 1px 0 #006799;
    box-shadow: 0 1px 0 #006799;
    color: #fff;
    text-decoration: none;
    text-shadow: 0 -1px 1px #006799, 1px 0 1px #006799, 0 1px 1px #006799, -1px 0 1px #006799;
}
<?php echo $addLoginFormAreaCSS; ?>
</style>
<div class="login">
<div id="login">
	<h1><a href="<?php echo get_site_url(); ?>" title="eventanator" tabindex="-1">Eventanator</a></h1>
	<div id="example-loginform">
		<p>
			<label for="user_login">Username or Email Address<br>
			<input type="text" name="log" id="user_login" class="input" value="" size="20"></label>
		</p>
		<p>
			<label for="user_pass">Password<br>
			<input type="password" name="pwd" id="user_pass" class="input" value="" size="20"></label>
		</p>
			<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
		</p>
	</div>
	<p id="nav"><a href="<?php echo get_site_url(); ?>/wp-login.php?action=lostpassword">Lost your password?</a></p>
	<p id="backtoblog"><a href="<?php echo get_site_url(); ?>">← Back to Eventanator</a></p>
</div>
</div>