<?php

namespace App\Http\Controllers\Regulations;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CallStatus;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CallStatusController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service->model = CallStatus::class;
    }

    public function index()
    {
        $title = 'Zəng statusları';
        $route = route('call_statuses.index');
        $routeCreate = route('call_statuses.create');
        $datatableRoute = route('call_statuses.datatable');
        return view('pages.call_statuses.index', compact('route', 'routeCreate', 'datatableRoute', 'title'));
    }

    public function getData()
    {
        return $this->service->getData('call_statuses');
    }

    public function create()
    {
        $route = route('call_statuses.index');
        $title = 'Zəng statusları';
        $routePost = route('call_statuses.store');
        return view('pages.call_statuses.create',compact('route','title', 'routePost'));
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
            return $this->responseMessage('success', 'Zəng statusu uğurla yaradıldı!', $createdItem, 200, route('call_statuses.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }

    public function edit(Request $request, $itemId)
    {
        $item = $this->service->getById($itemId);
        $route = route('call_statuses.index');
        $title = 'Zəng statusları';
        $routePost = route('call_statuses.update', $itemId);

        return view('pages.call_statuses.edit', compact('item', 'routePost', 'title', 'route'));
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
            return $this->responseMessage('success', 'Zəng statusu uğurla dəyişdirildi!', $updatedItem, 200, route('call_statuses.index'));
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
            return $this->responseMessage('success', 'Zəng statusu Uğurla silindi!');
        }catch(\Exception $e){
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }
}
