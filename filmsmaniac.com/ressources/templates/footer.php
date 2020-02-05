<?php 
//L'utilisateur qui existe dans le fichier index.php
global $user;

global $jsFiles;

if (!empty($user)) {
?>

<div id="footer">
	<p class="pull-left">© 2016 FilmsManiacs</p>
	<div class="pull-right">
		<p>
			<a href="https://www.facebook.com/bootsnipp"><i id="social-fb"
				class="fa fa-facebook-square fa-3x social"></i></a> <a
				href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp"
				class="fa fa-google-plus-square fa-3x social"></i></a> <a
				href="https://twitter.com/bootsnipp"><i id="social-tw"
				class="fa fa-twitter-square fa-3x social"></i></a> <a
				href="mailto:bootsnipp@gmail.com"><i id="social-em"
				class="fa fa-envelope-square fa-3x social"></i></a> Une conception
			de <a href="#"><i id="social-em"></i>Loïc Ndjoyi</a>
		</p>
	</div>

</div>
<?php } ?>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!--<script src="../public_html/js/bootstrap.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script><-->
<!--<script src="../public_html/js/bootstrap.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"></script>

<!--include jQuery -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"
type="text/javascript"></script>-->
 
<!--include jQuery Validation Plugin-->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
type="text/javascript"></script>

<?php 
if (!empty($jsFiles)) {
for ($i = 0; $i < count($jsFiles); $i ++) {?>
       <script src="../public_html/js/<?php echo $jsFiles[$i];?>"></script>
    <?php }
}
?>
</body>
</html>