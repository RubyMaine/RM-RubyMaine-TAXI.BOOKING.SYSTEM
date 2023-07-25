<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-purple">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-users-cog"></i> Список пользователей системы </h3>
		<div class="card-tools">
			<a href="?page=user/manage_user" class="btn btn-success btn-sm"><span class="fas fa-plus"></span>  Добавить нового cистемные пользователя</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
				<tr class="bg-gradient-dark text-light">
						<th class="text-center"> # ID: </th>
						<th class="text-center"> Фотография пользователей: </th>
						<th class="text-center"> Системные имена пользователей: </th>
						<th class="text-center"> Имя пользователя: </th>
						<th class="text-center"> Типы: </th>
						<th class="text-center"> Действие: </th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name from `users` where id != '1' and id != '{$_settings->userdata('id')}' and `type` != 3 order by concat(firstname,' ',lastname) asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="text-center"><img src="<?php echo validate_image($row['avatar']) ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
							<td class="text-center"><?php echo ucwords($row['name']) ?></td>
							<td class="text-center"><p class="m-0 truncate-1"><?php echo $row['username'] ?></p></td>
							<td class="text-center"><?php echo ($row['type'] == 1) ? 'Администратор' : 'Сотрудники' ?></td>
							<td class="text-center">
								 <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"><i class="fas fa-exclamation-triangle"></i> Действие <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=user/manage_user&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Редактировать </a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Удалить </a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Вы уверены, что навсегда удалите этого пользователя?","delete_user",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_user($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete",
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
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>