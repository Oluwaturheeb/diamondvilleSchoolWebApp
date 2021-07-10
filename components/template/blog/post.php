<?php 

$d = new Crud('posts');
$post = $c->fetch(
	// post columns
	'title', 'slug', 'time', 'tags', 'user', 'content',
	// get user info
	'name', 'about',
	)->join('users', ['user.id', 'post.user'])
->exec();

if ($c->error()) error('Cannot find the resource you are look for on this server!', 'Not Found', 404);

// print_r($post);

$title = "Welcome";
callfile("inc/header.php", 'welcome '. $post->title);
?>
	<div class="container">
		<!-- Your html code goes here -->
	</div>

<?php 
// this include the app js files
require_once "inc/footer.php";