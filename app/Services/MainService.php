<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class MainService
{
    public $model;

    public function getAll()
    {
        return $this->model::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function getById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $model = $this->getById($id);
        $model->update($data);
        return $model->fresh();
    }

    public function delete(int $id)
    {
        $this->model::destroy($id);
    }

    public function getData(string $table, $showButton=false)
    {
        $items = $this->model::query()->orderBy('id', 'desc');
        return DataTables::of($items)
            ->addColumn('action', function($item) use($table, $showButton) {
                $firstClass = !$showButton ? "mx-1" : "";
                $html = '';
                    $html .= '<a href="' . route($table . '.edit', $item->id) . '" class="btn btn-success btn-sm d-inline-block '.$firstClass.'" data-toggle="tooltip" data-placement="top" title="Dəyişdir"> <i class="fas fa-edit"></i></a>';
                    if($showButton) {
                        $html .= '<a href="' . route($table . '.show', $item->id) . '" class="btn btn-primary d-inline-block  mx-1 btn-sm" data-toggle="tooltip" data-placement="top" title="Detallı bax"> <i class="fas fa-eye"></i></a>';
                    }
                    $html .= '<a href="' . route($table . '.delete', $item->id) . '" class="btn btn-danger btn-sm deleteButton" data-toggle="tooltip" data-placement="top" title="Sil"> <i class="fas fa-trash"></i></a>';
                return $html;
            })
            ->make(true);
    }
}
