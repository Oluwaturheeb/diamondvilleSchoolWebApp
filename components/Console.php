<?php
// require_once 'app.php';
spl_autoload_register(function($class){
	if (file_exists(__DIR__. '/'. $class. '.php')) {
		require_once $class.'.php';
	} else {
		require_once 'vendor/autoload.php';
	}
});
require_once 'cmd.php';

if (count($argv) > 1)
	if(strpos($argv[1], '-') === false) {
			$res = $cmd_icon. $def;
			$arg = $argv[1];
			if ($arg == 'crud') {
				// crud scafold
				$c = Utils::r_copy('components/template/blog/', './pages');
				$res = '**Success: Template created successfully!';
			} elseif ($arg == 'auth') {
				// standalone auth file
				if (@$argv[2])  {
					if ($argv[2] == 'standalone') Utils::r_copy(__DIR__ . '/template/login.php', __DIR__ . '/../pages/');
					// multipages
					elseif ($argv[2] == 'all') Utils::r_copy(__DIR__ . '/template/auth', __DIR__ . '/../pages/');
					$res = '**Success: Auth template created successfully!';
				} else {
					$res = "**Error: No argument supplied! \r\nPossible arguments are standalone | all";
				}
			} elseif ($arg == 'backup') {
				// creating backup of db
				$u = config('db/usr');
				$p = config('db/pwd');
				$db = config('db/database');
				
				if ($p)
					exec(escapeshellcmd("mysqldump -u {$u} -p {$p} {$db} > {$db}.sql"));
				else
					exec(escapeshellcmd("mysqldump -u {$u} {$db}"));
					///exec();
				$res = '**Success: Backup completed!';
			} elseif ($arg == 'import') {
				// import the db onced backed up
				$u = config('db/usr');
				$p = config('db/pwd');
				$db = config('db/database');
				
				if ($p)
					exec(escapeshellcmd("mysql -u {$u} -p {$p} {$db} < {$db}.sql"));
				else
					exec(escapeshellcmd("mysql -u {$u} {$db} < {$db}.sql"));
				$res = '**Success: Backup completed!';
			} elseif ($arg == 'header') {
				$header = @$argv[2];

				if (!$header) {
					$res = $cmd_icon.$def;
				} else {
					if (copy(@'pages/inc/headers/'. $header .'.php', 'pages/inc/defaultHeader.php')) {
						$text = '
						require_once \'defaultHeader.php\';';
						file_put_contents('pages/inc/header.php', $text, FILE_APPEND);
						$res = '**Success: Default header is set!';
					} else {
						$res = '**Error: Unknown error!';
					}
				}
			} else if ($arg == 'clearcache') {
				// clear cache
				Cache::clearCache();
				$res = '**Success: Cache cleared successfully!';
				
			}
			echo $res, "\n";
		} else {
			// this for initialition, version and help via cli
			$arg = getopt('ivh');
			$res = $cmd_icon . $def;
	
			foreach ($arg as $key => $value) {
				switch ($key) {
					case 'i':
						if ((new Config())->init())
							$res = '**Error: Are you sure mysql is running and that you have mysql in your path?';
						else
							$res = '**Success: Setup completed!';
						break;
					case 'v':
						$res = 'Tlight v2.1.0';
						break;
					case 'h':
						$res = $cmd_icon . $def;
						break;
					default:
						$res = $cmd_icon . $def;
						break;
				}
			}
			echo $res, "\n";
		}
	else
	 echo $cmd_icon . $def;