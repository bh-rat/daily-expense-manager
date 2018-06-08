<?php

namespace App\Admin\Controllers;

use App\Expense;

use App\Item;
use App\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ExpenseController extends Controller
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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(Expense::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->quantity()->sortable();
            $grid->rate()->sortable();
            $grid->amount()->sortable();
            $grid->item()->display(function($item_id) {
                return Item::find($item_id)->name;
            })->sortable();
            $grid->user()->display(function($user_id) {
                return User::find($user_id)->name;
            })->sortable();
            $grid->notes();
            $grid->bill_available()->sortable();

            $grid->filter(function ($filter) {

                // Sets the range query for the created_at field
                $filter->between('quantity', 'Quantity');
                $filter->between('rate', 'Rate');
                $filter->between('amount', 'Amount');
                $filter->between('quantity', 'Quantity');
                $filter->like('item', 'Item');
                $filter->like('user', 'User');
                $filter->equal('bill_available')->radio([
                    ''   => 'All',
                    0    => 'Available',
                    1    => 'Unavailable'
                ]);

                $filter->between('created_at', 'Created Time')->datetime();

            });

            $grid->created_at()->sortable();
            $grid->updated_at()->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Expense::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
