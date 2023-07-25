<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-purple">
	<div class="card-header">
		<h3 class="card-title"><i class="fas fa-taxi"></i> Список такси </h3>
		<div class="card-tools">
			<a href="?page=cabs/manage_cab" class="btn btn-success"><span class="fas fa-plus"></span> Добавить новую такси машину </a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped table-hover">
				<colgroup>
					<col width="5%">
					<!-- <col width="15%"> -->
					<col width="15%">
					<col width="10%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
				<tr class="bg-gradient-dark text-light">
				<th class="text-center"> # ID: </th>
						<!-- <th>Date Created</th> -->
						<th class="text-center"> Зарегистрированного коды: </th>
						<th class="text-center"> Категория: </th>
						<th class="text-center"> Модель машины: </th>
						<th class="text-center"> Подробности: </th>
						<th class="text-center"> Состояние: </th>
						<th class="text-center"> Действие: </th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT c.*,cc.name as category from `cab_list` c inner join category_list cc on c.category_id = cc.id where c.delete_flag = 0 order by (c.`reg_code`) asc ");
						while($row = $qry->fetch_assoc()):
							foreach($row as $k=> $v){
								$row[$k] = trim(stripslashes($v));
							}
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<!-- <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td> -->
							<td><?php echo ucwords($row['reg_code']) ?></td>
							<td><?php echo ucwords($row['category']) ?></td>
							<td><?php echo ucwords($row['cab_model'])?></td>
							<td>
								<div>
									<p class="m-0 truncate-1"><small><b> ID машина: </b> <?= $row['cab_reg_no'] ?></small></p>
									<p class="m-0 truncate-1"><small><b> Водитель:</b> <?= $row['cab_driver'] ?></small></p>
								</div>
							</td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success px-3 rounded-pill"><i class="fas fa-check-square"></i> Активный </span>
                                <?php else: ?>
                                    <span class="badge badge-danger px-3 rounded-pill"><i class="fas fa-times-circle"></i> Неактивный </span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"><i class="fas fa-exclamation-triangle"></i> Действие <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="?page=cabs/view_cab&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> Посмотреть </a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="?page=cabs/manage_cab&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Редактировать </a>
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
			_conf("Вы уверены, что хотите удалить это такси навсегда?","delete_cab",[$(this).attr('data-id')])
		})
        $('.table th, .table td').addClass("align-middle px-2 py-1")
		$('.table').dataTable();
		$('.table').dataTable();
	})
	function delete_cab($id){
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
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>