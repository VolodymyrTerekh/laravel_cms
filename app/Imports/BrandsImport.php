<?php

namespace App\Imports;

use App\CarBrand;
use App\CarModel;
use App\CarYear;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BrandsImport implements ToCollection, WithBatchInserts, WithChunkReading
{
    public function collection(Collection $rows, $id = null)
    {
        foreach($rows as $row){
            if($row[0] != 'Марка авто'){
                $brand_exists = \DB::table('car_brands')->where('name', $row[0])->first();

                if(!is_null($brand_exists)){
                 
                    $brand = \DB::table('car_brands')->where('id', $brand_exists->id)->update([
                        'name' => $row[0],
                        'slug' => $row[12],
                        'updated_at'    => Carbon::now(),
                    ]);

                }

                if(is_null($brand_exists)){

                    $brand = \DB::table('car_brands')->insert([
                        'name' => $row[0],
                        'slug' => $row[12],
                        'created_at'    => Carbon::now(),
                    ]);

                }

                $brands = \DB::table('car_brands')->where('name', $row[0])->first();
                $model_exists = \DB::table('car_models')->where('name', $row[1])->where('car_brand_id', $brands->id)->first();

                if(!is_null($model_exists)){
                 
                    $model = \DB::table('car_models')->where('id', $model_exists->id)->update([
                        'name' => $row[1],
                        'slug' => $row[13],
                        'car_brand_id' => $brands->id,
                        'updated_at'    => Carbon::now(),
                    ]);

                }

                if(is_null($model_exists)){

                    $model = \DB::table('car_models')->insert([
                        'name' => $row[1],
                        'slug' => $row[13],
                        'car_brand_id' => $brands->id,
                        'created_at'    => Carbon::now(),
                    ]);

                }

                $models = \DB::table('car_models')->where('name', $row[1])->first();
                $year_exists = \DB::table('car_years')->where('name', $row[2])->where('car_model_id', $models->id)->first();

                if(!is_null($year_exists)){
                 
                    $year = \DB::table('car_years')->where('id', $year_exists->id)->update([
                        'name' => $row[2],
                        'slug' => $row[14],
                        'car_model_id' => $models->id,
                        'updated_at'    => Carbon::now(),
                    ]);

                }

                if(is_null($year_exists)){

                    $year = \DB::table('car_years')->insert([
                        'name' => $row[2],
                        'slug' => $row[14],
                        'car_model_id' => $models->id,
                        'created_at'    => Carbon::now(),
                    ]);

                }

                $product_exists = \DB::table('products')->where('name', $row[3])->first();
                $years = \DB::table('car_years')->where('name', $row[2])->first();

                if(!is_null($product_exists)){
                 
                    $product = \DB::table('products')->where('id', $product_exists->id)->update([
                        'name'          => $row[3],
                        'slug'          => $row[15],
                        'description'   => $row[11],
                        'image'         => $row[4],
                        'images'        => $row[5],
                        'car_brand_id'  => $brands->id,
                        'car_model_id'  => $models->id,
                        'car_year_id'   => $years->id,
                        'attributes'    => $row[6],
                        'sku'           => $row[4],
                        'updated_at'    => Carbon::now(),
                    ]);

                }

                if(is_null($product_exists)){

                    $product = \DB::table('products')->insert([
                        'name'          => $row[3],
                        'slug'          => $row[15],
                        'description'   => $row[11],
                        'image'         => $row[4],
                        'images'        => $row[5],
                        'car_brand_id'  => $brands->id,
                        'car_model_id'  => $models->id,
                        'car_year_id'   => $years->id,
                        'attributes'    => $row[6],
                        'sku'           => $row[4],
                        'created_at'    => Carbon::now(),
                    ]);

                }

            }
            
        }
        
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
