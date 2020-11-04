<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\AttendeesImport;
use Excel;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;


class ImportController extends Controller
{
    //

    public function importView(Content $content)
    {
        return $content
                ->title('Import Excel')
                ->row(function (Row $row) {

                    $row->column(12, function (Column $column) {
                        $column->append(view("import"));
                    });
                });
       //return view('import');
    }

    public function import(Request $request) {
        try {
            Excel::import(new AttendeesImport, request()->file('file'));
        } catch ( \Illuminate\Database\QueryException  $ex ) {
            
            //echo "<script>alert('Primary Email must be unique!');</script>";
            $request->session()->flash('import_error', 'Primary Email must be unique!');
            return back();
        }
        
       return back();
    }   
}
