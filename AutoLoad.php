<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.12.17
 * Time: 17:25
 */

class AutoLoad
{
    /**
     * Laed fehlende Klassen automatisch nach
     *
     * @param $name
     * @param $dir
     */
    public function handle($name, $dir = __DIR__)
    {
        $nDir = $dir;
        $scan = scandir($dir);
        foreach ($scan as $file) {
            $fileName = $nDir . '/' . str_replace('\\', '/', $name) . '.php';
            if (file_exists($fileName)) {
                require_once $fileName;
                return;
            } else {
                if (is_dir($dir . "/" . $file) && ($file[0] !== ".")) {
                    if (count(scandir($dir . "/" . $file)) > 2) {
                        $nDir = $dir . "/" . $file;
                        $this->handle($name, $nDir);
                    }
                }
                continue;
            }
        }
    }
}

$loader = new AutoLoad();

spl_autoload_register([$loader, 'handle']);
