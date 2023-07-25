<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `category_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="text-muted"><b><i class="fas fa-edit"></i> Имя: </b></dt>
        <dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
        <dt class="text-muted"><b><i class="fas fa-align-right"></i> Описание: </b></dt>
        <dd class="pl-4"><?= isset($description) ? $description : '' ?></dd>
        <dt class="text-muted"><b><i class="fas fa-exclamation-triangle"></i> Состояние: </b></dt>
        <dd class="pl-4">
            <?php if($status == 1): ?>
                <span class="badge badge-success px-3 rounded-pill"><i class="fas fa-check-square"></i> Активный </span>
            <?php else: ?>
                <span class="badge badge-danger px-3 rounded-pill"><i class="fas fa-times-circle"></i> Неактивный </span>
            <?php endif; ?>
        </dd>
    </dl>
    <div class="clear-fix mb-3"></div>
    <div class="text-right">
        <button class="btn btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Закрыть </button>
    </div>
</div>