<?php
namespace Devtee\Tlyt\Components;

class Console {
  public static function bootstrapConsole ($argv) {
    if (count($argv) > 1)
  	  if(strpos($argv[1], '-') === false) {
  			$res = self::consoleHelp();
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
  					$res = '**Success: Authentication template created successfully!';
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
                    $res = self::consoleHelp();
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
  				PageCache::clearCache();
  				$res = '**Success: PageCache cleared successfully!';
  				
  			} elseif ($arg == 'startworker') {
  			  self::worker();
  			}
  			echo $res, "\n";
  		} else {
  			// this for initialition, version and help via cli
  			$arg = getopt('ivh');
  			$res = self::consoleHelp();
  	
  			foreach ($arg as $key => $value) {
  				switch ($key) {
  					case 'i':
  						if ((new Config())->init())
  							$res = '**Error: Are you sure mysql is running and that you have mysql in your path?';
  						else
  							$res = '**Success: Setup completed!';
  						break;
  					case 'v':
  						$res = self::version();
  						break;
  					case 'h':
  						$res = self::consoleHelp();
  						break;
  					default:
  						$res = self::consoleHelp();
  						break;
  				}
  			}
  			echo $res, "\n";
  		}
  	else echo self::consoleHelp();
  }
  
  protected static function consoleHelp () {
		$version = self::version();
    $help = <<<__here

	. . . . . . . . .
.   _______________   .
.  |               |  .
.  |     _____     |  .
.  |    |_____|    |  .
.  |      | |      |  .
.  |      |_|      |  .
  . \             / .
    . \_________/ .
       |_______|
       |_______|
        \_____/
 
Tlyt V$version

To start a project kindly review the settings for this project in config.php in the root directory
Available commands:

auth
    this create the login and registration files
backup
    this command create a backup of the database of the app\n
clearcache
    this command clears the application cache
crud    =>  this create useful crud files\n
header  =>  this set the default header file. Takes file name as argument without the .php extension\n
import  =>  this import the previously backed up database file into the app db\n

--------------------------------------------------------
  Other options
--------------------------------------------------------
-i    this setup the database and default auth table
-h    show this help
-v    show version

__here;

  return $help;
  }
  
  protected static function worker () {
    Batch::run();
  }
  
  protected static function version () {
    return '3.0.0';
  }
}