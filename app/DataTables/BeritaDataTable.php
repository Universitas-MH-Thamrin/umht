<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Club;
use App\Models\Berita;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class BeritaDataTable extends DataTable
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
            ->editColumn('thumbnail', function($data) {
                if ($data->thumbnail) {
                    return '<img src="'. MyHelper::get_avatar($data->thumbnail) .'" style="width: 150px;">';
                }

                return '';
            })
            ->editColumn('judul', function($data) {
                $str = '<b>' . Str::limit(strip_tags($data->judul), 100) . '</b>';
                $str .= '<br>' . Str::limit(strip_tags($data->deskripsi), 100);
                return $str;
            })
            ->editColumn('kategori', function($data) {
                return $data->kategori->nama;
            })
            ->editColumn('visible', function($data) {
                return $data->visible ? '<span class="badge bg-success text-white">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.berita.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        <form action='" . route('dashboard.berita.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'judul', 'visible', 'thumbnail', 'deskripsi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BeritaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Berita $model)
    {
        return $model->with('kategori')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Beritadatatable-table')
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
            Column::make('thumbnail'),
            Column::make('judul'),
            Column::make('kategori')->name('kategori.nama'),
            Column::make('visible')->title("Publish?"),
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
        return 'Berita_' . date('YmdHis');
    }
}
