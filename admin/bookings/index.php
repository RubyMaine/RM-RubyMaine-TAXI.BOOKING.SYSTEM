<div class="card card-outline card-purple shadow rounded-0">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Список заказов </h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col width="5%">
                    <col width="14%">
                    <col width="11%">
                    <col width="10%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th class="text-center"> # ID:  </th>
                        <th class="text-center"> Дата заказа: </th>
                        <th class="text-center"> Зарегистрированного коды:  </th>
                        <th class="text-center"> ID машина: </th>
                        <th class="text-center"> Клинты: </th>
                        <th class="text-center"> Состояние: </th>
                        <th class="text-center"> Действие: </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $bookings = $conn->query("SELECT b.*,concat(c.lastname,', ', c.firstname,' ',c.middlename) as client, cab_reg_no FROM `booking_list` b inner join client_list c on b.client_id = c.id inner join cab_list cc on b.cab_id = cc.id order by unix_timestamp(b.date_created) desc ");
                    while($row = $bookings->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?= $i++ ?></td>
                            <td><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['ref_code'] ?></td>
                            
                            <td><?= $row['cab_reg_no'] ?></td>
                            <td><?= $row['client'] ?></td>
                            <td class="text-center">
                                <?php 
                                    switch($row['status']){
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
                            </td>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-info border view_data" href="javascript:void(0)" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> Просматривать </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){

        $('.table th, .table td').addClass("align-middle px-2 py-1")
		$('.table').dataTable();
		$('.table').dataTable();
        $('.view_data').click(function(){
            uni_modal("<span class='fas fa-info'></span> Информация о бронировании","bookings/view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>