<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Robust\Core\Helpers\CoreHelper;
use Watson\Sitemap\Sitemap;

class SitemapGenerate extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'robust:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem, Sitemap $map)
    {
        $this->info("\n=============================================");
        $this->info("============ Generating Sitemap =============");
        $this->info("=============================================");
        $execute = $this->confirm("Would you like to execute sitemap generator? [y|N]", false);

        if ($execute) {
            $packages = CoreHelper::names();
            foreach ($packages as $key => $package) {
                $this->info("Entering {$package}");
                if ($filesystem->exists(base_path() . "/packages/robust/{$key}/src/Helpers/SitemapHelper.php")) {
                    $class = "Robust\\{$package}\\Helpers\\SitemapHelper";
                    $helper = new $class();
                    $helper->generate();
                    $map = $helper->addToIndex($map);

                }
            }
            Storage::disk('local')->put('sitemaps/sitemap.xml', $map->xmlIndex());
        }
    }
}