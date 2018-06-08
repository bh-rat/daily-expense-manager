<?php

namespace App\Admin\Controllers;

use App\Vendor;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VendorController extends Controller
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

            $content->header('List of Vendors');
            $content->description('List of all registered vendors that are active and inactive with their contact details.');

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

            $content->header('Edit Vendor Details');
            $content->description('Please check all the details for the vendor.');

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

            $content->header('Register a new Vendor');
            $content->description('Try to add all details for the vendor.');

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
        return Admin::grid(Vendor::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name()->sortable();
            $grid->address()->sortable();
            $grid->email_id()->sortable();
            $grid->contact()->sortable();
            $grid->is_active()->sortable();

            $grid->filter(function ($filter) {

                // Sets the range query for the created_at field
                $filter->like('name', 'Name');
                $filter->like('address', 'Address');
                $filter->equal('is_active')->radio([
                    ''   => 'All',
                    1    => 'Active',
                    0    => 'Inactive'
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
        return Admin::form(Vendor::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name', 'Name');
            $form->text('address', 'Address');
            $form->text('email_id', 'Email ID');
            $form->text('contact', 'Contact');
            $form->switch('is_active', 'Is Active?');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
