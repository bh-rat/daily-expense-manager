<?php

namespace App\Admin\Extensions;


use Encore\Admin\Facades\Admin;
use Illuminate\Support\Str;

class Select extends \Encore\Admin\Form\Field\Select
{

    public function load_field($field, $sourceUrl, $idField = 'id', $textField = 'text'){
        if (Str::contains($field, '.')) {
            $field = $this->formatName($field);
            $class = str_replace(['[', ']'], '_', $field);
        } else {
            $class = $field;
        }

        $script = <<<EOT
$(document).off('change', "{$this->getElementClassSelector()}");
$(document).on('change', "{$this->getElementClassSelector()}", function () {
    var target = $(this).closest('.fields-group').find(".$class");
    $.get("$sourceUrl?q="+this.value, function (data) {
        target.val(data);
    });
});
EOT;

        Admin::script($script);

        return $this;
    }

}