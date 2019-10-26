<?php

namespace app\models;

use app\core\Model;

class Ajax extends Model
{
    public $cab;
//проверяем данные при входе
    public function loginValidate()
    {
        $this->cab = $this->testLogin($_POST['loginUser']);
        if (is_null($this->cab) or empty($this->cab) or $this->cab[0]['userLogin'] != $_POST['loginUser'] or $this->cab[0]['userPassword'] != $_POST['loginPwd']) {
            return false;
        }
        return true;
    }
//проверяем логин пользователя
    public function testLogin($userLogin)
    {
        $params = ['userLogin' => $userLogin];
        return $this->db->row('SELECT * FROM users WHERE userLogin = :userLogin', $params);
    }
//получение списка задач
    public function dataTableAjax()
    {
        return $this->db->row('SELECT * FROM tasks ORDER BY id DESC');
    }
//добавление задачи
    public function addTask($nameAddTask,$emailAddTask,$textAddTask)
    {
        $params = [
            'userTask' => $nameAddTask,
            'emailTask' => $emailAddTask,
            'textTask' => $textAddTask
        ];
        return $this->db->rowCount('INSERT INTO tasks (userTask,emailTask,textTask) VALUES (:userTask,:emailTask,:textTask)',$params);
    }
//обновление задачи
    public function editTask($taskID,$textEditTask)
    {
        $params = [
            'id' => $taskID,
            'textTask' => $textEditTask
        ];
        return $this->db->rowCount('UPDATE tasks SET textTask = :textTask WHERE id = :id',$params);
    }
//отметка о редактировании задачи администратором
    public function editAdmin($taskID)
    {
        $params = [
            'id' => $taskID,
            'moderateTask' => 1
        ];
        $this->db->query('UPDATE tasks SET moderateTask = :moderateTask WHERE id = :id',$params);
    }
//редактирование статуса
    public function editStatus($taskID)
    {
        $params = [
            'id' => $taskID,
            'statusTask' => 1
        ];
        $this->db->query('UPDATE tasks SET statusTask = :statusTask WHERE id = :id',$params);
    }
}
