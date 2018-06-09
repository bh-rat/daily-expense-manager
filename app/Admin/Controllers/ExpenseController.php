<?php

namespace App\Admin\Controllers;

use App\Expense;

use App\Item;
use App\PosDay;
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

            $form->decimal('quantity');
            $form->decimal('rate');
            $form->decimal('amount', 'Total Price');

            $pos_days_options = [];
            $pos_days = PosDay::orderBy('id', 'desc')->take(30)->get();
            foreach($pos_days as $pos_day)
                $pos_days_options[$pos_day->id] = $pos_day->pos_date;
            $form->select('pos_day_id', 'Pos Date')->options($pos_days_options);

            $users_options = [];
            $users = User::orderBy('id', 'desc')->get();
            foreach($users as $user)
                $users_options[$user->id] = $user->name;
            $form->select('user_id', 'User(Added By)')->options($users_options);

            $items_options = [];
            $items = Item::orderBy('name')->get();
            foreach($items as $item)
                $items_options[$item->id] = $item->name;
            $form->select('item_id', 'Item')->options($items_options);

            $form->textarea('notes');
            $form->switch('bill_available');
            $form->image('image_id', 'Bill Image')->removable();

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
