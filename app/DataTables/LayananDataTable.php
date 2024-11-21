<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Club;
use App\Models\Layanan;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LayananDataTable extends DataTable
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
            ->editColumn('icon', function($data) {
                if ($data->icon) {
                    return '<img src="'. MyHelper::get_avatar($data->icon) .'" style="width: 50px;">';
                }

                return '';
            })
            ->editColumn('link', function($data) {
                return '<a target="_blank" href="'. $data->link .'">Akses Link</a>';
            })
            ->editColumn('visible', function($data) {
                return $data->visible ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.layanan.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        <form action='" . route('dashboard.layanan.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'icon', 'tombol', 'link', 'visible']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LayananDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Layanan $model)
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
                    ->setTableId('Layanandatatable-table')
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
            Column::make('urutan'),
            Column::make('icon'),
            Column::make('nama'),
            Column::make('deskripsi'),
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
        return 'Layanan_' . date('YmdHis');
    }
}
