<?php

namespace App\DataTables;

use App\Models\Calificacion;
use App\Models\Funcionarios;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CalificacionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('calificaciones', function ($row) {
            return '
                <div class="input-group calificacion-group" data-id="' . $row->id . '">
                    <input type="text" class="form-control editable-input" data-column="calificacion" value="'. $row->calificacion .'">
                    <button class="btn btn-sm btn-success save-btn" title="Guardar" data-column="calificacion">
                         <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                    <button class="btn btn-sm btn-secondary edit-btn d-none" title="Editar">
                         <i class="fa-solid fa-edit"></i>
                    </button>
                </div>';
        })

            ->addColumn('action', 'calificacion.action')
            ->rawColumns(['calificaciones', 'action']) // importante para que se renderice el HTML
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Funcionarios $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('calificacion-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->autoWidth(true)
                    // ->scrollX(true)
                    // ->scrollY()
                    ->responsive(true)
                    //->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        //Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id')->visible(false),
            Column::make('rut'),
            Column::make('nombre'),
            Column::make('apellido_paterno'),
            Column::make('apellido_materno'),
            Column::make('calificacion')
                ->title('Calificación')
                ->exportable(true)
                ->visible(false),
            Column::computed('calificaciones')
                ->title('Calificación')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->width(50),
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Calificacion_' . date('YmdHis');
    }
}
