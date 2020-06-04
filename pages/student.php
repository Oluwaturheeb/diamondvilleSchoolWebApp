<?php
require_once "Autoload.php";

if(!Session::check("user"))
	Redirect::to("/login");
else 
	$title = "My dashboard";

require_once "inc/header.php";
$e = new Easy();
$user = Session::get("user");

$e->table("student");
$r = $e->fetch(["concat(first, ' ', last) as name", "class", "picture", "pre"], ["a_id", "=", $user])
->exec(1);
?>

			<div class="col-12 mt-3">
				<div class="header">
					<img src="<?php echo $r->picture ?>" alt="<?php echo $r->name ?>" class="img-thumbnail">
					<div>
						<b><?php echo $r->name ?></b>
						<br/>
						<small><i><?php echo $r->class ?></i></small>
					</div>
				</div>
				<div class="mt-4"><i><?php echo Utils::time(); ?></i></div>
			</div>
<?php
require_once "inc/footer.php";