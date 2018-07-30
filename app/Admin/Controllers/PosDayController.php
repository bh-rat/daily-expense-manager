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
            $grid->opening_balance_match()->sortable()->editable();
            $grid->opening_cash_in_drawer()->sortable()->editable();
            $grid->opening_notes()->sortable()->editable();
            $grid->expense()->sortable()->editable();
            $grid->difference()->sortable()->editable();
            $grid->closing_cash_in_drawer()->sortable()->editable();
            $grid->closing_notes()->sortable()->editable();
            $grid->opened_by_user_id()->display(function($opened_by_user_id){
                return User::find($opened_by_user_id)->name;
            })->sortable()->editable();
            $grid->closed_by_user_id()->display(function($closed_by_user_id){
                if($closed_by_user_id!=null)
                    return User::find($closed_by_user_id)->name;
                else
                    return null;
            })->sortable()->editable();

            $grid->filter(function ($filter) {

                // Sets the range query for the created_at field
                $filter->between('pos_date', 'Pos Date');
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

            $form->date('pos_date');   //date of the pos
            $form->switch('opening_balance_match');   //date of the pos
            $form->textarea('opening_notes');  //Notes for the day while opening
            $form->textarea('closing_notes');  //Notes for the day while closing
            $form->number('opening_cash_in_drawer'); //cash in drawer in the start of the day
            $form->number('expense'); //total expense in a day
            $form->number('closing_cash_in_dawer'); //cash in drawer in the end of the day
            $users_options = [];
            $users = User::orderBy('id', 'desc')->get();
            foreach($users as $user)
                $users_options[$user->id] = $user->name;
            $form->select('opened_by_user_id', 'User(Opened By)')->options($users_options);
            $form->select('closed_by_user_id', 'User(Closed By)')->options($users_options);
            $form->number('difference'); //difference between the expected and actual cash.

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
