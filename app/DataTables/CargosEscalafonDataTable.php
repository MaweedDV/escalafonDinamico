<?php

namespace App\DataTables;

use App\Models\CargosEscalafon;
use App\Models\NombresCargos;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\SearchPane;
use Yajra\DataTables\Services\DataTable;

class CargosEscalafonDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            //->addColumn('action', 'cargosescalafon.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CargosEscalafon $model): QueryBuilder
    {
        //return $model->with(['NombresCargos'])->newQuery();
        return $model->with(['NombresCargos'])->newQuery()
            ->join('nombres_cargos', 'cargos_escalafons.Id_nombresCargos', '=', 'nombres_cargos.id')
            ->select('cargos_escalafons.*', 'nombres_cargos.nombre_cargo');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cargosescalafon-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        //Button::make('pdf'),
                        Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            //Column::make('id'),
            Column::make('nombres_cargos.nombre_cargo')->title('Nombre del Cargo'),
            Column::make('grado'),
            Column::make('created_at'),
            Column::make('updated_at'),
            // Column::computed('action')
            // ->exportable(false)
            // ->printable(false)
            // ->width(60)
            // ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CargosEscalafon_' . date('YmdHis');
    }
}
