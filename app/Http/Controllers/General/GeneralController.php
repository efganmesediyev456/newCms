<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Brand;
use DB;

class GeneralController extends Controller
{
    public function changeStatus(Request $request){
       try{
           if($request->model==''){
               return $this->responseMessage('error', 'Model not found!', null, 404);
           }
           if($request->id==''){
               return $this->responseMessage('error', 'Id not found!', null, 404);
           }
           $model = app($request->model);
           $item = $model::find($request->id);
           if(empty($item)){
               return $this->responseMessage('error', 'Item not found!', null, 404);
           }
           $item->status = $request->status;
           $item->save();
           if($item){
               return $this->responseMessage('success', 'Status uğurla dəyişdirildi', $item);
           }
       }catch(\Exception $e){
           return $this->responseMessage('error', $e->getMessage(), null, 404);
       }
    }
}
