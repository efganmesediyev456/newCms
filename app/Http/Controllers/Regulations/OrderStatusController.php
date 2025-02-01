<?php

namespace App\Http\Controllers\Regulations;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CallStatus;
use App\Models\OrderStatus;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderStatusController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service->model = OrderStatus::class;
    }

    public function index()
    {
        $title = 'Sifariş statusları';
        $route = route('order_statuses.index');
        $routeCreate = route('order_statuses.create');
        $datatableRoute = route('order_statuses.datatable');
        return view('pages.order_statuses.index', compact('route', 'routeCreate', 'datatableRoute', 'title'));
    }

    public function getData()
    {
        return $this->service->getData('order_statuses');
    }

    public function create()
    {
        $route = route('order_statuses.index');
        $title = 'Sifariş statusları';
        $routePost = route('order_statuses.store');
        return view('pages.order_statuses.create',compact('route','title', 'routePost'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required'],[
            'title.required' => 'Başlıq daxil edin',
        ]);
        DB::beginTransaction();
        try {
            $createdItem = $this->service->create($request->except('_token'));
            DB::commit();
            return $this->responseMessage('success', 'Sifariş statusu uğurla yaradıldı!', $createdItem, 200, route('order_statuses.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }

    public function edit(Request $request, $itemId)
    {
        $item = $this->service->getById($itemId);
        $route = route('order_statuses.index');
        $title = 'Sifariş statusları';
        $routePost = route('order_statuses.update', $itemId);

        return view('pages.order_statuses.edit', compact('item', 'routePost', 'title', 'route'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ],[
            'title.required' => 'Başlıq daxil edin',
        ]);
        DB::beginTransaction();
        try {
            $item = $this->service->getById($id);
            if (!$item) {
                return $this->responseMessage('error', 'Dəyər tapılmadı!', null, 404);
            }
            $updatedItem = $this->service->update($id, $request->except('_token'));
            DB::commit();
            return $this->responseMessage('success', 'Sifariş statusu uğurla dəyişdirildi!', $updatedItem, 200, route('order_statuses.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }


    public function delete(Request $request, $brandId)
    {
        try{
            $item = $this->service->getById($brandId);
            if (!$item) {
                return $this->responseMessage('error', 'Dəyər tapılmadı!', null, 404);
            }
            $this->service->delete($brandId);
            return $this->responseMessage('success', 'Sifariş statusu Uğurla silindi!');
        }catch(\Exception $e){
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }
}
