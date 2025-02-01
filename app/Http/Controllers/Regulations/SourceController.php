<?php

namespace App\Http\Controllers\Regulations;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CallStatus;
use App\Models\OrderStatus;
use App\Models\Source;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SourceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service->model = Source::class;
    }

    public function index()
    {
        $title = 'Mənbə';
        $route = route('sources.index');
        $routeCreate = route('sources.create');
        $datatableRoute = route('sources.datatable');
        return view('pages.sources.index', compact('route', 'routeCreate', 'datatableRoute', 'title'));
    }

    public function getData()
    {
        return $this->service->getData('sources');
    }

    public function create()
    {
        $route = route('sources.index');
        $title = 'Mənbə';
        $routePost = route('sources.store');
        return view('pages.sources.create',compact('route','title', 'routePost'));
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
            return $this->responseMessage('success', 'Mənbə uğurla yaradıldı!', $createdItem, 200, route('sources.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }

    public function edit(Request $request, $itemId)
    {
        $item = $this->service->getById($itemId);
        $route = route('sources.index');
        $title = 'Mənbə';
        $routePost = route('sources.update', $itemId);

        return view('pages.sources.edit', compact('item', 'routePost', 'title', 'route'));
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
            return $this->responseMessage('success', 'Mənbə uğurla dəyişdirildi!', $updatedItem, 200, route('sources.index'));
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
            return $this->responseMessage('success', 'Mənbə Uğurla silindi!');
        }catch(\Exception $e){
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }
}
