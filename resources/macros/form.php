<?php

Form::macro('myInput', function ($type="text", $name, $label="", $options=[], $default = null) {
    $label = ($label =='') ? '' : html_entity_decode(Form::label($name, $label));
    return "
        <div class='form-group'>
            ". $label .
              Form::input($type, $name, $default, array_merge(["class" => "form-control"], $options)). "
        </div>
    ";
});

Form::macro('mySelect', function ($name, $label="", $values=[], $selected=null, $options=[]) {
    $label = ($label =='') ? '' : html_entity_decode(Form::label($name, $label));
    return "
        <div class='form-group'>
            ". $label .
              Form::select($name, $values, $selected, array_merge(["class" => "form-control"], $options)). "
        </div>
    ";
});

Form::macro('myFile', function ($name, $label="", $options=[]) {
    $label = ($label =='') ? '' : html_entity_decode(Form::label($name, $label));
    return "
        <div class='form-group'>
            ". $label .
              Form::file($name, array_merge(["class" => "form-control-file"], $options)). "
        </div>
    ";
});

Form::macro('myTextArea', function ($name, $label="", $options=[], $default = null) {
    $label = ($label =='') ? '' : html_entity_decode(Form::label($name, $label));
    return "
        <div class='form-group'>
            ". $label .
              Form::textarea($name, $default, array_merge(["class" => "form-control", "rows"=> 3], $options)). "
        </div>
    ";
});

Form::macro('myCheckbox', function ($name, $label="", $value='', $checked=false, $options=[]) {
    return "
        <div class='checkbox checkbox-circle checkbox-info peers ai-c mB-15'>
            ".
                Form::checkbox($name, $value, $checked, ['id' => $name] + $options)
            ."
            <label for='$name' class='peers peer-greed js-sb ai-c'>
                <span class='peer peer-greed'>$label</span>
            </label>
        </div>
    ";
});

Form::macro('myRange', function ($name, $start, $end, $selected='', $options=[]) {
    return "
        <div class='form-group'>
            " . Form::selectRange($name, $start, $end, $selected, array_merge(["class" => "form-control"], $options)). "
        </div>
    ";
});




///// ELZAHABY INPUT
//Form::macro('elzahaby', function ($type="text", $name, $label="",$value='', $checked=false,$values=[], $selected=null, $options=[], $default = null) {
//    $label = ($label =='') ? '' : html_entity_decode(Form::label($name, $label));
//
//    if ($type == 'text'){
//    return "
//        <div class='form-group'>
//            ". $label .
//        Form::input($type, $name, $default, array_merge(["class" => "form-control"], $options)). "
//        </div>
//    ";
//    }elseif ($type == 'textarea'){
//        return "
//        <div class='form-group'>
//            ". $label .
//            Form::textarea($name, $default, array_merge(["class" => "form-control", "rows"=> 4], $options)). "
//        </div>
//    ";
//    }elseif ($type == 'file'){
//        return "
//        <div class='form-group'>
//            ". $label .
//            Form::file($name, array_merge(["class" => "form-control-file"], $options)). "
//        </div>
//        ";
//    }elseif ($type == 'range'){
//        return "
//        <div class='form-group'>
//            " . Form::selectRange($name, $start, $end, $selected, array_merge(["class" => "form-control"], $options)). "
//        </div>
//    ";
//    }elseif ($type == 'checkbox'){
//        return "
//        <div class='checkbox checkbox-circle checkbox-info peers ai-c mB-15'>
//            ".
//            Form::checkbox($name, $value, $checked, ['id' => $name] + $options)
//            ."
//            <label for='$name' class='peers peer-greed js-sb ai-c'>
//                <span class='peer peer-greed'>$label</span>
//            </label>
//        </div>
//    ";
//    }
//});
