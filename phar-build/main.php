<?php 

class PharDeploy extends Phar {
	
	protected $path;
	
	public function __construct( $fname, $flags = false, $alias = false ) {
		parent::__construct($fname, $flags, $alias);
		
		$this->path = $fname;
	}
	
	public function extractDirTo( $destDir, $sourceDir ) {
		$iterator = new RecursiveIteratorIterator(
						new RecursiveDirectoryIterator(
								$this->path . $sourceDir, FilesystemIterator::SKIP_DOTS ) );
		
		foreach( $iterator as $file ) {
			$file = str_replace( $this->path . '/', '', $file);
			printf( " * %s\n", $file );
			$this->extractTo( $destDir, $file, true);
		}
	}
	
	public function extractByConfig( $configFileName ) {
		$pharDir = preg_replace('/\/[^\/\.]+?\.phar.*/', '/', __DIR__ );
		$pharDir = str_replace('phar://', '', $pharDir);
		
		$conf = json_decode( file_get_contents( $configFileName ) );
		echo "Extracting files:\n";
		foreach( $conf->public as $dirName ) {
			$this->extractDirTo( $pharDir, $dirName );
		}
	}
	
}


$pharPath = preg_replace('/\.phar.*/', '.phar', __FILE__ );
$pharDir = preg_replace('/\/[^\/\.]+?\.phar.*/', '/', __DIR__ );
$pharDir = str_replace('phar://', '', $pharDir);

$phar = new PharDeploy( $pharPath );
$phar->extractByConfig( "./phar-build.json" );

chdir( $pharDir );

$cmd = 'php build/composer.phar update -n -d build/';
printf( "Executing \"%s\"\n", $cmd );
echo shell_exec( $cmd );

$cmd = 'vendor/bin/phing -f build/build.xml';
printf( "Executing \"%s\"\n", $cmd );
echo shell_exec( $cmd );

