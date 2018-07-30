<?php

namespace App\Admin\Controllers\Managers;

use App\Http\Controllers\Controller;
use App\PosDay;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Hi ' . Admin::user()->name);
            $content->description('Let\'s get to work!');

            $pos_day = PosDay::active();
            $day_open = null;

            if($pos_day == null){
                $day_open = null;
                $content->row('No days Open');
            }
            else if($pos_day instanceof PosDay){
                $day_open  = 'single';
                $content->row("Current Pos : ".$pos_day->pos_date);
            }
            else {
                $day_open = 'multiple';
                $content->row('MULTIPLE DAYS OPEN');
            }


            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {

                });

                $row->column(4, function (Column $column) {

                });

                $row->column(4, function (Column $column) {

                });
            });
        });
    }
}
