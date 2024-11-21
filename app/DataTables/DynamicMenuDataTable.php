<?php

namespace App\DataTables;

use App\Models\DynamicMenu;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DynamicMenuDataTable extends DataTable
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
            ->editColumn('page_id', function($data) {
                return $data->page->nama;
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.dynamic_menu.edit', $data->id) . "' class='btn btn-sm btn-secondary mr-1'>
                        <i class='fas fa-pencil-alt'></i> &nbsp&nbsp Edit
                        </a>
                        <form action='" . route('dashboard.dynamic_menu.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='fas fa-trash'></i> &nbsp&nbsp Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'icon']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DynamicMenuDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DynamicMenu $model)
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
                    ->setTableId('DynamicMenudatatable-table')
                    ->columns($this->getColumns())
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export', 'print', 'reload'],
                    ])
                    ->minifiedAjax()
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
            Column::make('code')->title('Kode'),
            Column::make('nama')->title('Nama Menu'),
            Column::make('link')->title('Link'),
            Column::make('page_id')->title('Halaman'),
            Column::make('created_at')->title('Tgl Dibuat')->hidden(),
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
        return 'DynamicMenu_' . date('YmdHis');
    }
}
