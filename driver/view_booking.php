<?php
require_once('./../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `booking_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
        $qry2 = $conn->query("SELECT c.*, cc.name as category from `cab_list` c inner join category_list cc on c.category_id = cc.id where c.id = '{$cab_id}' ");
        if($qry2->num_rows > 0){
            foreach($qry2->fetch_assoc() as $k => $v){
                if(!isset($$k))
                $$k=$v;
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-6">
            <fieldset class="bor">
                <legend class="h5 text-muted"> Детали кабины </legend>
                <dl>
                    <dt class=""> Кабина Кузов Нет </dt>
                    <dd class="pl-4"><?= isset($body_no) ? $body_no : "" ?></dd>
                    <dt class=""> Категория автомобиля </dt>
                    <dd class="pl-4"><?= isset($category) ? $category : "" ?></dd>
                    <dt class=""> Модель транспортного средства </dt>
                    <dd class="pl-4"><?= isset($cab_model) ? $cab_model : "" ?></dd>
                    <dt class=""> Водитель </dt>
                    <dd class="pl-4"><?= isset($cab_driver) ? $cab_driver : "" ?></dd>
                    <dt class=""> Связаться с водителем </dt>
                    <dd class="pl-4"><?= isset($driver_contact) ? $driver_contact : "" ?></dd>
                    <dt class=""> Адрес водителя </dt>
                    <dd class="pl-4"><?= isset($driver_address) ? $driver_address : "" ?></dd>
                </dl>
            </fieldset>
            <!-- <div class="clear-fix my-2"></div> -->
            
        </div>

        <div class="col-md-6">
            <fieldset class="bor">
                <legend class="h5 text-muted"> Информация о бронировании </legend>
                <dl>
                    <dt class=""> Ссылка Код </dt>
                    <dd class="pl-4"><?= isset($ref_code) ? $ref_code : "" ?></dd>
                    <dt class=""> Зона выдачи </dt>
                    <dd class="pl-4"><?= isset($pickup_zone) ? $pickup_zone : "" ?></dd>
                    <dt class=""> Зона возврата </dt>
                    <dd class="pl-4"><?= isset($drop_zone) ? $drop_zone : "" ?></dd>
                    <dt class=""> Состояние </dt>
                    <dd class="pl-4">
                        <?php 
                            switch($status){
                                case 0:
                                    echo "<span class='badge badge-secondary bg-gradient-secondary px-3 rounded-pill'> На рассмотрении </span>";
                                    break;
                                case 1:
                                    echo "<span class='badge badge-primary bg-gradient-primary px-3 rounded-pill'> Водитель подтвержден </span>";
                                    break;
                                case 2:
                                    echo "<span class='badge badge-warning bg-gradient-warning px-3 rounded-pill'> Подобрали </span>";
                                    break;
                                case 3:
                                    echo "<span class='badge badge-success bg-gradient-success px-3 rounded-pill'> Сброшено </span>";
                                    break;
                                case 4:
                                    echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'> Отменено </span>";
                                    break;
                            }
                        ?>
                    </dd>
                </dl>
            </fieldset>
        </div>
    </div>
    
    <!-- <div class="clear-fix my-3"></div> -->
    <div class="text-right">
        <?php if(isset($status) && $status == 0): ?>
        <button class="btn btn-primary btn-flat bg-gradient-primary" type="button" id="confirm_booking"> Подтвердить бронирование </button>
        <?php elseif(isset($status) && $status == 1): ?>
        <button class="btn btn-warning btn-flat bg-gradient-warning" type="button" id="pickup_booking"> Подобрали </button>
        <?php elseif(isset($status) && $status == 2): ?>
        <button class="btn btn-success btn-flat bg-gradient-success" type="button" id="dropoff_booking"> Сброшен </button>
        <?php endif; ?>
        <button class="btn btn-dark rounded-2" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Закрывать </button>
    </div>
</div>
<script>
    $(function(){
        $('#confirm_booking').click(function(){
            _conf("Вы уверены, что подтвердите это бронирование [Ссылка. Код: <b><?= isset($ref_code) ? $ref_code : "" ?></b>]?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",1])
        })
        $('#pickup_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] бронирование как самовывоз?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",2])
        }) 
        $('#dropoff_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] бронировать как выброшенный?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",3])
        })
    })
    function update_booking_status($id,$status){
        start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=update_booking_status",
			method:"POST",
			data:{id: $id,status:$status},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
    }
</script>