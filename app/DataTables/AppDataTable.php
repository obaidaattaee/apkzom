<?php

namespace App\DataTables;

use App\Models\App;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class AppDataTable extends DataTable
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
            ->editColumn('title', function ($row) {
                return $row->getTranslation('title', app()->getLocale(), false) ?
                    $row->getTranslation('title', app()->getLocale(), false) :
                    __('common.no_translation');
            })
            ->editColumn('description', function ($row) {
                return $row->getTranslation('description', app()->getLocale(), false) ?
                    $row->getTranslation('description', app()->getLocale(), false) :
                    __('common.no_translation');
            })
            ->editColumn('category', function ($row) {
                return object_get($row, 'category.title');
            })
            ->editColumn('tags', function ($row) {
                $tags = "";
                foreach (object_get($row, 'tags') as $tag) {
                    $tags = $tags . object_get($tag, 'title') . ' , ';
                }
                return $tags;
            })
            ->editColumn('owner', function ($row) {
                return object_get($row, 'owner.name');
            })
            ->addColumn('action', 'admin.apps.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\App $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(App $model)
    {
        return $model->with(['category', 'tags', 'owner'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('app-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'title',
            'description',
            'size',
            'original_link',
            'extension',
            'category',
            'tags',
            'owner',
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'App_' . date('YmdHis');
    }
}
