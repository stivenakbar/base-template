<?php

namespace App\DataTables\User;

use App\Models\PersonalTokenModel;
use App\Models\RolesModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Livewire\Livewire;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GenerateTokenTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query = $query->orderBy('created_at', 'desc');

        return (new EloquentDataTable($query))
            ->addColumn('action', 'token.action')
            ->addIndexColumn()
            ->addColumn('action', function (PersonalTokenModel $val) {
                return Livewire::mount('pages.admin.user.token.token-table-action', ['personalToken' => $val]);
            })
            ->addColumn('username', function (PersonalTokenModel $val) {
                $role = RolesModel::find($val->tokenable_id);
                return $role ? $role->name : 'N/A';
            })
            ->editColumn('last_used_at', function (PersonalTokenModel $val) {
                return $val->last_used_at ?? '-';
            })
            ->editColumn('expires_at', function (PersonalTokenModel $val) {
                return $val->expires_at ?? '-';
            })
            ->editColumn('created_at', function (PersonalTokenModel $val) {
                return $val->created_at->format('d M Y');
            })
            ->editColumn('updated_at', function (PersonalTokenModel $val) {
                return $val->updated_at->format('d M Y');
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PersonalTokenModel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('token-table')
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
                ->width(60)
                ->addClass('text-center'),
            Column::make('username'),
            Column::make('name')->width('100px !important'),
            Column::make('plain_text_token')->width('100px !important'),
            Column::make('expires_at')->width('100px !important'),
            Column::make('created_at')->width('100px !important'),
            Column::make('updated_at')->width('100px !important'),
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
