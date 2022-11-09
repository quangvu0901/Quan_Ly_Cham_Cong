<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeps;

use App\Models\Application;
use App\Models\FormApply;
use App\Models\Timekeep;
use App\Models\TimekeepRule;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use http\Client\Curl\User;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Termwind\Components\Dd;
use DateTime;
use function Livewire\invade;


class Listing extends Component
{
    use WithLaravelFormTrait;

    public $confirm = 0;
    // Filter
    public $fId;
    // Sort
    public $user_id, $note = 0, $today, $created_at, $updated_at = null, $punish, $count;
    public $sId = 0;
    public $fields = [
        "id" => ["status" => true, "label" => "Id"],
        "user_id" => ["status" => true, "label" => "User Id"],
        "note" => ["status" => true, "label" => "Note"],
        "count" => ["status" => true, "label" => "count"],
        "punish" => ["status" => true, "label" => "punish"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("time-keep.timekeeps.listing");
    }

    function delete()
    {
        $this->authorize("time-keep.timekeeps.delete");
        if ($this->confirm > 0) {
            Timekeep::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Timekeeps successfully destroyed.');
    }

    public function createTime()
    {
        $data = Timekeep::create([
            'user_id' => Auth::user()->id,
            'note' => $this->note,
        ]);
        return $data;
    }

    public function secondsToTime($seconds)
    {
        if ($seconds >= 0) {
            $minutes = floor($seconds / 60);
            $sec = $seconds % 60;
        } else {
            $minutes = floor(($seconds / 60) * (-1));
            $sec = ($seconds % 60) * (-1);
        }
        return $minutes . " phút " . $sec . " giây";
    }

    public function store($key)
    {
        $c = json_decode(base64_decode($key));
        $d = strtotime(date('d-m-Y H:i:s', time())) - strtotime($c->time);
        $time = date('Y-m-d', time());
        $data = Timekeep::where('user_id', Auth::user()->id)->whereDate('created_at', $time)->first();
        if ($data) {
            $data->updated_at = time();
            $data->update();
        } else {

            $data = Timekeep::create(['user_id' => Auth::user()->id]);
        }
//
//                if (strtotime($c->time) < 1) {
//                    $lateHour = strtotime($c->time) - 1; //giờ người dùng gửi truy cập vào QR code - Giờ bắt đầu làm việc
//                    if ($lateHour <= 0) { // nếu <= 0 thì thỏa mãn điều kiện đến đúng giờ hay sơm hơn
//                        $this->createTime();
//                    } else if ($lateHour <= 900) { // phat di muon 30 phut
//                        $data = Timekeep::create([
//                            'user_id' => Auth::user()->id,
//                        ]);
//                    } else if ($lateHour <= 1800) {
//                        $data = Timekeep::create([
//                            'user_id' => Auth::user()->id,
//                        ]);
//                    } else {
//                        $data = Timekeep::create([
//                            'user_id' => Auth::user()->id,
//                        ]);
//                    }
//                }
//                if (strtotime($c->time) >= 1) {
//                    $lateHour2 = strtotime($c->time) -1 ; //giờ người dùng gửi truy cập vào QR code - Giờ bắt đầu làm việc
//
//                    if ($lateHour2 <= 5400) {
//                        $this->createTime();
//                    } else if ($lateHour2 <= 6300) {
//                        $data = Timekeep::create([
//                            'user_id' => Auth::user()->id,
//                        ]);
//                    } else if ($lateHour2 <= 7200) {
//                        $data = Timekeep::create([
//                            'user_id' => Auth::user()->id,
//                        ]);
//                    } else {
//                        $data = Timekeep::create([
//                            'user_id' => Auth::user()->id,
//                        ]);
//                    }
//                }
            return redirect()->route('time-keep.timekeeps')->with('success', 'Điểm danh giờ vào thành công!');

        session()->flash('error', 'QrCode da het han');
        return redirect()->route('time-keep.timekeeps');
    }


    public function render()
    {
        $timeKeepRule = TimekeepRule::where('active', 1)->get();
        $types = $timeKeepRule[0]->type;

        $message = '';
        if (count($timeKeepRule)==0){
            $message = "Bạn chưa có luật chấm công nào!! ";
        }
        $data = new Timekeep();
        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $timeY = date('Y', time());
        $timeM = date('m', time());
        $data = $data->with('user')->whereMonth('created_at', $timeM)->whereYear('created_at', $timeY)->get();

        $rule = TimekeepRule::get();
        $date = getdate();
        $m = $date['mon'];
        $y = $date['year'];
        $all_day = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        $week = array("CN", "T2", "T3", "T4", "T5", "T6", "T7");
        $days = [];
        for ($i = 1; $i <= $all_day; $i++) {
            $time = $i . '-' . $m . '-' . $y . '00:00:00';
            $datetime = new DateTime($time);
            $w = (int)$datetime->format('w');
            $days[$i]['day_text'] = $week[$w];
            $days[$i]['day'] = $i;
        }

        $users = \App\Models\User::all();

        $day = Carbon::now()->daysInMonth;
        $today = Carbon::today();

        $groupData = $data->groupBy('user_id');
        $tong = 0;
        $array_staffs = [];
        $timekeep = [];
        foreach ($groupData as $key => $group) {
            foreach ($group as $keys => $values) {
                $timeKeepRule = TimekeepRule::where('active', 1)->get();
                $check_in = strtotime(date_format($values->created_at,'H:i:s'));
                $check_out = strtotime(date_format($values->updated_at,'H:i:s'));

                $totalCount = new \timeKeep();
                $total = $totalCount->handleTotal($check_in, $check_out,$timeKeepRule);
                $tong += $total['count'];
                $arr = [
                    'user_id' => $values->user->id,
                    'id' => $values->id,
                    'name' => $values->user->name,
                ];
                $timekeep[intval(date_format($values->created_at, 'd'))]['timekeep'] = $total['count'];
            }
            for ($i = 1; $i <= $day; $i++) {
                if (!isset($timekeep[$i])) {
                    $timekeep[$i]['timekeep'] = 0;
                }
                $timekeep[$i]['days'] = $days[$i]['day_text'];
            }

            $timekeep = collect($timekeep)->sortKeys();
            $array_staffs[$key]['name'] = $arr['name'];
            $array_staffs[$key]['id'] = $arr['id'];
            $array_staffs[$key]['user_id'] = $arr['user_id'];
            $array_staffs[$key]['count'] = $tong;
            $array_staffs[$key]['timekeep'] = $timekeep;
            $timekeep=[];
            $tong = 0;
        }

        $time = json_encode([
            'time' => date('d-m-Y H:i:s', time()),
            'user' => Auth::user()->id,
        ]);
        $key = base64_encode($time);
        $day = Carbon::now()->daysInMonth;

        lForm()->setTitle("Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps"), "Timekeeps");

//        \dd($timeKeepRule->value);
        return view("time-keep::livewire.timekeeps.listing",
            compact('data','message', 'key', 'day', 'array_staffs', 'days', 'rule'), ['timerule'=>  $timeKeepRule])
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeps Create']);
    }
}
