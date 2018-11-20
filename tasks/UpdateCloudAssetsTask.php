<?php
/**
 * Simply calls updateCloudStatus on every file in the db.
 * Allows you to get a new server or development environment synced up easily.
 *
 * @author Mark Guinn <mark@adaircreative.com>
 * @date 01.14.2014
 * @package cloudassets
 * @subpackage tasks
 */
class UpdateCloudAssetsTask extends BuildTask
{
    protected $title = 'Cloud Assets: Update All Files';
    protected $description = 'Simply calls updateCloudStatus on every file in the db. Allows you to get a new server or development environment synced up easily.';


    public function run($request) {
        set_time_limit(0);

        $buckets = Config::inst()->get('CloudAssets', 'map');

        foreach ($buckets as $basePath => $cfg) {
            echo "processing $basePath...\n";
            $files = File::get()->filter('Filename:StartsWith', ltrim($basePath, '/'));
            echo sprintf("total file count %s", $files->count()).PHP_EOL;
            $i = 1;
            foreach ($files as $f) {
                echo sprintf("%s) filename %s - cloudstatus %s - placeholder %s",$i, $f->Filename, $f->CloudStatus, $f->containsPlaceholder() ).PHP_EOL;
                $extension = $f->getExtension();
                $allowed = array_map('strtolower', Config::inst()->get('File','allowed_extensions'));
                if(!in_array(strtolower($extension), $allowed)) {
                    echo " - not allowed extension".PHP_EOL;
                    continue;
                }

                $f->updateCloudStatus();
                $f->createLocalIfNeeded();
                $i++;
            }
        }

        echo "done\n\n";
    }

}