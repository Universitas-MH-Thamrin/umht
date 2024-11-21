<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Page;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class PageDataTable extends DataTable
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
            ->editColumn('created_at', function($data) {
                return Carbon::parse($data->expired_at)->format('d M Y');
            })
            ->editColumn('nama', function($data) {
                $str = '<b>' . Str::limit(strip_tags($data->nama), 100) . '</b>';
                $str .= '<br>' . Str::limit(strip_tags($data->konten), 100);
                return $str;
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a target='_blank' href='" . route('page.show', $data->slug) . "' class='btn btn-sm btn-info me-1'>
                        View
                        </a>
                        <a href='" . route('dashboard.page.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        <form action='" . route('dashboard.page.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'nama', 'konten']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PageDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Page $model)
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
                    ->setTableId('Pagedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'desc');
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
            Column::make('id')->hidden(),
            Column::make('nama'),
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
        return 'Page_' . date('YmdHis');
    }
}
