<?php

namespace app\controllers;

use app\core\Controller;

class AjaxController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'ajax';
    }

    function clean($value)
    {
        $value = trim($value); //пробелы в начале и в конце
        $value = stripslashes($value); //убрать экранирование
        $value = strip_tags($value); //удаляем теги HTML и PHP из строки
        $value = htmlspecialchars($value); //убрать спецсимволы
        return $value;
    }

    public function ajaxpostAction()
    {
        if(isset($_POST['mainAjax'])){
            switch ($_POST['mainAjax']){
                case 'testLogin':
                    if(isset($_SESSION['cab'])){
                        echo json_encode(true);
                    }else{
                        echo json_encode(false);
                    }
                    break;
                case 'loginValidate':
                    if(!$this->model->loginValidate()){
                        echo json_encode('incorrect');
                        break;
                    }else{
                        $_SESSION['cab'] = $this->model->cab[0];
                        echo json_encode('correct');
                    }
                    break;
                case 'logoutAction':
                    unset($_SESSION['cab']);
                    break;
                case 'addTask':
                    $nameAddTask = $this->clean($_POST['nameAddTask']);
                    $emailAddTask = $this->clean($_POST['emailAddTask']);
                    $textAddTask = $this->clean($_POST['textAddTask']);
                    $resultTask = $this->model->addTask($nameAddTask,$emailAddTask,$textAddTask);

                    $data = array(
                        'resultTask' => $resultTask
                    );
                    echo json_encode($data);
                    break;
                case 'editTask':
                    $textEditTask = $this->clean($_POST['textEditTask']);
                    $resultTask = $this->model->editTask($_POST['taskID'],$textEditTask);
                    if($resultTask==1){
                        $this->model->editAdmin($_POST['taskID']);
                    }
                    $data = array(
                        'resultTask' => $resultTask
                    );
                    echo json_encode($data);
                    break;
                case 'editStatus':
                    $this->model->editStatus($_POST['taskID']);
                    echo json_encode(true);
                    break;
                case 'dataTableAjax':
                    $resultAjax = $this->model->dataTableAjax();
                    $arrData = [];
                    foreach ($resultAjax as $oneTask){
                        $labelStatus = getLabelStatus($oneTask['statusTask']);
                        $labelModerate = getLabelModerate($oneTask['moderateTask']);
                        $btnReview = '<div class="btn-group btn-group" role="group">
                                        <a href="javascript:;"
                                           class="btn btn-sm btn-brand btn-icon btnTaskEdit" data-idtask="'.$oneTask['id'].'" data-texttask="'.$oneTask['textTask'].'">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:;"
                                           class="btn btn-sm btn-success btn-icon btnTaskSuccess" data-idtask="'.$oneTask['id'].'">
                                            <i class="fas fa-thumbs-up"></i>
                                        </a>
                                    </div>';
                        $arrData[] = [
                            'tableTasks-id' => $oneTask['id'],
                            'tableTasks-nameUser' => $oneTask['userTask'],
                            'tableTasks-email' => $oneTask['emailTask'],
                            'tableTasks-textTask' => $oneTask['textTask'],
                            'tableTasks-status' => $labelStatus.$labelModerate,
                            'tableTasks-action' => $btnReview
                        ];
                    }
                    $data = array(
                        'arrData' => json_encode($arrData)
                    );
                    echo json_encode($data);
                    break;
            }
        }
    }
}