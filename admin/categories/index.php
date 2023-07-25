<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-purple rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-clipboard-list"></i> Список категорий </h3>
		<div class="card-tools">
			<button type="button" id="create_new" class="btn btn-success"><span class="fas fa-plus-square"></span> Добавить новую категорию </button>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<table class="table table-bordered table-stripped table-hover">
				<colgroup>
					<col width="5%">
					<!-- <col width="20%"> -->
					<col width="15%">
					<col width="30%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
				<tr class="bg-gradient-dark text-light">
				<th class="text-center"> # ID: </th>
						<!-- <th>Date Created</th> -->
						<th class="text-center"> Категория: </th>
						<th class="text-center"> Описание: </th>
						<th class="text-center"> Состояние: </th>
						<th class="text-center"> Действие: </th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `category_list` where delete_flag = 0 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<!-- <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td> -->
							<td><?php echo $row['name'] ?></td>
							<td><p class="m-0 truncate-1"><?php echo $row['description'] ?></p></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success px-3 rounded-pill"><i class="fas fa-check-square"></i> Активный </span>
                                <?php else: ?>
                                    <span class="badge badge-danger px-3 rounded-pill"><i class="fas fa-times-circle"></i> Неактивный </span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								<button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"><i class="fas fa-exclamation-triangle"></i>	Действие <span class="sr-only">Toggle Dropdown</span></button>
								<div class="dropdown-menu" role="menu">
								<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> Посмотреть </a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Редактировать </a>
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
<script>
	$(document).ready(function(){
		$('#create_new').click(function(){
			uni_modal("Добавить новую категорию","categories/manage_category.php");
		})
		$('.edit_data').click(function(){
			uni_modal("Изменить категорию","categories/manage_category.php?id="+$(this).attr('data-id'));
		})
		$('.view_data').click(function(){
			uni_modal("Изменить категорию","categories/view_category.php?id="+$(this).attr('data-id'));
		})
		$('.delete_data').click(function(){
			_conf("Вы уверены, что хотите удалить эту категорию навсегда?","delete_category",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_category",
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