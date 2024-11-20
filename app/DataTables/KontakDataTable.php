<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Club;
use App\Models\Kontak;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class KontakDataTable extends DataTable
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
            ->editColumn('visible', function($data) {
                return $data->visible ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <form action='" . route('dashboard.kontak.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'visible']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\KontakDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Kontak $model)
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
                    ->setTableId('Kontakdatatable-table')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('subject'),
            Column::make('message'),
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
        return 'Kontak_' . date('YmdHis');
    }
}
