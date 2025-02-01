<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderSaveRequest;
use App\Models\CallStatus;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Source;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service->model = Order::class;
    }

    public function index()
    {
        $title = 'Sifarişlər';
        $route = route('orders.index');
        $routeCreate = route('orders.create');
        $datatableRoute = route('orders.datatable');
        return view('pages.orders.index', compact('route', 'routeCreate', 'datatableRoute', 'title'));
    }

    public function getData()
    {
        $items = $this->service->model::query()->orderBy('id', 'desc');
        $showButton = false;
        return DataTables::of($items)
            ->addColumn('action', function($item) use($showButton ) {
                $html = '';
                $html .= '<a href="' . route(  'orders.edit', $item->id) . '" class="btn btn-success btn-sm d-inline-block" data-toggle="tooltip" data-placement="top" title="Dəyişdir"> <i class="fas fa-edit"></i></a>';
                $html .= '<a href="' . route( 'orders.show', $item->id) . '" class="btn btn-primary d-inline-block  mx-1 btn-sm" data-toggle="tooltip" data-placement="top" title="Detallı bax"> <i class="fas fa-eye"></i></a>';
                $html .= '<a href="' . route('orders.delete', $item->id) . '" class="btn btn-danger btn-sm deleteButton" data-toggle="tooltip" data-placement="top" title="Sil"> <i class="fas fa-trash"></i></a>';
                return $html;
            })->addColumn("sourceColumn", function($item){
                return $item->source?->title;
            })
            ->filterColumn("sourceColumn", function($query, $keywords){
                return $query->whereHas('source', function($q) use($keywords){
                    $q->where('title', 'like', "%{$keywords}%");
                });
            })
            ->addColumn("callStatusColumn", function($item){
                return $item->callStatus?->title;
            })
            ->filterColumn("callStatusColumn", function($query, $keywords){
                return $query->whereHas('callStatus', function($q) use($keywords){
                    $q->where('title', 'like', "%{$keywords}%");
                });
            })
            ->addColumn("orderStatusColumn", function($item){
                return $item->orderStatus?->title;
            })
            ->filterColumn("orderStatusColumn", function($query, $keywords){
                return $query->whereHas('orderStatus', function($q) use($keywords){
                    $q->where('title', 'like', "%{$keywords}%");
                });
            })
            ->make(true);
    }

    public function create()
    {
        $route = route('orders.index');
        $title = 'Sifarişlər';
        $sources  = Source::status()->get();
        $callStatuses  = CallStatus::status()->get();
        $orderStatuses = OrderStatus::status()->get();
        $routePost = route('orders.store');
        return view('pages.orders.create',compact('route','title', 'routePost', 'sources', 'callStatuses', 'orderStatuses'));
    }

    public function store(OrderSaveRequest $request)
    {
        DB::beginTransaction();
        try {
            $createdItem = $this->service->create($request->except('_token'));
            DB::commit();
            return $this->responseMessage('success', 'Sifarişlər uğurla yaradıldı!', $createdItem, 200, route('orders.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }

    public function edit(Request $request, $itemId)
    {
        $item = $this->service->getById($itemId);
        $callStatuses  = CallStatus::status()->get();
        $route = route('orders.index');
        $sources  = Source::status()->get();
        $title = 'Sifarişlər';
        $routePost = route('orders.update', $itemId);
        $orderStatuses = OrderStatus::status()->get();

        return view('pages.orders.edit', compact('item', 'routePost', 'title', 'route', 'sources','callStatuses', 'orderStatuses'));
    }

    public function update(OrderSaveRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = $this->service->getById($id);
            if (!$item) {
                return $this->responseMessage('error', 'Sifariş tapılmadı!', null, 404);
            }
            $updatedItem = $this->service->update($id, $request->except('_token'));
            DB::commit();
            return $this->responseMessage('success', 'Sifarişlər uğurla dəyişdirildi!', $updatedItem, 200, route('orders.index'));
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
            return $this->responseMessage('success', 'Sifariş Uğurla silindi!');
        }catch(\Exception $e){
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }

    public function show(Request $request, $id)
    {
        $route = route('orders.index');
        $item = $this->service->getById($id);
        $title = 'Sifarişlər';
        return view('pages.orders.show', compact('item', 'route', 'title'));
    }
}
