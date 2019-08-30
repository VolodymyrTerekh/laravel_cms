<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BrandsImport;
use App\Imports\ModelsImport;
use App\Imports\YearsImport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ProductsImportController extends Controller 
{

		public function index()
    {
    	$info = '';
        return view('import/index', ['info' => $info]);
    }

    public function import(Request $request) 
    {
    	$csv = $request->file('csv_file')->getRealPath();
    	$import = Excel::import(new BrandsImport, $csv);
        
        return redirect('/')->with('success', 'All good!');
    }
}