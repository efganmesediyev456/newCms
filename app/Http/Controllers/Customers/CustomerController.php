<?php

namespace App\Http\Controllers\Customers;

use App\Enums\Customers\CustomerTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CustomerSaveRequest;
use App\Models\CallStatus;
use App\Models\Customer;
use App\Models\CustomerSource;
use App\Models\Media;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service->model = Customer::class;
    }

    public function index()
    {
        $title = 'Müştərilər';
        $route = route('customers.index');
        $routeCreate = route('customers.create');
        $datatableRoute = route('customers.datatable');
        return view('pages.customers.index', compact('route', 'routeCreate', 'datatableRoute', 'title'));
    }

    public function getData()
    {
        return $this->service->getData('customers');
    }

    public function create()
    {
        $route = route('customers.index');
        $title = 'Müştərilər';
        $routePost = route('customers.store');
        $customerTypeEnums = CustomerTypeEnum::cases();
        $customerSources = CustomerSource::get();
        return view('pages.customers.create',compact('route','title', 'routePost', 'customerTypeEnums', 'customerSources'));
    }

    public function store(CustomerSaveRequest $request)
    {
        DB::beginTransaction();
        try {
            $createdItem = $this->service->create($request->except('_token'));

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Faylın orijinal adını götür və timestamp əlavə et
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = time();
                    $newFilename = $filename . '_' . $timestamp . '.' . $extension;
            
                    $path = $file->storeAs('uploads/customers', $newFilename, 'public');
            
                    $createdItem->media()->create([
                        'file_path' => $path,
                        'mime_type' => $file->getClientMimeType()
                    ]);
                }
            }
            

            DB::commit();
            return $this->responseMessage('success', 'Müştərilər uğurla yaradıldı!', $createdItem, 200, route('customers.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }

    public function edit(Request $request, $itemId)
    {
        $item = $this->service->getById($itemId);
        $route = route('customers.index');
        $title = 'Müştərilər';
        $routePost = route('customers.update', $itemId);
        $customerTypeEnums = CustomerTypeEnum::cases();
        $customerSources = CustomerSource::get();
        return view('pages.customers.edit', compact('item', 'routePost', 'title', 'route', 'customerTypeEnums','customerSources'));
    }

    public function update(CustomerSaveRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = $this->service->getById($id);
            if (!$item) {
                return $this->responseMessage('error', 'Dəyər tapılmadı!', null, 404);
            }
            $updatedItem = $this->service->update($id, $request->except('_token'));

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = time();
                    $newFilename = $filename . '_' . $timestamp . '.' . $extension;
            
                    $path = $file->storeAs('uploads/customers', $newFilename, 'public');
            
                    $updatedItem->media()->create([
                        'file_path' => $path,
                        'mime_type' => $file->getClientMimeType()
                    ]);
                }
            }
            

            DB::commit();
            return $this->responseMessage('success', 'Müştərilər uğurla dəyişdirildi!', $updatedItem, 200, route('customers.index'));
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
            return $this->responseMessage('success', 'Müştəri Uğurla silindi!');
        }catch(\Exception $e){
            return $this->responseMessage('error', $e->getMessage(), null, 500);
        }
    }
}
