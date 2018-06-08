<?php

namespace App\Admin\Controllers;

use App\Item;

use App\Vendor;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ItemController extends Controller
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
        return Admin::grid(Item::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name()->sortable();
            $grid->price()->sortable();
            $grid->quantity()->sortable();
            $grid->vendor()->display(function($vendor_id) {
                return Vendor::find($vendor_id)->name;
            });

            $grid->is_active()->sortable();
            $grid->type()->sortable();

            $grid->filter(function ($filter) {

                // Sets the range query for the created_at field
                $filter->like('name', 'Name');
                $filter->between('price', 'Price');
                $filter->between('quantity', 'Quantity');
                $filter->like('vendor', 'Vendor');
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
        return Admin::form(Item::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name', 'Name');
            $form->text('brand_name', 'Brand');
            $form->decimal('price', 'Price');
            $form->decimal('quantity', 'Quantity');
            $form->switch('is_active', 'Is Active?');

            //Get the list of vendor options
            $vendors_options = [];
            $vendors = Vendor::where('is_active', 1)->get();
            foreach ($vendors as $vendor)
                $vendors_options[$vendor->id] = $vendor->name;

            $form->select('vendor_id', 'Vendor')->options($vendors_options);

            $form->text('type');
            $form->text('unit');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
