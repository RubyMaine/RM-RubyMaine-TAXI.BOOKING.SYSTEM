<div class="content py-5 mt-5">
    <div class="container">
        <div class="card card-outline card-purple shadow rounded-0">
            <div class="card-header">
                <h4 class="card-title"> Мой список заказов </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="30%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                    <tr class="bg-gradient-dark text-light">
                            <th class="text-center"># ID: </th>
                            <th class="text-center"> Дата заказа: </th>
                            <th class="text-center"> Ссылка Код: </th>
                            <th class="text-center"> Подробная информация о поездке: </th>
                            <th class="text-center"> Cостояние: </th>
                            <th class="text-center"> Действие: </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM `booking_list` where cab_id = '{$_settings->userdata('id')}' order by unix_timestamp(date_created) desc");
                            while($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['ref_code'] ?></td>
                            <td>
                                <p class="m-0 truncate-1"><b> От ехать: </b> <?= $row['pickup_zone'] ?></p>
                                <p class="m-0 truncate-1"><b> Довезти до: </b> <?= $row['drop_zone'] ?></p>
                            </td>
                            <td class="text-center">
                                <?php 
                                    switch($row['status']){
                                        case 0:
                                            echo "<span class='badge badge-secondary bg-gradient-secondary px-3 rounded-pill'> В ожидании </span>";
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
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-flat btn-info border btn-sm view_data" data-id="<?= $row['id'] ?>"><i class="fas fa-eye"></i> Посмотреть подробности </button>
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
    $(function(){
        $('table th, table td').addClass('px-2 py-1 align-middle')
        $('table').dataTable();

        $('.view_data').click(function(){
            uni_modal("Информация о бронировании","view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>