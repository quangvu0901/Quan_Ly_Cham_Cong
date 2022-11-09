<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeps;

use App\Models\Timekeep;
use App\Models\TimekeepRule;
use App\Models\User;
use Carbon\Carbon;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use DateTime;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("time-keep.timekeeps.show");
        Timekeep::where('user_id',$this->record_id)->orderBy('created_at','asc')->get();
    }

    public function render()
    {
        //lấy ngày trong tháng
        $date = getdate();
        $m = $date['mon'];
        $y = $date['year'];
        $all_day = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        $week = array("CN", "T2", "T3", "T4", "T5", "T6", "T7");
        $days = [];
        for ($i = 1; $i <= $all_day; $i++){
            $time = $i.'-'.$m.'-'.$y;
            $datetime = new DateTime($time);
            $w = (int)$datetime->format('w');

        }



        //lấy giờ ra, vào, chấm công
        $timeY= date('Y',time());
        $timeM= date('m',time());
        $timeKeepRule = TimekeepRule::where('active', 1)->get();
//        dd($timeKeepRule);
        $dayInMonth = Carbon::now()->daysInMonth;
        $types = $timeKeepRule[0]->type;
        $tong = 0;
        $late = 0;
        $data = Timekeep::whereMonth('created_at',$timeM)->whereYear('created_at',$timeY)->where('user_id',$this->record_id)->orderBy('created_at','asc')->get();
        $user = User::where('id',$this->record_id)->first();
        $nameUS = $user->name;
        $staffs = [];
        $timekeep = [];


        switch ($types){
            case 1:
                for ($i = 1; $i <= $dayInMonth; $i++){
                    foreach ($data as $key => $item) {
                        $check_in = strtotime(date_format($item->created_at, 'H:i:s'));
                        $check_out = strtotime(date_format($item->updated_at, 'H:i:s'));
                        $totalCount = new \timeKeep();
                        $total = $totalCount->handleTotal($check_in, $check_out, $timeKeepRule);
                        $timekeep[$key]['count'] = $total['count'];
                        $timekeep[$key]['created_at'] = $item->created_at;
                        $timekeep[$key]['updated_at'] = $item->updated_at;
                        $tong += $total['count'];
                        $timekeep[$key]['late'] = number_format($total['sum_money_after'], 0, '.', ',');
                        $timekeep[$key]['soon'] = number_format($total['sum_money_before'], 0, '.', ',');
                        $late += $total['sum_money_after'] + $total['sum_money_before'];
                        $mang[intval(date_format($item->created_at, 'd'))]['day'] = date_format($item->created_at,"d/m/y");
                        $mang[intval(date_format($item->created_at, 'd'))]['input'] = date_format($item->created_at,"H:i:s");
                        $mang[intval(date_format($item->updated_at, 'd'))]['output'] = date_format($item->updated_at,"H:i:s");
                        $mang[intval(date_format($item->created_at, 'd'))]['count'] = $total['count'];
                        $mang[intval(date_format($item->created_at, 'd'))]['late'] = number_format($total['sum_money_after'], 0, '.', ',');
                        $mang[intval(date_format($item->created_at, 'd'))]['soon'] = number_format($total['sum_money_before'], 0, '.', ',');
//                        $punishLate[intval(date_format($item->created_at, 'd'))] = $total['sum_money_after'];
//                        $punishSoon[intval(date_format($item->created_at, 'd'))] = $total['sum_money_before'];
                    }
//                    /// Đếm số lần xuất hiện của các phần tử trong mảng
//                    $arrlate = array_count_values($punishLate);
//                    $arrsoon = array_count_values($punishSoon);
//                    /// Đếm số phần tử trong mảng
//                    $punishL = count($punishLate);
//                    $punishS = count($punishSoon);
//                    /// lấy số phần tử trong mảng trừ đi phần tử giống nhau (0)
//                    $countLate = $punishS - $arrlate[0];
//                    $countSoon = $punishL - $arrsoon[0];

                    $dayInMonths = Carbon::now()->daysInMonth;
                    for ($i = 1; $i <= $dayInMonths; $i++) {
                        $week = array("CN", "T2", "T3", "T4", "T5", "T6", "T7");
                        $time = $i . '-' . $m . '-' . $y . '00:00:00';
                        $datetime = new DateTime($time);
                        $w = (int)$datetime->format('w');
                        $times = $i.'-'.$m.'-'.$y;
                        if (!isset($mang[$i]['day']) &&  !isset($mang[$i]['input']) && !isset($mang[$i]['output'])
                            && !isset($mang[$i]['count']) && !isset($mang[$i]['late']) && !isset($mang[$i]['soon'])){
                            $mang[$i]['day'] = '';
                            $mang[$i]['input'] = '';
                            $mang[$i]['output'] = '';
                            $mang[$i]['count'] = '';
                            $mang[$i]['late'] = '';
                            $mang[$i]['soon'] = '';

                        }
                        $mang[$i]['day_text'] = $week[$w];
                        $mang[$i]['day'] = $times;
                    }

                    $mang = collect($mang)->sortKeys();
                    $staffs['name'] = $user->name;
                    $staffs['tong'] = $tong;
                    $staffs['timekeep'] = $timekeep;
                    $staffs['late'] = number_format($late, 0, '.', ',');
                    $staffs['month'] = date_format($timekeep[$key]['updated_at'], 'm');

                    $timekeep = collect($mang)->sortKeys();
                    $staffs['timekeep'] = $timekeep;
                    $staffs['tong'] = $tong;
                    $timekeep = [];
                    $tong = 0;
                    $late = 0;
                }
                break;
            case 2:
                foreach ($data as $key => $item) {
                    $check_in = strtotime(date_format($item->created_at, 'H:i:s'));
                    $check_out = strtotime(date_format($item->updated_at, 'H:i:s'));
                    $totalCount = new \timeKeep();
                    $total = $totalCount->handleTotal($check_in, $check_out, $timeKeepRule);
//                    dd($total);
                    $timekeep[$key]['count'] = $total['count'];
                    $timekeep[$key]['created_at'] = $item->created_at;
                    $timekeep[$key]['updated_at'] = $item->updated_at;
                    $tong += $total['count'];
                    $timekeep[$key]['late'] = number_format($total['sum_money_late'], 0, '.', ',');
                    $timekeep[$key]['soon'] = number_format($total['sum_money_soon'], 0, '.', ',');
                    $late += $total['sum_money_late'] + $total['sum_money_soon'];
                    $mang[intval(date_format($item->created_at, 'd'))]['day'] = date_format($item->created_at,"d/m/y");
                    $mang[intval(date_format($item->created_at, 'd'))]['input'] = date_format($item->created_at,"H:i:s");
                    $mang[intval(date_format($item->updated_at, 'd'))]['output'] = date_format($item->updated_at,"H:i:s");
                    $mang[intval(date_format($item->created_at, 'd'))]['count'] = $total['count'];
                    $mang[intval(date_format($item->created_at, 'd'))]['late'] = number_format($total['sum_money_late'], 0, '.', ',');
                    $mang[intval(date_format($item->created_at, 'd'))]['soon'] = number_format($total['sum_money_soon'], 0, '.', ',');
//                    $punishLate[intval(date_format($item->created_at, 'd'))] = $total['sum_money_late'];
//                    $punishSoon[intval(date_format($item->created_at, 'd'))] = $total['sum_money_soon'];
                }

//                $arrlate = array_count_values($punishLate);
//                $arrsoon = array_count_values($punishSoon);
//                /// Đếm số phần tử trong mảng
//                $punishL = count($punishLate);
//                $punishS = count($punishSoon);
//                /// lấy số phần tử trong mảng trừ đi phần tử giống nhau (0)
//                $countLate = $punishS - $arrlate[0];
//                $countSoon = $punishL - $arrsoon[0];

                $staffs['name'] = $user->name;
                $staffs['tong'] = $tong;
                $staffs['timekeep'] = $timekeep;
                $staffs['late'] = number_format($late, 0, '.', ',');
                $staffs['month'] = date_format($timekeep[$key]['updated_at'], 'm');

                $dayInMonths = Carbon::now()->daysInMonth;
                for ($i = 1; $i <= $dayInMonths; $i++) {
                    $week = array("CN", "T2", "T3", "T4", "T5", "T6", "T7");
                    $time = $i . '-' . $m . '-' . $y . '00:00:00';
                    $datetime = new DateTime($time);
                    $w = (int)$datetime->format('w');
                    $times = $i.'-'.$m.'-'.$y;
                    if (!isset($mang[$i]['day']) &&  !isset($mang[$i]['input']) && !isset($mang[$i]['output'])
                        && !isset($mang[$i]['count']) && !isset($mang[$i]['late']) && !isset($mang[$i]['soon'])   ){
                        $mang[$i]['day'] = '';
                        $mang[$i]['input'] = '';
                        $mang[$i]['output'] = '';
                        $mang[$i]['count'] = '';
                        $mang[$i]['late'] = '';
                        $mang[$i]['soon'] = '';
                    }
                    $mang[$i]['day_text'] = $week[$w];
                    $mang[$i]['day'] = $times;
                }


                $mang = collect($mang)->sortKeys();
                $staffs['name'] = $user->name;
                $staffs['tong'] = $tong;
                $staffs['timekeep'] = $timekeep;
                $staffs['late'] = number_format($late, 0, '.', ',');
                $staffs['month'] = date_format($timekeep[$key]['updated_at'], 'm');

                $timekeep = collect($mang)->sortKeys();
        break;
    }

        lForm()->setTitle("Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps"),"Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps.show",$this->record_id),"Show");

        return view("time-keep::livewire.timekeeps.show")->with(
            [

                'staffs' => $staffs,
                'user' => $user,
                'mang' => $mang,
                'month' => $m,
                'nameUS' =>$nameUS,
//                'countLate' =>$countLate,
//                'countSoon'=>$countSoon,
            ])->layout('time-keep::layouts.master', ['title' => 'Timekeeps Show']);

    }

}
