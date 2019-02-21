<?php

namespace App\Console\Commands\Category;

use Illuminate\Console\Command;
use App\Entity\Category;


class CategoryFixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Категории Пофиксены';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $categorySt;

    public function __construct(Category $category)
    {
        parent::__construct();
        $this->categorySt = $category;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Fix Category
        $this->categorySt->fixTree();
        $this->info('Категории Пофиксены');
    }
}
