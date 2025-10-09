<?php

namespace App\DataTables;

use App\Models\NombresCargo;
use App\Models\NombresCargos;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NombresCargosDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', 'nombrescargos.action')
            ->addColumn('action', '<div>
                            <a href="{{ route(\'nombresCargos.edit\', $id )}}" class="btn btn-sm btn-alt-primary" title="Editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route(\'users.destroy\', $id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-alt-danger" title="Eliminar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    ');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(NombresCargos $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('nombrescargos-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    //->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        // Button::make('pdf'),
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
            Column::make('id'),
            Column::make('nombre_cargo'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(500)
                  ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
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
        return 'NombresCargos_' . date('YmdHis');
    }
}
