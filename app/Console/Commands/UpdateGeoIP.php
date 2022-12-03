<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateGeoIP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geoip:update {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Maxmind GeoLite2 and GeoIP2 databases';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $geoip = array(
            'license_key' => env('MAXMIND_LICENSE_KEY'),
            'dir' => env('DESTINATION_DIRECTORY_PATH'),
            'editions' => explode(' ', env('MAXMIND_DATABASES')),
        );

        // Force databases update.
        if ($this->option('force')) {

            // Delete last-modified.txt file to force the edition database update.
            foreach ($geoip['editions'] as $edition) {
                $modified = $geoip['dir'] . DIRECTORY_SEPARATOR . $edition . DIRECTORY_SEPARATOR . 'last-modified.txt';
                if (is_file($modified)) {
                    unlink($modified);
                }
            }
        }

        // Run update.
        $client = new \tronovav\GeoIP2Update\Client($geoip);
        $client->run();

        if (!empty($client->updated())) {
            foreach ($client->updated() as $info) {
                $this->info($info);
            }
        }
        
        if (!empty($client->errors())) {
            foreach ($client->errors() as $error) {
                $this->error($error);
            }
        }

        return Command::SUCCESS;
    }
}
