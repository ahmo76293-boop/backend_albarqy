<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:10240',
            ],
        ]);

        try {

            Excel::import(
                new ProductsImport,
                $request->file('file')
            );

            return response()->json([
                'message' => __('product.imported'),
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => __('product.import_failed'),
                'error' => $e->getMessage(),
            ], 422);
        }
    }
}
