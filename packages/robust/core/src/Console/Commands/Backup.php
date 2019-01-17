<?php

namespace Robust\Core\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class Backup
 * @package Robust\Core\Console\Commands
 */
class Backup extends Command
{

    /**
     * @var string
     */
    protected $signature = 'robust:backup';


    /**
     * @var string
     */
    protected $description = 'Runs the backup utility';


    /**
     * Backup constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @param Filesystem $filesystem
     */
    public function handle(Filesystem $filesystem)
    {
        $ds = DIRECTORY_SEPARATOR;
        $user = env('DB_USERNAME');
        $schema = env('DB_DATABASE');
        $password = env('DB_PASSWORD');

        $path = storage_path() . $ds . 'backups' . $ds;
        $datetime = Carbon::now();
        $time = $datetime->toTimeString();
        $file = date('Y-m-d') . '_' . $time . '_' . '_mysqldump.sql';
        Log::info("Executing:" . $path . $file);

        $command = sprintf('mysqldump -u %s -p\'%s\' %s > %s', $user, $password, $schema, $path . $file);
        Log::info("Executing:" . $command);

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        exec("$command 2>&1", $log);
        Log::info($log);

        DB::table('backups')->insert([
            [
                'name' => $file,
                'slug' => str_slug($file),
                'size' => '',//($filesystem->size($path . $file) * 0.000001),
                'path' => $path,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}