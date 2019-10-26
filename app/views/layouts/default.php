<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Список задач">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Exo+2:300,400,500,600,700"]},
            active: function() {sessionStorage.fonts = true;}});
    </script>

    <link href="/assets/vendors/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <link href="/assets/vendors/plugins/bootstrap-table/bootstrap-table.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendors/plugins/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />

    <script src="/assets/vendors/plugins/jquery/dist/jquery.js" type="text/javascript"></script>
    <title>Список задач</title>
    <link rel="canonical" href="/" />
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent">

<!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__brand">
            <a class="kt-header-mobile__logo" href="/">
                <img alt="Logo" src="/assets/media/logos/task_dark.png" height="40" style="padding-top: 8px;"/>
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <?php if(isset($_SESSION['cab'])){
                echo '<div class="kt-notification__custom kt-space-between">
                                                <a href="javascript:;" class="btn btn-label btn-label-brand btn-sm btn-bold logout">Выход</a>
                                            </div>';
            }else{
                echo '<div class="kt-notification__custom kt-space-between"><a href="javascript:;" class="btn btn-label btn-label-brand btn-sm btn-bold" data-toggle="modal" data-target="#loginmodal">Вход</a></div>';
            }?>
        </div>
    </div>
    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                        <div class="kt-header-logo">
                            <a href="/">
                                <img alt="Logo" src="/assets/media/logos/task_dark.png" height="40" style="padding-top: 8px;">
                            </a>
                        </div>
                    </div>
                    <div class="kt-header__topbar">
                        <!-- Панель пользователя -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-offset="10px,10px">
                                <div class="kt-header__topbar-user">
                                    <?php if(isset($_SESSION['cab'])){
                                        echo '<div class="kt-notification__custom kt-space-between">
                                                <a href="javascript:;" class="btn btn-label btn-label-brand btn-sm btn-bold logout">Выход</a>
                                            </div>';
                                    }else{
                                        echo '<div class="kt-notification__custom kt-space-between"><a href="javascript:;" class="btn btn-label btn-label-brand btn-sm btn-bold" data-toggle="modal" data-target="#loginmodal">Вход</a></div>';
                                    }?>
                                </div>
                            </div>
                        </div>
                        <!-- #Панель пользователя -->
                    </div>
                </div>

                <!-- end:: Header -->
                <script src="/assets/vendors/plugins/jquery/dist/jquery.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/js-cookie/src/js.cookie.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery-validation/jquery.validate.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery-validation/additional-methods.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery-validation/jquery-validation.init.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/jquery-validation/localization/messages_ru.js" type="text/javascript"></script>
                <script src="/assets/js/validTask.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/fontawesome-free/js/all.min.js"></script>
                <script src="/assets/vendors/plugins/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-table/bootstrap-table.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-table/extensions/cookie/bootstrap-table-cookie.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.js" type="text/javascript"></script>
                <script src="/assets/vendors/plugins/bootstrap-table/bootstrap-table-ru-RU.js" type="text/javascript"></script>

                <script>
                    let KTAppOptions = '';
                    KTAppOptions = {
                        "colors":{
                            "state":{
                                "brand":"#2c77f4",
                                "light":"#ffffff",
                                "dark":"#282a3c",
                                "primary":"#5867dd",
                                "success":"#34bfa3",
                                "info":"#36a3f7",
                                "warning":"#ffb822",
                                "danger":"#fd3995"
                            },
                            "base":{
                                "label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],
                                "shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]
                            }
                        }
                    };
                </script>

                <?php echo $content; ?>

                <!-- begin:: Footer -->
                <div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer">
                    <div class="kt-container mt-4">
                        <div class="kt-footer__copyright">
                            2019&nbsp;©&nbsp;<a href="http://task.planetadmin.ru/" target="_blank" class="kt-link">Список задач</a>
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>

    <!-- Вход -->
    <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Войти в личный кабинет</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ajaxLogin">
                        <form id="form" action="javascript:;" method="post">
                            <div class="form-group ">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon-avatar"></i></span></div>
                                    <input type="text" class="form-control" placeholder="Логин" id="login_user" name="login_user">
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="form-group ">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon-lock"></i></span></div>
                                    <input type="password" class="form-control" placeholder="Пароль" id="login_pwd" name="login_pwd">
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="loginrow d-none" id="validLogin">
                                <p style="color: red;">Не все поля заполнены</p>
                            </div>
                            <div class="loginrow d-none" id="validPassword">
                                <p style="color: red;">Логин или пароль не верны.</p>
                            </div>
                            <button class="btn btn-primary col-md-offset-3 submitLoginForm">Вход</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fas fa-arrow-up"></i>
    </div>
    <!-- end::Scrolltop -->

<script>
    $(document).ready(function () {
        let urlOne = '/ajax/ajaxpost';

        $('.submitLoginForm').on('click',function () {
            let login_user = $('#login_user').val();
            let login_pwd = $('#login_pwd').val();
            if(login_user.length<1 || login_pwd.length<1){
                $('#validLogin').removeClass('d-none');
                $('#validPassword').addClass('d-none');
            }else{
                $.ajax({
                    url: urlOne, type: "POST", dataType: "text",
                    data: "mainAjax=loginValidate&loginUser="+login_user+"&loginPwd="+login_pwd,
                    success: function (data) {
                        let result = $.parseJSON(data);
                        if(result === 'incorrect'){
                            $('#validLogin').addClass('d-none');
                            $('#validPassword').removeClass('d-none');
                        }else if(result === 'correct'){
                            window.location = ('/');
                        }
                    }
                });
            }
        });

        $('.logout').on('click',function () {
            $.ajax({
                url: urlOne, type: "POST", dataType: "text",
                data: "mainAjax=logoutAction",
                success: function (data) {
                    window.location = ('/');
                }
            });
        });
    });
</script>
<script src="/assets/js/scripts.bundle.js" type="text/javascript"></script>
</body>
</html>