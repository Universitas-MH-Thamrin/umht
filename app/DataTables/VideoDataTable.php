<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VideoDataTable extends DataTable
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
            ->editColumn('file', function($data) {
                if ($data->file) {
                    return '<a href="'. url(Storage::url($data->file)) .'">Download</a>';
                }

                return '';
            })
            ->editColumn('folder_id', function($data) {
                return $data->folder->nama;
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.video.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        <form action='" . route('dashboard.video.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'file', 'tombol', 'visible']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VideoDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Video $model)
    {
        return $model->with('folder')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Videodatatable-table')
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
            Column::make('created_at')->title('Tgl Dibuat')->hidden(),
            Column::make('nama'),
            Column::make('folder_id')->name('folder.nama'),
            Column::make('file'),
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
        return 'VideoVideo_' . date('YmdHis');
    }
}
