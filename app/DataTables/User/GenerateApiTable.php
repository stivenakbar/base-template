<?php

namespace App\DataTables\User;

use App\Models\PersonalTokenModel;
use App\Models\RolesModel;
use App\Models\TablesNameModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Livewire\Livewire;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GenerateApiTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query = $query->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc');

        return (new EloquentDataTable($query))
            ->addColumn('action', 'api.action')
            ->addIndexColumn()
            ->addColumn('action', function (TablesNameModel $val) {
                return Livewire::mount('pages.admin.user.generate-api.api-table-action', ['table' => $val]);
            })
            ->editColumn('created_at', function (TablesNameModel $val) {
                return $val->created_at->format('d M Y');
            })
            ->editColumn('updated_at', function (TablesNameModel $val) {
                return $val->updated_at->format('d M Y');
            })
            ->editColumn('api_list', function (TablesNameModel $val) {
                $routes = $val->api_list;
                if ($routes === null || empty($routes)) {
                    $routes = ['-'];
                }
                $listItems = array_map(function ($route) {
                    return "<li>$route</li>";
                }, $routes);
                return '<ul>' . implode('', $listItems) . '</ul>';
            })
            ->rawColumns(['action', 'api_list'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TablesNameModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('api-table')
            ->columns($this->getColumns())
            ->minifiedAjax(script: "
                data._token = '" . csrf_token() . "';
                data._p = 'POST';
            ")
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallbackWithLivewire(file_get_contents(public_path('assets/js/custom/table/_init.js')))
            ->select(false)
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed("DT_RowIndex")
                ->title("No.")
                ->width(20),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
            Column::make('name'),
            Column::make('api_list'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tokens_' . date('YmdHis');
    }
}
