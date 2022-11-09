<style>
    *{
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }
    table{
        width: 90%;
        border: 1px solid rgb(229, 231, 235);
        font-size: 16px;
    }
    tr,th,td{
        border: 1px solid rgb(190, 209, 209);
        padding: 5px;
        text-align: center;
    }
    .same{
        width: auto;
    }
</style>

    <div style="width: 100%; text-align: center; padding: 10px">
        <b style="font-size: 25px; ">Bảng chấm công tháng {{ $month }} của nhân viên {{ $nameUS }} <a style="color: red"></a></b>
</div>

    <table style="width: 90%;margin: 20px auto" >
        <tr style="background-color: rgb(229, 231, 235)">
            <th class="same" style="width: 40px">Thứ</th>
            <th class="same">Ngày</th>
            <th class="same">Giờ vào</th>
            <th class="same">Giờ ra</th>
            <th class="same">Số công ngày</th>
            <th class="same">Phạt đi muộn</th>
            <th class="same">Phạt về sớm</th>
        </tr>

        @foreach($mang as $key => $item )
{{--            @dd($mang)--}}
            <tr @if( $item['day_text'] == "CN") style="background-color: rgba(255, 28, 28, 0.7) ;"
                @elseif($item['day_text'] == "T7")style="background-color: rgba(255, 238, 0, 0.45)"  @endif >
                <td>{{ $item['day_text'] }}</td>
                <td >{{ $item['day'] }}</td>
                <td>{{ $item['input'] }}</td>
                <td>{{ $item['output'] }}</td>
                <td>{{ $item['count'] }}</td>
                <td>{{ $item['late'] }}</td>
                <td>{{ $item['soon'] }}</td>

            </tr>
        @endforeach



    </table>
<table style="width: 90%;margin: 20px auto">
    <tr>
        <td><b>Tổng số công:</b> <a style="font-size: 18px;color: red; font-weight: bold">{{ $staffs['tong'] }}</a> công </td>
        <td><b>Tổng tiền phạt:</b> <a style="font-size: 18px;color: red; font-weight: bold">{{ $staffs['late'] }}</a> đ</td>
{{--        <td><b>Số lần đi muộn:</b> <a style="font-size: 18px;color: red; font-weight: bold">{{ $countLate }}</a> lần</td>--}}
{{--        <td><b>Số lần về sớm:</b> <a style="font-size: 18px;color: red; font-weight: bold">{{ $countSoon }}</a> lần</td>--}}
    </tr>
</table>




