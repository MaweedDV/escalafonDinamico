<?php

namespace App\DataTables;

use App\Models\Profesion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProfesionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'profesion.action')
            ->setRowId('id')
            ->addColumn('action',
            '<div>
                <a href="{{ route(\'profesiones.edit\', $id )}}" class="btn btn-sm btn-alt-primary" title="Editar"><i class="fa fa-edit"></i></a>
                 <form action="{{ route(\'profesiones.destroy\', $id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method(\'DELETE\')
                    <button type="submit" class="btn btn-sm btn-alt-danger " title="Desactivar"><i class="fa fa-trash"></i></button>
                </form>
            </div>');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Profesion $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('profesion-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    //->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        // Button::make('pdf'),
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
            Column::computed('action'),
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id')->visible(false),
            Column::make('profesion'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Profesion_' . date('YmdHis');
    }
}
