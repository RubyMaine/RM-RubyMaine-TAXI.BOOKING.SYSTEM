<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT c.*, cc.name as category from `cab_list` c inner join category_list cc on c.category_id = cc.id where c.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<style>
    .cab-img{
        width:15vw;
        height:20vh;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="content py-3">
    <div class="card card-outline rounded-2 card-purple shadow">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-info-circle"></i> Подробности по такси  </h4>
            <div class="card-tools">
                <a class="btn btn-default border" href="./?page=cabs"><i class="fa fa-angle-left"></i> Вернуться назад </a>
                <a class="btn btn-primary" href="./?page=cabs/manage_cab&id=<?= isset($id) ? $id : "" ?>"><i class="fa fa-edit"></i> Редактировать </a>
                <a class="btn btn-danger" href="javascript:void(0)>" id="delete_data"><i class="fa fa-trash"></i> Удалить </a>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="cab Image <?= isset($name) ? $name : "" ?>" class="img-thumbnail cab-img">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <small class="mx-2 text-muted"><i class="fas fa-stream"></i> Зарегистрированного коды: </small>
                        <div class="pl-4"><?= isset($reg_code) ? $reg_code : '' ?></div>
                    </div>
                    <div class="col-md-6">
                        <small class="mx-2 text-muted"><i class="fas fa-window-restore"></i> Категория: </small>
                        <div class="pl-4"><?= isset($category) ? $category : '' ?></div>
                    </div>
                </div>
                <fieldset>
                    <legend class="h4 text-muted"><b> Подробности об кабины: </b></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="mx-2 text-muted"><i class="fas fa-car-side"></i> Регистрационный номер транспортного средства: </small>
                            <div class="pl-4"><?= isset($cab_reg_no) ? $cab_reg_no : '' ?></div>
                        </div>
                        <div class="col-md-6">
                            <small class="mx-2 text-muted"><i class="fas fa-ticket-alt"></i> Mарка транспортного средства: </small>
                            <div class="pl-4"><?= isset($cab_model) ? $cab_model : '' ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="mx-2 text-muted"><i class="fab fa-markdown"></i> Модель транспортного средства: </small>
                            <div class="pl-4"><?= isset($body_no) ? $body_no : '' ?></div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="h4 text-muted"><b> Сведения о драйвере: </b></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="mx-2 text-muted"><i class="fas fa-user-edit"></i> Имя водителя: </small>
                            <div class="pl-4"><?= isset($cab_driver) ? $cab_driver : '' ?></div>
                        </div>
                        <div class="col-md-6">
                            <small class="mx-2 text-muted"><i class="fas fa-phone-square-alt"></i> Контактный телефон номер: </small>
                            <div class="pl-4"><?= isset($driver_contact) ? $driver_contact : '' ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="mx-2 text-muted"><i class="fas fa-map-marked-alt"></i> Адрес: </small>
                            <div class="pl-4"><?= isset($driver_address) ? $driver_address : '' ?></div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <small class="mx-2 text-muted"><i class="fas fa-exclamation-triangle"></i> Cостояние: </small>
                        <div class="pl-4">
                            <?php if(isset($status)): ?>
                                <?php if($status == 1): ?>
                                    <span class="badge badge-success px-3 rounded-pill"><i class="fas fa-check-square"></i> Активный </span>
                                <?php else: ?>
                                    <span class="badge badge-danger px-3 rounded-pill"><i class="fas fa-times-circle"></i> Неактивный </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
		$('#delete_data').click(function(){
			_conf("Вы уверены, что хотите удалить это такси навсегда?","delete_cab",[])
		})
    })
    function delete_cab($id = '<?= isset($id) ? $id : "" ?>'){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_cab",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.href= './?page=cabs';
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>