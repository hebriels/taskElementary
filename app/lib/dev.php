<?php
    function bugs($var)
    {
        echo '<pre style="margin: 0 50px;">';
        var_dump($var);
        echo '</pre>';
    }

    function getLabelStatus($labelStatus)
    {
        switch ($labelStatus){
            case '1':
                return '<span class="btn btn-sm btn-label-success">Выполнено</span>';
                break;
            default:
                return '<span class="btn btn-sm btn-label-brand">Новая задача</span>';
                break;
        }
    }

    function getLabelModerate($labelModerate)
    {
        switch ($labelModerate){
            case '1':
                return '<span class="btn btn-sm btn-label-warning">Отредактировано администратором</span>';
                break;
            default:
                return '';
                break;
        }
    }

