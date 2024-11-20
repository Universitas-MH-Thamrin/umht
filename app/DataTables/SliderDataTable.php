<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Club;
use App\Models\Slider;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
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
                    return '<img src="'. MyHelper::get_avatar($data->image) .'" style="width: 50px;">';
                }

                return '';
            })
            ->editColumn('tombol', function($data) {
                return "<a href='". $data->btn_link ."' target='_blank' class='btn btn-sm btn-primary'>". $data->btn_text ."</a>";
            })
            ->editColumn('created_at', function($data) {
                return Carbon::parse($data->expired_at)->format('d M Y');
            })
            ->editColumn('visible', function($data) {
                return $data->visible ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.slider.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        <form action='" . route('dashboard.slider.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'image', 'tombol', 'visible']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SliderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
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
                    ->setTableId('Sliderdatatable-table')
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
            Column::make('image'),
            Column::make('title'),
            Column::make('subtitle'),
            Column::make('visible'),
            Column::computed('tombol')->title('Tombol'),
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
        return 'Slider_' . date('YmdHis');
    }
}
