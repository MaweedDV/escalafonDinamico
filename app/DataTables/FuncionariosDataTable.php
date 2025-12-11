<?php

namespace App\DataTables;

use App\Models\Funcionario;
use App\Models\Funcionarios;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FuncionariosDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            //->addColumn('action', 'funcionarios.action')
            ->editColumn('fecha_decreto', function ($row) {
                return $row->fecha_decreto ? \Carbon\Carbon::parse($row->fecha_decreto)->format('d-m-Y') : '';
            })
            ->editColumn('antiguedad_cargo', function ($row) {
                return $row->antiguedad_cargo ? \Carbon\Carbon::parse($row->antiguedad_cargo)->format('d-m-Y') : '';
            })
            ->editColumn('antiguedad_grado', function ($row) {
                return $row->antiguedad_grado ? \Carbon\Carbon::parse($row->antiguedad_grado)->format('d-m-Y') : '';
            })
            ->editColumn('antiguedad_mismo_municipio', function ($row) {
                return $row->antiguedad_mismo_municipio ? \Carbon\Carbon::parse($row->antiguedad_mismo_municipio)->format('d-m-Y') : '';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y H:i:s') : '';
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at ? \Carbon\Carbon::parse($row->updated_at)->format('d-m-Y H:i:s') : '';
            })
            ->setRowId('id')
            ->addColumn('action',
            '<div>
                <a href="{{ route(\'funcionarios.edit\', $id )}}" class="btn btn-sm btn-alt-primary" title="Editar"><i class="fa fa-edit"></i></a>
                <form action="{{ route(\'funcionarios.destroy\', $id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method(\'DELETE\')
                    <button type="submit" class="btn btn-sm btn-alt-danger" title="Desactivar"><i class="fa fa-user-slash"></i></button>
                </form>
                <script type="module">
                $(document).ready(function() {
                    $(".btn-alt-danger").on("click", function(e) {
                        e.preventDefault();
                        var $button = $(this);
                        Swal.fire({
                            title: "¿Estás seguro?",
                            text: "Una vez eliminado, no podrás recuperar este registro!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#6f9c40",
                            cancelButtonColor: "#e04f1a",
                            confirmButtonText: "Sí, eliminarlo",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $button.parent().submit();
                                // update datatable
                                table.draw();
                            }
                        });
                    });
                });
                </script>
            </div>');


    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Funcionarios $model): QueryBuilder
    {
        return $model->with(['CargosEscalafone'])->newQuery()
            ->join('cargos_escalafons', 'funcionarios.id_Cargo', '=', 'cargos_escalafons.id')
            ->join('nombres_cargos', 'cargos_escalafons.Id_nombresCargos', '=', 'nombres_cargos.id')
           // ->join('profesions', 'funcionarios.educacion_formal', '=', 'profesions.id')
            //->select('funcionarios.*','cargos_escalafons.grado','nombres_cargos.nombre_cargo');
            ->select('funcionarios.*','cargos_escalafons.grado as cargo_grado', 'nombres_cargos.nombre_cargo as nombreCargo' )
            ;

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('funcionarios-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->scrollX()
                    ->responsive(true)
                    //->selectStyleSingle()

                    //PARAMETRO PARA AGREGAR FILTRO CUADRO DE BUSQUEDA
                    // ->parameters([
                    //    'initComplete' => 'function () {
                    //         this.api().columns().every(function () {
                    //             var column = this;
                    //             var input = document.createElement("input");
                    //             input.placeholder = "Filtrar";
                    //             input.style.width = "100%";
                    //             input.style.margin = "0 auto";
                    //             input.style.display = "block";
                    //             input.style.padding = "5px";
                    //             input.style.border = "1px solid #ccc";
                    //             input.style.borderRadius = "4px";
                    //             input.style.boxSizing = "border-box";
                    //             input.style.fontSize = "14px";
                    //             input.style.color = "#333";
                    //             input.style.backgroundColor = "#f9f9f9";
                    //             input.style.transition = "border-color 0.3s ease";
                    //             input.style.outline = "none";
                    //             input.style.boxShadow = "0 0 5px rgba(0, 0, 0, 0.1)";
                    //             input.style.marginBottom = "10px";
                    //             input.style.marginTop = "10px";
                    //             $(input).appendTo($("thead tr:eq(1) th").eq(column.index()))
                    //                 .on("keyup change", function () {
                    //                     if (column.search() !== this.value) {
                    //                         column.search(this.value).draw();
                    //                     }
                    //                 });
                    //         });
                    //     }',
                    // ])
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
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
             Column::computed('action')
            ->title('Opciones')
              ->exportable(false)
              ->printable(false)
              ->width(150)
              ->addClass('text-center'),
            Column::make('decreto'),
            Column::make('fecha_decreto'),
            Column::make('rut'),
            Column::make('nombre'),
            Column::make('apellido_paterno'),
            Column::make('apellido_materno'),
            Column::make('nombreCargo')->name('nombres_cargos.nombre_cargo')->title('Cargo'),
            Column::make('cargo_grado')->name('cargos_escalafons.grado')->title('Grado'),
            Column::make('calificacion'),
            Column::make('lista'),
            Column::make('antiguedad_cargo'),
            Column::make('antiguedad_grado'),
            Column::make('antiguedad_mismo_municipio'),
            Column::make('antiguedad_mismo_municipio_detalle'),
            Column::make('antiguedad_administracion_estado'),
           // Column::make('profesion')->name('profesions.profesion')->title('Educacion Formal'),
            Column::make('estado'),
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
        return 'Funcionarios_' . date('YmdHis');
    }
}
