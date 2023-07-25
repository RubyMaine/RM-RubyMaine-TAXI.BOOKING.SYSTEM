<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT  b.*,concat(c.lastname,', ', c.firstname,' ',c.middlename) as client from `booking_list` b inner join client_list c on b.client_id = c.id where b.id = '{$_GET['id']}' ");
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
            <fieldset class="border-bottom">
            <legend class="h5 text-muted"><i class="fas fa-caravan"></i> Подробности кабины: </legend>
            <dl>
                <dt class=""><i class="fas fa-caravan"></i> Кузов кабины: </dt>
                <dd class="pl-4"><?= isset($body_no) ? $body_no : "" ?></dd>
                <dt class=""><i class="fas fa-car-side"></i> Категория транспортного средства: </dt>
                <dd class="pl-4"><?= isset($category) ? $category : "" ?></dd>
                <dt class=""><i class="fas fa-car-side"></i> Модель автомобиля: </dt>
                <dd class="pl-4"><?= isset($cab_model) ? $cab_model : "" ?></dd>
                <dt class=""><i class="fas fa-user-tie"></i> Имя водителя:</dt>
                <dd class="pl-4"><?= isset($cab_driver) ? $cab_driver : "" ?></dd>
                <dt class=""><i class="fas fa-id-card-alt"></i> Контакт водителя:</dt>
                <dd class="pl-4"><?= isset($driver_contact) ? $driver_contact : "" ?></dd>
                <dt class=""><i class="far fa-id-card"></i> Адрес водителя:</dt>
                <dd class="pl-4"><?= isset($driver_address) ? $driver_address : "" ?></dd>
            </dl>
        </fieldset>
        </div>
        <!-- <div class="clear-fix my-2"></div> -->
        <div class="col-md-6">
            <fieldset class="bor">
                <legend class="h5 text-muted"><i class="fas fa-info-circle"></i> Информация о бронировании: </legend>
                <dl>
                    <dt class=""><i class="fas fa-stream"></i> Зарегистрированного коды:</dt>
                    <dd class="pl-4"><?= isset($ref_code) ? $ref_code : "" ?></dd>
                    <dt class=""><i class="fas fa-user-tie"></i> Клиент </dt>
                    <dd class="pl-4"><?= isset($client) ? $client : "" ?></dd>
                    <dt class=""><i class="fas fa-road"></i> От ехать: </dt>
                    <dd class="pl-4"><?= isset($pickup_zone) ? $pickup_zone : "" ?></dd>
                    <dt class=""><i class="fas fa-road"></i> Довезти до: </dt>
                    <dd class="pl-4"><?= isset($drop_zone) ? $drop_zone : "" ?></dd>
                    <dt class=""><i class="fas fa-exclamation-triangle"></i> Cостояние: </dt>
                    <dd class="pl-4">
                        <?php 
                            switch($status){
                                case 0:
                                    echo "<span class='badge badge-secondary bg-gradient-secondary px-3 rounded-pill'><span class='fas fa-pen-square'></span> В ожидании </span>";
                                    break;
                                case 1:
                                    echo "<span class='badge badge-primary bg-gradient-primary px-3 rounded-pill'><span class='fas fa-window-close'></span> Водитель подтвержден </span>";
                                    break;
                                case 2:
                                    echo "<span class='badge badge-warning bg-gradient-warning px-3 rounded-pill'><span class='fas fa-exclamation'></span> Подобрал </span>";
                                    break;
                                case 3:
                                    echo "<span class='badge badge-success bg-gradient-success px-3 rounded-pill'><span class='fas fa-check-square'></span> Принято </span>";
                                    break;
                                case 4:
                                    echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'><span class='fas fa-times'></span> Отменено </span>";
                                    break;
                            }
                        ?>
                    </dd>
                </dl>
            </fieldset>
        </div>
    </div>
    <div class="clear-fix my-3"></div>
    <div class="text-right">
        <button class="btn btn-danger bg-gradient-red" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Закрывать </button>
    </div>
</div>
