<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\HeroBanner;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Str;
use Yajra\DataTables\Services\DataTable;

class HeroBannerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('image', function($data) {
                if ($data->image) {
                    return '<img src="'. MyHelper::get_avatar($data->image) .'" style="width: 200px;">';
                }

                return '';
            })
            ->editColumn('link', function($data) {
                return '<a target="_blank" href="'. $data->link .'">Akses Link</a>';
            })
            ->editColumn('title', function($data) {
                $str = '<b>' . Str::limit(strip_tags($data->title), 100) . '</b>';
                $str = '<b>' . Str::limit(strip_tags($data->subtitle), 100) . '</b>';
                $str .= '<br>' . Str::limit(strip_tags($data->desc), 100);
                return $str;
            })
            ->editColumn('visible', function($data) {
                return $data->visible ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <form action='" . route('dashboard.hero_banner.set_active', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('PUT') . "
                            <button type='submit' class='btn btn-sm btn-primary me-1'>
                                Set Aktif
                            </button>
                        </form>
                        <a href='" . route('dashboard.hero_banner.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        <form action='" . route('dashboard.hero_banner.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'title', 'image', 'tombol', 'link', 'visible']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HeroBannerDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HeroBanner $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('HeroBannerdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'asc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex', '#')->width("10px"),
            Column::make('image'),
            Column::make('nama'),
            Column::make('title'),
            Column::make('link'),
            Column::make('visible'),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(140)
                    ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HeroBanner_' . date('YmdHis');
    }
}
