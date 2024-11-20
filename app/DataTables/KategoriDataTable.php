<?php

namespace App\DataTables;

use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KategoriDataTable extends DataTable
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
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.kategori.edit', $data->id) . "' class='btn btn-sm btn-secondary mr-1'>
                        <i class='fas fa-pencil-alt'></i> &nbsp&nbsp Edit
                        </a>
                        <form action='" . route('dashboard.kategori.destroy', $data->id) . "' method='post' style='display: inline-block;'>
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
     * @param \App\Models\KategoriDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Kategori $model)
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
                    ->setTableId('Kategoridatatable-table')
                    ->columns($this->getColumns())
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export', 'print', 'reload'],
                    ])
                    ->minifiedAjax()
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
            Column::make('nama')->title('Nama Kategori'),
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
        return 'Kategori_' . date('YmdHis');
    }
}
