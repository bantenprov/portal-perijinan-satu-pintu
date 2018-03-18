<?php

namespace Bantenprov\PerijinanSatuPintu\Console\Commands;

use Illuminate\Console\Command;

/**
 * The PerijinanSatuPintuCommand class.
 *
 * @package Bantenprov\PerijinanSatuPintu
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class PerijinanSatuPintuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:perijinan-satu-pintu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Bantenprov\PerijinanSatuPintu package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome to command for Bantenprov\PerijinanSatuPintu package');
    }
}
