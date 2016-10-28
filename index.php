<?php require_once('functions.php'); ?>
<!doctype html>
<html>
<head>
  <title>Kodie Grantham</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="build/img/favicon.png" rel="icon" type="image/png">
  <link href="build/css/main.css?ver=<?php echo time(); ?>" rel="stylesheet" type="text/css">
  <script src="build/js/main.js?ver=<?php echo time(); ?>" type="text/javascript"></script>
</head>
<body>

<?php ob_start(); ?>
  <p style="text-align: center;"><img src="build/img/mylzanddaddy.jpg" class="profile-img"></p>
  <p style="text-align: center;"><strong>Kodie Grantham</strong></p>
  <p style="text-align: center;"><em>Senior Product Engineer @ <a href="https://itsahappymedium.com" target="_new">Happy Medium</a></em></p>
  <p>Hi! My name is Kodie and I am an Engineer from Des Moines, Iowa. I have a pretty diverse set of skills
    coming from over 17 years of experience. Some of those skills include developing websites and software
    using a wide variety of languages such as HTML(5), CSS(3), JavaScript, PHP, C#, Java, and more. Along with
    that comes my experience using technologies and tools such as Node.js, Meteor, React, MongoDB and so much more.
    This only just skims the surface of my skill set so if you'd like, check out my <a href="https://github.com/kodie" target="_new">GitHub</a>,
    <a href="http://stackoverflow.com/users/5463842/kodie-grantham" target="_new">Stack Overflow</a>, or
    <a href="resume/resume.html" target="_new">Resume</a>!</p>
  <p>When I'm not busy being a code-monkey, I like to hang out with my gorgeous wife Rebeca and our two beautiful
    children Ana and Mylz. I also love to watch anime, play guitar and bass, and I'm a huge Jeep enthusiast.</p>
  <p>So thanks for visiting my personal website! Feel free to contact me via e-mail at
    <a href="mailto:kodie.grantham@gmail.com">kodie.grantham@gmail.com</a> or Twitter <a href="http://twitter.com/kodiewithak" target="_new">@kodiewithak</a>.</p>
<?php win(ob_get_clean(), 'Welcome!', 'info', 'welcome', array('position'=>'absolute','width'=>'500px','left'=>'calc(50% - 250px)','top'=>'60px')); ?>

<?php ob_start(); ?>
  <p class="icon-list">
    <a href="mailto:kodie.grantham@gmail.com" title="E-Mail"><i class="fa fa-envelope"></i></a>
    <a href="resume/resume.html" title="Resume" target="_new"><i class="fa fa-file-text-o"></i></a>
    <a href="https://twitter.com/kodiewithak" title="Twitter" target="_new"><i class="fa fa-twitter"></i></a>
    <a href="https://linkedin.com/in/kodie" title="LinkedIn" target="_new"><i class="fa fa-linkedin"></i></a>
    <a href="https://github.com/kodie" title="GitHub" target="_new"><i class="fa fa-github"></i></a>
    <a href="http://stackoverflow.com/users/5463842/kodie-grantham" title="Stack Overflow" target="_new"><i class="fa fa-stack-overflow"></i></a>
    <a href="http://codepen.io/kodie/" title="CodePen" target="_new"><i class="fa fa-codepen"></i></a>
    <a href="http://forum.xda-developers.com/member.php?u=2056933" title="XDA-Developers" target="_new"><i class="fa fa-android"></i></a>
  </p>
<?php win(ob_get_clean(), 'Check me out!', 'heart', 'links', null); ?>

<?php ob_start(); ?>
  <ul>
    <li><a href="https://github.com/kodie/gravityforms-repeater" target="_new">Gravity Forms Repeater Add-on</a></li>
    <li><a href="https://github.com/kodie/serverpilot-shell" target="_new">ServerPilot CLI</a></li>
    <li><a href="https://github.com/kodie/gameranger-account-switcher" target="_new">GameRanger Account Switcher</a></li>
    <li><a href="http://forum.xda-developers.com/showthread.php?t=641385" target="_new">Adbuix</a></li>
  </ul>
<?php win(ob_get_clean(), 'Projects', 'thumbs-up', 'projects', null); ?>

</body>
</html>
