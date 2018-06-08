<?php

namespace App\Admin\Controllers;

use App\PosDay;

use App\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PosDayController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Details of POS Day');
            $content->description('Details of each pos_day including who started and closed the day on the web app.');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(PosDay::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->pos_date('Pos Date')->sortable();
            $grid->opening_balance_match()->sortable();
            $grid->opening_cash_in_drawer()->sortable();
            $grid->expense()->sortable();
            $grid->difference()->sortable();
            $grid->closing_cash_in_drawer()->sortable();
            $grid->opened_by()->display(function($opened_by_user_id){
                return User::find($opened_by_user_id)->name;
            })->sortable();
            $grid->closed_by()->display(function($closed_by_user_id){
                return User::find($closed_by_user_id)->name;
            })->sortable();

            $grid->filter(function ($filter) {

                // Sets the range query for the created_at field
                $filter->like('name', 'Name');
                $filter->between('price', 'Price');
                $filter->between('quantity', 'Quantity');
                $filter->like('vendor', 'Vendor');
                $filter->like('opened_by', 'Opened By');
                $filter->like('closed_by', 'Closed By');
                $filter->like('vendor', 'Vendor');
                $filter->equal('opening_balance_match', 'Opening Balance Matched')->radio([
                    ''   => 'All',
                    0    => 'Matching',
                    1    => 'Not Matching'
                ]);

                $filter->between('created_at', 'Created Time')->datetime();

            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PosDay::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
