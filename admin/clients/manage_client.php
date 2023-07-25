<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `client_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<div class="card card-outline card-purple">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-sync-alt"></i> <?php echo isset($id) ? "Обновление ": "Создавать новое " ?> подробности клиента </h3>
	</div>
	<div class="card-body">
		<form action="" id="client-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="form-group">
				<label for="firstname" class="control-label"><i class="fas fa-user-edit"></i> Имя: </label>
                <input name="firstname" id="firstname" type="text" class="form-control rounded-0" value="<?php echo isset($firstname) ? $firstname : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="middlename" class="control-label"><i class="fas fa-user-edit"></i> Фамиля: </label>
                <input name="middlename" id="middlename" type="text" class="form-control rounded-0" value="<?php echo isset($middlename) ? $middlename : ''; ?>" placeholder="optional">
			</div>
			<div class="form-group">
				<label for="lastname" class="control-label"><i class="fas fa-user-edit"></i> Очество: </label>
                <input name="lastname" id="lastname" type="text" class="form-control rounded-0" value="<?php echo isset($lastname) ? $lastname : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="gender" class="control-label"><i class="fas fa-venus-mars"></i> Полы: </label>
                <select name="gender" id="gender" class="custom-select selevt">
                <option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>><span class="fas fa-male"></span> Мужской </option>
                <option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>><span class="fas fa-female"></span> Женский </option>
                </select>
			</div>
            <div class="form-group">
				<label for="contact" class="control-label"><i class="fas fa-mobile-alt"></i> Контактный номер: </label>
                <input name="contact" id="contact" type="text" class="form-control rounded-0" value="<?php echo isset($contact) ? $contact : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="address" class="control-label"><i class="fas fa-map-marked-alt"></i> Адрес:</label>
                <textarea name="address" id="address"class="form-control rounded-0" required><?php echo isset($address) ? $address : ''; ?></textarea>
			</div>
            <div class="form-group">
				<label for="email" class="control-label"><i class="fas fa-envelope-open-text"></i> Электронная почта: </label>
                <input name="email" id="email" type="email" class="form-control rounded-0" value="<?php echo isset($email) ? $email : ''; ?>" required>
			</div>
			<div class="form-group">
				<label for="password" class="control-label"><i class="fas fa-unlock-alt"></i> Новый пароль: </label>
				<div class="input-group">
					<input type="password" name="password" id="password" placeholder="" class="form-control">
					<div class="input-group-append border">
						<span class="input-group-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
					</div>
				</div>
				<small><em class="text-muted"> Заполните только для обновления пароля клиента. </em></small>
			</div>
            <div class="form-group">
				<label for="status" class="control-label"><i class="fas fa-exclamation-triangle"></i> Состояние: </label>
                <select name="status" id="status" class="custom-select selevt">
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>><i class="fas fa-check-square"></i> Активный </option>
                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>><i class="fas fa-times-circle"></i> Неактивный </option>
                </select>
			</div>
		</form>
	</div>
	<div class="card-footer text-center">
		<a class="btn btn-default border rounded-2" href="./?page=clients"><i class="fa fa-angle-left"></i> Вернуться назад </a>
		<button class="btn btn-success rounded-2" form="client-form"><i class="fas fa-clipboard-check"></i> Сохранить </button>
		<a class="btn btn-danger rounded-2" href="?page=clients"><i class="fas fa-window-close"></i> Oтменить </a>
	</div>
</div>
<script>
	$(document).ready(function(){
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
		$('#client-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
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
						location.href = "./?page=clients";
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

        $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>