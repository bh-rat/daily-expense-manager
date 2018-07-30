<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosDay extends Model
{

    /*
     * Get current PosDay
     */
    public static function active()
    {
        $active_pos_days = PosDay::where('opened_by_user_id', '!=', 0)
                                ->where('closed_by_user_id', '!=', 1)->get();
        if ($active_pos_days->count() == 0)
            return null;
        if ($active_pos_days->count() == 1)
            return $active_pos_days->first();
        if($active_pos_days->count() > 1)
            return $active_pos_days;
    }

    /*
     * Get most recently closed pos_day
     */
    public static function closed()
    {
        $pos_day = PosDay::where('closed_by_user_id', '!=', 0)
                            ->sortBy('updated_at', 'desc')->get()->first();
        return $pos_day;
    }

}
