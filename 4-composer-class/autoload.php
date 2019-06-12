<?php

class Autoload {
    private $paths = [

    ];
    public function __construct()
    {
        $this->readVendorComposerFiles(sprintf("%s/vendor", __DIR__));
    }
    private function readVendorComposerFiles(string $vendorPath)
    {
        if (!file_exists($vendorPath)) {
            return false;
        }
        $directoryContents = scandir($vendorPath);
        $paths = array_map(function($path) use ($vendorPath) {
            return sprintf("%s/%s", $vendorPath, $path);
        }, array_filter($directoryContents, function($path) use ($vendorPath) {
            if (strncmp(".", $path, 1) === 0) {
                return false;
            }
            if ($path === "composer") {
                return false;
            }
            if (!is_dir(sprintf("%s/%s", $vendorPath, $path))) {
                return false;
            }
            return true;
        }));
        foreach($paths as $path) {
            $directories = array_filter(scandir($path), function ($directory) {
                if (strncmp(".", $directory, 1) === 0) {
                    return false;
                }
                return true;
            });
            foreach($directories as $directory) {
                $this->readComposer(sprintf("%s/%s", $path, $directory));
            }
            
        }
    }
    private function readComposer(string $path) {
        $composerPath = sprintf("%s/composer.json", $path);
        if (!file_exists($composerPath)) {
            return false;
        }
        try {
            $composer = json_decode(file_get_contents($composerPath), true);
            if (!empty($composer['autoload']['psr-4'])) {
                foreach ($composer['autoload']['psr-4'] as $psr4 => $subDirectory) {
                    $this->registerNamespace($path, $psr4, $subDirectory);
                }
            }
        } catch(\Exception $e) {
            return false;
        }
        
    } 
    public function registerNamespace(string $vendorPath, string $vendorNamespace, ?string $subDirectory): void
    {
        $path = sprintf("%s%s%s", $vendorPath, $subDirectory ? "/" : null, $subDirectory);
        $this->paths[$vendorNamespace] = $path;
        spl_autoload_register(function($className) use ($vendorNamespace, $vendorPath, $path) {
            if (strncmp($vendorNamespace, $className, strlen($vendorNamespace)) !== 0) {
                $this->autoloadLogger(sprintf("Did not pass %s", $vendorNamespace), $className);
                /**
                 * psr-4 2.4 -- should not return a value
                 */
                return;
            }
            $relativeClass = substr($className, strlen($vendorNamespace));
            $file = sprintf("%s/%s.php", $path, str_replace('\\', '/', $relativeClass));
            $this->autoloadLogger(sprintf("Looking for %s", $file), $className);

            // if the file exists, require it
            if (file_exists($file)) {
                require $file;
            }
        });
    }
    private function autoloadLogger(string $message, string $className): void {
        echo sprintf("  ~~ %s ~~ %s\n", $className, $message);
    }
    public function debug()
    {
        foreach ($this->paths as $namespace => $path) {
            echo sprintf("  !~ %s loaded for %s \n", $path, $namespace);
        }
        echo "\n\n\n";
    }
}

$a = new Autoload();
$a->debug();