<?php

namespace App\Console\Commands;

use App\Traits\CronTrait;
use Illuminate\Console\Command;

class AutoAssignProductToScrapDealer extends Command
{
    use CronTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:scrapDealer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto assign toss type products to scrap dealer with subscription';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->autoAssignScrapDealerToProduct();
    }
}
