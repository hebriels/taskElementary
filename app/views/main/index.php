<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="padding: 0;" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container "></div>
    </div>
    <!-- end:: Subheader -->

    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="tab-pane active" id="table1">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon"><i class="flaticon2-indent-dots"></i></span>
                        <h3 class="kt-portlet__head-title"> Все задачи </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-actions" id="addTaskBtn">
                            <a href="javascript:;" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md addTask">
                                <i class="flaticon2-add-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body" data-tablename="tableTasks">
                    <div class="table-responsive">
                        <table id="tableTasks"
                               data-sort-name="tableTasks-date" data-sort-order="desc"
                               data-show-columns="true" data-search="true"
                               data-pagination="true" data-page-size="3" data-page-list="[3, 5, 10]"
                               data-hide-unused-select-options="true"
                               data-striped="true" data-unique-id="tableTasks-id"
                               data-cookie="true" data-cookie-id-table="tableTasks">
                            <thead>
                            <tr>
                                <th data-visible="false" data-field="tableTasks-id" data-switchable="false"></th>
                                <th data-field="tableTasks-nameUser" data-align="center" data-sortable="true">имя пользователя</th>
                                <th data-field="tableTasks-email" data-align="center" data-sortable="true">email</th>
                                <th data-field="tableTasks-textTask" data-align="center" data-sortable="true">текст задачи</th>
                                <th data-field="tableTasks-status" data-align="center" data-sortable="true">статус</th>
                                <?php
                                    if(isset($_SESSION['cab'])){
                                        echo'<th data-field="tableTasks-action" data-align="center">действие</th>';
                                    }
                                ?>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal add task -->
<div class="modal fade" id="modalAddTask" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавление задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form class="kt-form" id="formAddTask" method="post" action="#">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nameAddTask" class="col-form-label">Имя<span style="color: red;"> * </span></label>
                                <input type="text" class="form-control" id="nameAddTask" name="nameAddTask">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emailAddTask" class="col-form-label">email<span style="color: red;"> * </span></label>
                                <input type="email" class="form-control" id="emailAddTask" name="emailAddTask" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-last">
                                <label for="textAddTask">Текст<span style="color: red;"> * </span></label>
                                <textarea class="form-control" name="textAddTask" id="textAddTask" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="saveAddTask">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!-- modal edit task -->
<div class="modal fade" id="modalEditTask" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Редактирование задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form class="kt-form" id="formEditTask" method="post" action="#">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-last">
                                <label for="textEditTask">Текст<span style="color: red;"> * </span></label>
                                <textarea class="form-control" name="textEditTask" id="textEditTask" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="taskID">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="saveEditTask">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let urlOne = '/ajax/ajaxpost';
        let tableTasks = 'tableTasks';

//функция при загрузке страницы для таблицы задач
        tableDefault();
        function tableDefault() {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=dataTableAjax",
                success: function (data){
                    let result = $.parseJSON(data);
                    let arrData = $.parseJSON(result.arrData);
                    $('#'+tableTasks).bootstrapTable("destroy");
                    dataTableAjax(arrData);
                }
            });
        }

        function dataTableAjax(arrData) {
            $('#'+tableTasks).bootstrapTable({
                data: arrData
            });
        }


        $('.addTask').on('click', function () {
            $('#modalAddTask').modal('show');
        });

        $('#saveAddTask').on('click',function () {
            if ($('#formAddTask').valid()) {
                let nameAddTask = $('#nameAddTask').val();
                let emailAddTask = $('#emailAddTask').val();
                let textAddTask = $('#textAddTask').val();

                let formData = new FormData();
                formData.append('mainAjax','addTask');
                formData.append('nameAddTask',nameAddTask);
                formData.append('emailAddTask',emailAddTask);
                formData.append('textAddTask',textAddTask);

                $.blockUI({
                    message: null,
                    onBlock: function() {
                        Swal.fire({
                            title: "Проверка, ожидайте!",
                            type: "info",
                            showConfirmButton: false
                        });
                    }
                });

                $.ajax({
                    url: urlOne, type: "POST", dataType: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        Swal.close();
                        $.unblockUI();
                        if(data.resultTask===1){
                            $('#modalAddTask').modal('hide');
                            Swal.fire({
                                title: "Задача добавлена!",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            tableDefault();
                        }else{
                            Swal.fire({
                                title: "Ошибка!",
                                text: "Не удается записать файл в базу!",
                                type: "warning"
                            });
                        }
                    }
                });
            }
        });
        function testLogin() {
            let resultTest = true;
            $.ajax({
                url: urlOne, type: "POST", dataType: "text", async: false,
                data: "mainAjax=testLogin",
                success: function (data) {
                    if(data !== 'true'){
                        resultTest = false;
                    }
                }
            });
            return resultTest;
        }
        $(document).on('click','.btnTaskEdit',function () {
            if(testLogin()){
                $('#taskID').val($(this).data('idtask'));
                $('#textEditTask').val($(this).data('texttask'));
                $('#modalEditTask').modal('show');
            }else{
                youNeedEnter();
            }
        });
        $(document).on('click','.btnTaskSuccess',function () {
            if(testLogin()) {
                let taskID = $(this).data('idtask');
                Swal.fire({
                    title: "Желаете установить статус ВЫПОЛНЕНО?",
                    type: "info",
                    allowOutsideClick: true,
                    showCancelButton: true,
                    cancelButtonText: "Нет",
                    confirmButtonText: "Да"
                }).then((isConfirm) => {
                    if (isConfirm.value) {
                        $.ajax({
                            url: urlOne, type: "POST", dataType: "text",
                            data: "mainAjax=editStatus&taskID=" + taskID,
                            success: function (data) {
                                tableDefault();
                            }
                        });
                    }
                })
            }else{
                youNeedEnter();
            }
        });
        function youNeedEnter() {
            Swal.fire({
                title: "Вы должны авторизоваться!",
                text: "Перезагрузите страницу и авторизуйтесь для доступа к редактированию задач!",
                type: "info",
                showConfirmButton: false
            });
        }
        $('#saveEditTask').on('click',function () {
            if(testLogin()){
                if ($('#formEditTask').valid()) {
                    let textEditTask = $('#textEditTask').val();
                    let taskID = $('#taskID').val();

                    let formData = new FormData();
                    formData.append('mainAjax','editTask');
                    formData.append('textEditTask',textEditTask);
                    formData.append('taskID',taskID);

                    $.blockUI({
                        message: null,
                        onBlock: function() {
                            Swal.fire({
                                title: "Проверка, ожидайте!",
                                type: "info",
                                showConfirmButton: false
                            });
                        }
                    });

                    $.ajax({
                        url: urlOne, type: "POST", dataType: "json",
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            Swal.close();
                            $.unblockUI();
                            console.log(data);
                            if(data.resultTask===1){
                                $('#modalEditTask').modal('hide');
                                Swal.fire({
                                    title: "Задача изменена!",
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                tableDefault();
                            }else if(data.resultTask===0){
                                $('#modalEditTask').modal('hide');
                                Swal.fire({
                                    title: "Задача не изменилась!",
                                    type: "info",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }else{
                                Swal.fire({
                                    title: "Ошибка!",
                                    text: "Не удается записать файл в базу!",
                                    type: "warning"
                                });
                            }
                        }
                    });
                }
            }else{
                youNeedEnter();
            }
        })
    })
</script>