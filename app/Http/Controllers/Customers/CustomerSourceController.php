<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\CallStatus;
use App\Models\CustomerSource;
use DB;
use Illuminate\Http\Request;

class CustomerSourceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service->model = CustomerSource::class;
    }

    public function index()
    {
        $title = 'Müştəri mənbələri';
        $route = route('customer_sources.index');
        $routeCreate = route('customer_sources.create');
        $datatableRoute = route('customer_sources.datatable');
        return view('pages.customer_sources.index', compact('route', 'routeCreate', 'datatableRoute', 'title'));
    }

    public function getData()
    {
        return $this->service->getData('customer_sources');
    }

    public function create()
    {
        $route = route('customer_sources.index');
        $title = 'Müştəri mənbələri';
        $routePost = route('customer_sources.store');
        return view('pages.customer_sources.create',compact('route','title', 'routePost'));
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
            return $this->responseMessage('success', 'Müştəri mənbələri uğurla yaradıldı!', $createdItem, 200, route('customer_sources.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }

    public function edit(Request $request, $itemId)
    {
        $item = $this->service->getById($itemId);
        $route = route('customer_sources.index');
        $title = 'Müştəri mənbələri';
        $routePost = route('customer_sources.update', $itemId);

        return view('pages.customer_sources.edit', compact('item', 'routePost', 'title', 'route'));
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
            return $this->responseMessage('success', 'Müştəri mənbələri uğurla dəyişdirildi!', $updatedItem, 200, route('customer_sources.index'));
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
            return $this->responseMessage('success', 'Müştəri mənbələri Uğurla silindi!');
        }catch(\Exception $e){
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }
}
