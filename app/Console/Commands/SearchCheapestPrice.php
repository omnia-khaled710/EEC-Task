<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SearchCheapestPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest{id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'search for cheapest 5 pharmacies';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $product = Product::find($id);
        if(is_null( $product)){
            $this->info('Product id not found');

        }else{
            $pharmacies = DB::table('pharmacy_product')
            ->where('product_id', $id)
            ->orderBy('price')
            ->limit(5)
            ->join('pharmacies', 'pharmacies.id', 'pharmacy_product.pharmacy_id')
            ->select('pharmacies.id', 'pharmacies.name', 'pharmacy_product.price')
            ->get();

        $this->info($pharmacies->toJson());
        }

    }
}
