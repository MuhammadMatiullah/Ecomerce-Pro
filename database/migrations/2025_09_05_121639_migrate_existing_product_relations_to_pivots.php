<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up(): void {
        // copy category_id -> category_product
        $products = DB::table('products')->select('id','category_id','subcategory_id')->get();

        foreach ($products as $p) {
            if ($p->category_id) {
                DB::table('category_product')->insertOrIgnore([
                    'category_id' => $p->category_id,
                    'product_id' => $p->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if ($p->subcategory_id) {
                DB::table('product_subcategory')->insertOrIgnore([
                    'subcategory_id' => $p->subcategory_id,
                    'product_id' => $p->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void {
        // optional: you could remove the inserted pivot rows (left as no-op or implement if needed)
    }
};
