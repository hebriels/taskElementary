let formValidation = function () {
    let taskAddValidation = function () {
        let form1 = $('#formAddTask');
        form1.validate({
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                nameAddTask: {
                    required: "Имя необходимо заполнить"
                },
                emailAddTask: {
                    required: "Email необходимо заполнить"
                },
                textAddTask: {
                    required: "Текст задачи необходимо заполнить"
                }
            },
            rules: {
                nameAddTask: {
                    required: true
                },
                emailAddTask: {
                    required: true
                },
                textAddTask: {
                    required: true
                }
            }
        });
    };
    let taskEditValidation = function () {
        let form1 = $('#formEditTask');
        form1.validate({
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                textEditTask: {
                    required: "Текст задачи не может быть пустым"
                }
            },
            rules: {
                textEditTask: {
                    required: true
                }
            }
        });
    };
    return {
        init: function () {
            taskAddValidation();
            taskEditValidation();
        }
    };
}();
$(document).ready(function() {
    formValidation.init();
});