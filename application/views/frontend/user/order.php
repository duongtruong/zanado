<div class="account-create" style="padding: 10px 20px">
    <div class="table-responsive">
        <h4 class="legend">Danh sách giao dịch</h4>
        <table class="data-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mặt hàng</th>
                    <th>Ngày tháng</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($list_item as $key => $value) {
                    echo '
                    <tr>
                        <td>'.intval($key+1).'</td>
                        <td>'.$value['item_title'].'</td>
                        <td>'.date('d/m/Y H:i', $value['time_created']).'</td>
                        <td>'.$value['total_item'].'</td>
                        <td>'.number_format((float) $value['total_price']).'đ</td>
                        <td>'.$value['status'].'</td>
                        <td><a target="_blank" href="'.base_url('sales/order/view-'.$value['id'].'-phone-'.$value['buyer_phone']).'.html"><span class="glyphicon glyphicon-eye-open text-center"></span></td>
                    </tr>
                    ';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>