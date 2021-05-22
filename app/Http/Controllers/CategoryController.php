<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            return Datatables::of(Category::orderBy('id')->get())
                // ->addColumn('action', function($data){
                //     return '<ul class="icons-list">
                //                 <li>
                //                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                //                         <i class="icon-menu9"></i>
                //                     </a>
                //                     <ul class="dropdown-menu dropdown-menu-right text-center">
                //                         <li>
                //                             <a href="/admin/category-leave/'.$data->id .'/edit"><i class="icon-pencil5 text-primary"></i> Edit</a>
                //                         </li>
                //                         <li>
                //                             <a href="javascript:void(0)" id="delete" data-id="'.$data->id.'"><i class="icon-bin text-danger"></i> Hapus</a>
                //                         </li>
                //                     </div>
                //                 </li>
                //             </ul>';
                // })
                // ->editColumn('type_leave_id', function($drawings) {
                //     return $drawings->typeLeave->type_leave;
                // })
                ->make(true);
        }

        return view('admin.category.index');
    }
}
