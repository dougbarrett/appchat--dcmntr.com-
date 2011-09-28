
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo @$seoTitle; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
<?php if(@$seoCanonical): ?>
	<link rel="canonical" href="<?php echo $seoCanonical; ?>" />
<?php endif; ?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link rel="stylesheet" href="/stylesheets/twitter.min.css">
	<style type="text/css">
		html,body{
			background-color:#eee;
		}
		body{
			padding-top:40px;
		}
      /* The white background content wrapper */
      .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }
	</style>
</head>
<body>

    <div class="topbar">
      <div class="fill">
        <div class="container">
		  <?php echo anchor('/', 'dcmntr', 'class="brand"'); ?>
          <ul class="nav">
            <li <?php echo (@$app_page) ? "class='active'" : '' ?>><?php echo anchor("apps", "Apps"); ?></li>
			<?php if(! @$loggedin): ?>
			<li <?php echo (@$signup_page) ? "class='active'" : '' ?>><?php echo anchor("sign-up", "Sign Up"); ?></li>
			<?php endif; ?>
          </ul>
		  <?php if(! @$loggedin): ?>
		  <?php $attr = array("class" => "pull-right"); ?>
		  <?php echo form_open("login", $attr); ?>
            <input class="input-small" type="text" placeholder="E-Mail" name="email">
            <input class="input-small" type="password" placeholder="Password" name="password">
            <button class="btn" type="submit">Sign in</button>
          </form>
		  <?php endif; ?>
		  <?php if( @$loggedin): ?>
		  <ul class="nav secondary-nav">
			<li><?php echo anchor("profile", "Profile"); ?></li>
			<li><?php echo anchor("logout", "Logout"); ?></li>
		  </ul>
		  <?php endif; ?>
        </div>
      </div>
    </div>
	
<div class="container">
<div class="content">