<?php 
if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2){
    $qry = $conn->query("SELECT * FROM `client_list` where id = '{$_settings->userdata('id')}'");
    if($qry->num_rows >0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }else{
        echo "<script> alert('Вам не разрешен доступ к этой странице. Неизвестный идентификатор пользователя.'); location.replace('./') </script>";
    }
}else{
    echo "<script> alert('Вам не разрешен доступ к этой странице.'); location.replace('./') </script>";
}
?>
<style>
    #cimg{
        width:15vw;
        height:20vh;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="content py-5 mt-5">
    <div class="container justify-content-center align-items-center">
        <div class="card card-outline card-purple shadow rounded-0">
            <div class="card-header text-center">
                <h4 class="card-title text-center"><b> Управление данными учетной записи/учетными данными </b></h4>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form id="register-frm" action="" method="post">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="firstname" id="firstname" placeholder=" Введите имя ... " autofocus class="form-control form-control-sm form-control-border" value="<?= isset($firstname) ? $firstname : "" ?>" required>
                                <small class="ml-3"> Имя: </small>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="middlename" id="middlename" placeholder=" Введите фамилия ... " class="form-control form-control-sm form-control-border" value="<?= isset($middlename) ? $middlename : "" ?>">
                                <small class="ml-3"> Фамилия: </small>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="lastname" id="lastname" placeholder=" Введите отчество ... " class="form-control form-control-sm form-control-border" required value="<?= isset($lastname) ? $lastname : "" ?>">
                                <small class="ml-3"> Отчество: </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <select name="gender" id="gender" class="custom-select custom-select-sm form-control-border" required>
                                    <option <?= isset($gender) && $gender == 'Male' ? "selected" : "" ?>> Мужской </option>
                                    <option <?= isset($gender) && $gender == 'Female' ? "selected" : "" ?>> Женский </option>
                                </select>
                                <small class="ml-3"> Пол: </small>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="contact" id="contact" placeholder="Enter Contact #" class="form-control form-control-sm form-control-border" required value="<?= isset($contact) ? $contact : "" ?>">
                                <small class="ml-3"> Контактный телефон: </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                            <small class="ml-3"> Адрес: </small>
                            <textarea name="address" id="address" rows="3" class="form-control form-control-sm rounded-0" placeholder=" г.Ташкент, ШШайхантахурский район, ул Бунёдкор 8a "><?= isset($address) ? $address : "" ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="email" name="email" id="email" placeholder="jsmith@sample.com" class="form-control form-control-sm form-control-border" required value="<?= isset($email) ? $email : "" ?>">
                                <small class="ml-3"> Электронная почта: </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                <input type="password" name="password" id="password" placeholder="" class="form-control form-control-sm form-control-border">
                                <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                                </div>
                                </div>
                                <small class="ml-3"> Новый пароль: </small>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                <input type="password" id="cpassword" placeholder="" class="form-control form-control-sm form-control-border">
                                <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                                </div>
                                </div>
                                <small class="ml-3"> Подтвердите новый пароль: </small>
                            </div>
                            <div class="col-12"><small class="text-muted"><em> Заполните поля пароля выше, только если вы хотите обновить свой пароль. </em></small></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                <input type="password" name="oldpassword" id="oldpassword" placeholder="" class="form-control form-control-sm form-control-border" required>
                                <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                                </div>
                                </div>
                                <small class="ml-3"> Текущий пароль: </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                            <label for="" class="control-label"> Фотография пользователей: </label>
                            <div class="custom-file">
                                    <input type="file" class="custom-file-input rounded-0 form-control form-control-sm form-control-border" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                    <label class="custom-file-label" for="customFile"> Выберите файл </label>
                                    </div>
                            </div>
                        <div class="row">
                        </div>
                            <div class="form-group col-md-6 d-flex justify-content-center">
                            <img src="<?php echo validate_image(isset($image_path) ? $image_path : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check-square"></i> Сохранить </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     window.displayImg = function(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#cimg').attr('src', "<?php echo validate_image(isset($image_path) ? $image_path : "") ?>");
            _this.siblings('.custom-file-label').html("Choose file")
        }
	}
    $(function(){
        $('.pass_type').click(function(){
            var type = $(this).attr('data-type')
            if(type == 'password'){
                $(this).attr('data-type','text')
                $(this).closest('.input-group').find('input').attr('type',"text")
                $(this).removeClass("fa-eye-slash")
                $(this).addClass("fa-eye")
            }else{
                $(this).attr('data-type','password')
                $(this).closest('.input-group').find('input').attr('type',"password")
                $(this).removeClass("fa-eye")
                $(this).addClass("fa-eye-slash")
            }
        })
        $('#register-frm').submit(function(e){
            e.preventDefault()
            var _this = $(this)
                    $('.err-msg').remove();
            var el = $('<div>')
                    el.hide()
            if($('#password').val() != $('#cpassword').val()){
                el.addClass('alert alert-danger err-msg').text('Password does not match.');
                _this.prepend(el)
                el.show('slow')
                return false;
            }
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Users.php?f=save_client",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        location.reload();
                    }else if(resp.status == 'failed' && !!resp.msg){   
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                    end_loader();
                    $('html, body').scrollTop(0)
                }
            })
        })
    })
</script>