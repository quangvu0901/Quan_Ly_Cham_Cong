<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeprules;

use App\Models\timekeeprule;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Validation\Validator;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $selected = false;
    public $openDay = false;
    public $openShift = false;
    public $name, $value = [], $status = 1, $option = [], $day_apply = [], $penance = [], $type,
        $input_morning, $output_morning, $count_morning, $option_before_morning = [], $option_after_morning = [], $hour_morning,                   //sáng
        $input_noon, $output_noon, $count_noon, $option_before_noon = [], $option_after_noon = [], $hour_noon,                                  //chiều
        $input_shift, $output_shift, $count_shift, $option_after_shift = [], $option_before_shift = [],                             //ca
        $time_punish, $money_punish, $option_penance_after = [], $option_penance_before = [], $hour_shift;

    protected function rules()
    {
        return [
            'name' => 'required',
            'value' => '',
            'status' => '',

            //Sáng

            'input_morning' => 'required|date_format:"H:i"|after:00:00|before:"12:01"|',
            'output_morning' => 'required|date_format:"H:i"|after:input_morning|before:"12:01"',
//            'option_after_morning.*.time_after' => 'date_format:"H:i"|after:input_morning|before:output_morning',
//            'option_after_morning.*.count_after' => 'max:4',
//            'option_before_morning.*.time_before' => 'date_format:"H:i"|after:input_morning|before:output_morning',
//            'option_before_morning.*.count_before' => 'numeric|max:count_morning',

            //Chiều

            'input_noon' => 'required|date_format:"H:i"|after:"11:59"|before:"23:59"|',
            'output_noon' => 'required|date_format:"H:i"|after:input_noon|before:"23:59"',
//            'option_after_noon.*.time_after_noon' => 'date_format:"H:i"|after:input_noon|before:output_noon',
//            /*  'option_after_noon.*.count_after_noon'=>'numeric|max:2',*/
//            'option_before_noon.*.time_before_noon' => 'date_format:"H:i"|after:"13:00"|before:output_noon',
//            'option_before_noon.*.count_before_noon' => 'numeric|max:count_noon',
            //Ca

            'input_shift' => 'required|date_format:"H:i"|after:"00:00"|before:"23:59"|',
            'output_shift' => 'required|date_format:"H:i"|after:input_shift|before:"23:59"',
//            'option_after_shift.*.time_after_shift' => 'date_format:"H:i"|after:input_shift|before:output_shift',
//            'option_after_shift.*.count_after_shift' => 'max:count_shift',
//            'option_before_shift.*.time_before_shift' => 'date_format:"H:i"|after:input_shift|before:output_shift',
//            'option_before_shift.*.count_before_shift' => 'max:count_shift',
            'day_apply' => 'required',


            //Phạt
//            'option_punish_after.*.money_punish_after' => 'max:7',

        ];
    }

    public function messages()
    {
        return [
            //sáng
            'required' => 'Trường này không được để trống',
            'input_morning.before' => 'Thời gian nhập không được lớn hơn hoặc bằng :date ',
            'output_morning.after' => 'Thời gian nhập không được nhỏ hơn hoặc bằng giờ vào làm việc ',
            'output_morning.before' => 'Thời gian nhập không được lớn hơn 12:00',


            //chiều
//            'input_noon.after' => 'Thời gian nhập sau phải sau ',
//            'input_noon.before' => 'Thời gian nhập phải trước trước ',
//            'output_noon.after' => 'Thời gian nhập phải sau ',
//            'output_noon.before' => 'Thời gian nhập phải trước trước ',

            //ca
            'day_apply' => 'Bạn chưa chọn ngày áp dụng',

            'between' => 'Giá trị chỉ trong khoảng :min và :max'
        ];
    }


    //Add function
    public function addElementBy($key)
    {
        switch ($key) {
            case 'option_after_morning':
                array_push($this->option_after_morning, ["time_after" => "", "count_after" => ""]);
                break;
            case 'option_before_morning':
                array_push($this->option_before_morning, ["time_before" => "", "count_before" => ""]);
                break;
            case 'option_after_noon':
                array_push($this->option_after_noon, ["time_after" => "", "count_after" => ""]);
                break;
            case 'option_before_noon':
                array_push($this->option_before_noon, ["time_before" => "", "count_before" => ""]);
                break;
            case 'option_after_shift':
                array_push($this->option_after_shift, ["time_after" => "", "count_after_shift" => ""]);
                break;
            case 'option_before_shift':
                array_push($this->option_before_shift, ["time_before" => "", "count_before" => ""]);
                break;
            case 'option_penance_after':
                array_push($this->option_penance_after, ["option_penance_after" => "", "money_penance_after" => ""]);
                break;
            case 'option_penance_before':
                array_push($this->option_penance_before, ["option_penance_before" => "", "money_penance_before" => ""]);
                break;
        }
    }

    //Remove function
    public function removeElementBy($key, $index)
    {
        switch ($key) {
            case 'option_after_morning':
                unset($this->option_after_morning[$index]);
                array_values($this->option_after_morning);
                break;
            case 'option_before_morning':
                unset($this->option_before_morning[$index]);
                array_values($this->option_before_morning);
                break;
            case 'option_after_noon':
                unset($this->option_after_noon[$index]);
                array_values($this->option_after_noon);
                break;
            case 'option_before_noon':
                unset($this->option_before_noon[$index]);
                array_values($this->option_before_noon);
                break;
            case 'option_after_shift':
                unset($this->option_after_shift[$index]);
                array_values($this->option_after_shift);
                break;
            case 'option_before_shift':
                unset($this->option_before_shift[$index]);
                array_values($this->option_before_shift);
                break;
            case 'option_penance_after':
                unset($this->option_penance_after[$index]);
                array_values($this->option_penance_after);
                break;
            case 'option_penance_before':
                unset($this->option_penance_before[$index]);
                array_values($this->option_penance_before);
                break;
        }
    }

    //Update function
    public function updatedOptionPenanceAfter()
    {
        foreach ($this->option_penance_after as $k => $values)
            $replace = str_replace(',', '', $values['money_penance_after']);
        $datas = number_format(floatval($replace), 0,'.',',');

        $this->option_penance_after[$k]["money_penance_after"] = $datas;

    }

    public function updatedOptionPenanceBefore()
    {
        foreach ($this->option_penance_before as $k => $values)
            $replace = str_replace(',', '', $values['money_penance_before']);
        $datas = number_format(floatval($replace), 0,'.',',');

        $this->option_penance_before[$k]["money_penance_before"] = $datas;

    }

    public function updatedCountMorning()
    {
        $callback = function (Validator $validator) {
            $pass = $validator->passes();
            if (!$pass) {
                $this->count_morning = '';
            }
        };
        if ($this->count_morning) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'count_morning' => 'required|numeric|between:0,9'
            ]);
        }
    }

    public function updatedCountNoon()
    {

        $callback = function (Validator $validator) {
            $pass = $validator->passes();
            if (!$pass) {
                $this->count_noon = '';
            }
        };
        if ($this->count_noon) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'count_noon' => 'required|numeric|max:2|min:0'
            ]);
        }
    }

    public function updatedCountShift()
    {

        $callback = function (Validator $validator) {
            $pass = $validator->passes();
            if (!$pass) {
                $this->count_shift = '';
            }
        };
        if ($this->count_shift) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'count_shift' => 'required|numeric|max:2|min:0'
            ]);
        }
    }

    public function updatedType()
    {
        if ($this->type == 1) {
            $this->openShift = false;
            $this->openDay = !$this->openDay;
            $this->color = 'color:red;border-bottom: 1px solid  red;';
        } elseif ($this->type == 2) {
            $this->openShift = !$this->openShift;
            $this->openDay = false;
            $this->color = 'color:red;border-bottom: 1px solid  red;';
        }
    }

    public function updatedOutputShift()
    {

        $hours = strtotime($this->output_shift) - strtotime($this->input_shift);

        $this->hour_shift = \Illuminate\Support\Str::slug($hours / 60 / 60) . 'H';
        if ($hours > 0) {
            $hour = floor(($hours / 60) / 60);
            $minute = floor(($hours - ($hour * 60 * 60)) / 60);
            if ($hour == 0 && $minute != 0) {
                $this->hour_shift = $minute . "phút";
            } elseif ($minute == 0 && $hour != 0) {
                $this->hour_shift = $hour . "giờ";
            } else {
                $this->hour_shift = $hour . "giờ " . $minute . "phút";
            }
        } else {
            $this->hour_shift = "0h";
        }
    }

    public function updatedInputShift()
    {

        $hours = strtotime($this->input_shift) - strtotime($this->input_shift);

        $this->hour_shift = \Illuminate\Support\Str::slug($hours / 60 / 60) . 'H';
        if ($hours > 0) {
            $hour = floor(($hours / 60) / 60);
            $minute = floor(($hours - ($hour * 60 * 60)) / 60);
            if ($hour == 0 && $minute != 0) {
                $this->hour_shift = $minute . "phút";
            } elseif ($minute == 0 && $hour != 0) {
                $this->hour_shift = $hour . "giờ";
            } else {
                $this->hour_shift = $hour . "giờ " . $minute . "phút";
            }
        } else {
            $this->hour_shift = "0h";
        }
    }

    public function updatedOutputMorning()
    {

        $hours = strtotime($this->output_morning) - strtotime($this->input_morning);

        $this->hour_morning = \Illuminate\Support\Str::slug($hours / 60 / 60) . 'H';
        if ($hours > 0) {
            $hour = floor(($hours / 60) / 60);
            $minute = floor(($hours - ($hour * 60 * 60)) / 60);
            if ($hour == 0 && $minute != 0) {
                $this->hour_morning = $minute . "phút";
            } elseif ($minute == 0 && $hour != 0) {
                $this->hour_morning = $hour . "giờ";
            } else {
                $this->hour_morning = $hour . "giờ " . $minute . "phút";
            }
        } else {
            $this->hour_morning = "0h";
        }
    }

    public function updatedInputMorning()
    {

        $hours = strtotime($this->output_morning) - strtotime($this->input_morning);

        $this->hour_morning = \Illuminate\Support\Str::slug($hours / 60 / 60) . 'H';
        if ($hours > 0) {
            $hour = floor(($hours / 60) / 60);
            $minute = floor(($hours - ($hour * 60 * 60)) / 60);
            if ($hour == 0 && $minute != 0) {
                $this->hour_morning = $minute . "phút";
            } elseif ($minute == 0 && $hour != 0) {
                $this->hour_morning = $hour . "giờ";
            } else {
                $this->hour_morning = $hour . "giờ " . $minute . "phút";
            }
        } else {
            $this->hour_morning = "0h";
        }
    }

    public function updatedOutputNoon()
    {

        $hours = strtotime($this->output_noon) - strtotime($this->input_noon);

        $this->hour_noon = \Illuminate\Support\Str::slug($hours / 60 / 60) . 'H';
        if ($hours > 0) {
            $hour = floor(($hours / 60) / 60);
            $minute = floor(($hours - ($hour * 60 * 60)) / 60);
            if ($hour == 0 && $minute != 0) {
                $this->hour_noon = $minute . "phút";
            } elseif ($minute == 0 && $hour != 0) {
                $this->hour_noon = $hour . "giờ";
            } else {
                $this->hour_noon = $hour . "giờ " . $minute . "phút";
            }
        } else {
            $this->hour_noon = "0h";
        }
    }

    public function updatedInputNoon()
    {

        $hours = strtotime($this->output_noon) - strtotime($this->input_noon);

        $this->hour_noon = \Illuminate\Support\Str::slug($hours / 60 / 60) . 'H';
        if ($hours > 0) {
            $hour = floor(($hours / 60) / 60);
            $minute = floor(($hours - ($hour * 60 * 60)) / 60);
            if ($hour == 0 && $minute != 0) {
                $this->hour_noon = $minute . "phút";
            } elseif ($minute == 0 && $hour != 0) {
                $this->hour_noon = $hour . "giờ";
            } else {
                $this->hour_noon = $hour . "giờ " . $minute . "phút";
            }
        } else {
            $this->hour_noon = "0h";
        }
    }

    // Validate
    public function updatedOptionAfterMorning()
    {
        foreach ($this->option_after_morning as $key => $option)
            $callback = function (Validator $validator) {
                foreach ($this->option_after_morning as $key => $option)
                    $pass = $validator->passes();
                if (!$pass) {
                    $this->option_after_morning[$key]['time_after_morning'] = '';
                }
            };
        if ($option['time_after_morning'] != null) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'option_after_morning.*.time_after_morning' => 'date_format:"H:i"|after:input_morning|before:output_morning',
            ], [
                'after' => 'thời gian nhập phải sau giờ vào làm ca sáng',
                'before' => 'thời gian nhập phải trước giờ tan  làm ca chiều'
            ]);
        };
        /* if ($this->input_morning == null && $this->output_morning == null && $this->count_morning == null && $option['time_after_morning'] != null ) {
             $this->validate([
                 'input_morning' => 'required',
                 'output_morning' => 'required',
                 'count_morning' => 'required',
                 'option_after_morning.*.count_morning' => 'required',
             ]);
         }*/
        $callback_count_after_morning = function (Validator $validator) {
            foreach ($this->option_after_morning as $key => $option)
                $pass = $validator->passes();
            if (!$pass) {
                $this->option_after_morning[$key]['count_after_morning'] = '';
            }
        };
        if ($this->input_morning == null && $this->output_morning == null && $this->count_morning == null &&
            $option['time_after_morning'] != null || $option['count_after_morning'] != null) {
            $this->withValidatorCallback = $callback_count_after_morning;
            $this->validate([
                'input_morning' => 'required',
                'output_morning' => 'required',
                'count_morning' => 'required',
                'option_after_morning.*.time_after_morning' => 'required',
            ]);
        }
        if ($this->input_morning != null && $this->output_morning != null && $this->count_morning != null && $option['time_after_morning'] != null) {
            $this->withValidatorCallback = $callback_count_after_morning;
            $this->validate([
                'option_after_morning.*.count_after_morning' => '|numeric|between:0,4'
            ], [
                'between' => 'công nhập vào phải lớn hơn :min và nhỏ hơn :max'
            ]);
        }
    }

    public function updatedOptionBeforeMorning()
    {
        foreach ($this->option_before_morning as $key => $option)
            $callback = function (Validator $validator) {
                foreach ($this->option_before_morning as $key => $option)
                    $pass = $validator->passes();
                if (!$pass) {
                    $this->option_before_morning[$key]['time_before_morning'] = '';
                }
            };

        if ($option['time_before_morning'] != null) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'option_before_morning.*.time_before_morning' => 'date_format:"H:i"|after:input_morning|before:output_morning',
            ], [
                'after' => 'thời gian nhập phải sau giờ vào làm ca sáng',
                'before' => 'thời gian nhập phải trước giờ tan  làm ca chiều'
            ]);
        };
        $callback_count_before_morning = function (Validator $validator) {
            foreach ($this->option_before_morning as $key => $option)
                $pass = $validator->passes();
            if (!$pass) {
                $this->option_before_morning[$key]['count_before_morning'] = '';
            }
        };
        if ($this->input_morning == null && $this->output_morning == null && $this->count_morning == null &&
            $option['time_before_morning'] != null || $option['count_before_morning'] != null) {
            $this->withValidatorCallback = $callback_count_before_morning;
            $this->validate([
                'input_morning' => 'required',
                'output_morning' => 'required',
                'count_morning' => 'required',
                'option_before_morning.*.time_before_morning' => 'required',
                'option_after_morning.*.time_after_morning' => 'required',
                'option_after_morning.*.count_after_morning' => 'required',
            ]);
        }
        if ($this->input_morning != null && $this->output_morning != null && $this->count_morning != null && $option['time_before_morning'] != null) {
            $this->withValidatorCallback = $callback_count_before_morning;
            $this->validate([
                'option_before_morning.*.count_before_morning' => '|numeric|between:0,3'
            ], [
                'between' => 'công nhập vào phải lớn hơn :min và nhỏ hơn :max'
            ]);
        }
    }

    public function updatedOptionAfterNoon()
    {

        foreach ($this->option_after_noon as $key => $option)
            $callback = function (Validator $validator) {
                foreach ($this->option_after_noon as $key => $option)
                    $pass = $validator->passes();
                if (!$pass) {
                    $this->option_after_noon[$key]['time_after_noon'] = '';
                }
            };
        if ($option['time_after_noon'] != null) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'option_after_noon.*.time_after_noon' => 'date_format:"H:i"|after:input_noon|before:output_noon',
            ], [
                'after' => 'thời gian nhập phải sau giờ vào làm ca sáng',
                'before' => 'thời gian nhập phải trước giờ tan  làm ca chiều'
            ]);
        };

        $callback_count_after_noon = function (Validator $validator) {
            foreach ($this->option_after_noon as $key => $option)
                $pass = $validator->passes();
            if (!$pass) {
                $this->option_after_noon[$key]['count_after_noon'] = '';
            }
        };
        if ($this->input_noon == null && $this->output_noon == null && $this->count_noon == null &&
            $option['time_after_noon'] != null || $option['count_after_noon'] != null) {
            $this->withValidatorCallback = $callback_count_after_noon;
            $this->validate([
                'input_noon' => 'required',
                'output_noon' => 'required',
                'count_noon' => 'required',
                'option_after_noon.*.time_after_noon' => 'required',

            ]);
        }
        if ($this->input_noon != null && $this->output_noon != null && $this->count_noon != null && $option['time_after_noon'] != null) {
            $this->withValidatorCallback = $callback_count_after_noon;
            $this->validate([
                'option_after_noon.*.count_after_noon' => '|numeric|between:0,3'
            ], [
                'between' => 'công nhập vào phải lớn hơn :min và nhỏ hơn :max'
            ]);
        }
    }

    public function updatedOptionBeforeNoon()
    {
        foreach ($this->option_before_noon as $key => $option)
            $callback = function (Validator $validator) {
                foreach ($this->option_before_noon as $key => $option)
                    $pass = $validator->passes();
                if (!$pass) {
                    $this->option_before_noon[$key]['time_before_noon'] = '';
                }
            };

        if ($option['time_before_noon'] != null) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'option_before_noon.*.time_before_noon' => 'date_format:"H:i"|after:input_noon|before:output_noon',
            ], [
                'after' => 'thời gian nhập phải sau giờ vào làm ca sáng',
                'before' => 'thời gian nhập phải trước giờ tan  làm ca chiều'
            ]);
        };
        $callback_count_before_noon = function (Validator $validator) {
            foreach ($this->option_before_noon as $key => $option)
                $pass = $validator->passes();
            if (!$pass) {
                $this->option_before_noon[$key]['count_before_noon'] = '';
            }
        };

        if ($this->input_noon == null && $this->output_noon == null && $this->count_noon == null &&
            $option['time_before_noon'] != null || $option['count_before_noon'] != null && $option['time_before_noon'] == null) {
            $this->withValidatorCallback = $callback_count_before_noon;
            $this->validate([
                'input_noon' => 'required',
                'output_noon' => 'required',
                'count_noon' => 'required',
                'option_before_noon.*.time_before_noon' => 'required',
                'option_after_noon.*.time_after_noon' => 'required',
                'option_after_noon.*.count_after_noon' => 'required',
            ]);
        }

        if ($this->input_noon != null && $this->output_noon != null && $this->count_noon != null && $option['time_before_noon'] != null) {
            $this->withValidatorCallback = $callback_count_before_noon;
            $this->validate([
                'option_before_noon.*.count_before_noon' => '|numeric|between:0,3'
            ], [
                'between' => 'công nhập vào phải lớn hơn :min và nhỏ hơn :max'
            ]);
        }
    }

    public function updatedOptionAfterShift()
    {
        foreach ($this->option_after_shift as $key => $option)
            $callback = function (Validator $validator) {
                foreach ($this->option_after_shift as $key => $option)
                    $pass = $validator->passes();
                if (!$pass) {
                    $this->option_after_shift[$key]['time_after_shift'] = '';
                }
            };

        if ($option['time_after_shift'] != null) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'option_after_shift.*.time_after_shift' => 'date_format:"H:i"|after:input_shift|before:output_shift',
            ], [
                'after' => 'thời gian nhập phải sau giờ vào làm ca ',
                'before' => 'thời gian nhập phải trước giờ tan ca '
            ]);
        };
        $callback_count_after_shift = function (Validator $validator) {
            foreach ($this->option_after_shift as $key => $option)
                $pass = $validator->passes();
            if (!$pass) {
                $this->option_after_shift[$key]['count_after_shift'] = '';
            }
        };
        if ($this->input_shift == null && $this->output_shift == null && $this->count_shift == null &&
            $option['time_after_shift'] != null || $option['count_after_shift'] != null) {
            $this->withValidatorCallback = $callback_count_after_shift;
            $this->validate([
                'input_shift' => 'required',
                'output_shift' => 'required',
                'count_shift' => 'required',
                'option_after_shift.*.time_after_shift' => 'required'
            ]);
        }
        if ($this->input_shift != null && $this->output_shift != null && $this->count_shift != null && $option['time_after_shift'] != null) {
            $this->withValidatorCallback = $callback_count_after_shift;
            $this->validate([
                'option_after_shift.*.time_after_shift' => '|numeric|between:0,3'
            ], [
                'between' => 'công nhập vào phải lớn hơn :min và nhỏ hơn :max'
            ]);
        }
    }

    public function updatedOptionBeforeShift()
    {
        foreach ($this->option_before_shift as $key => $option)
            $callback = function (Validator $validator) {
                foreach ($this->option_before_shift as $key => $option)
                    $pass = $validator->passes();
                if (!$pass) {
                    $this->option_before_shift[$key]['time_before_shift'] = '';
                }
            };

        if ($option['time_before_shift'] != null) {
            $this->withValidatorCallback = $callback;
            $this->validate([
                'option_before_shift.*.time_before_shift' => 'date_format:"H:i"|after:input_shift|before:output_shift',
            ], [
                'after' => 'thời gian nhập phải sau giờ vào làm ca ',
                'before' => 'thời gian nhập phải trước giờ tan ca '
            ]);
        };
        $callback_count_before_shift = function (Validator $validator) {
            foreach ($this->option_before_shift as $key => $option)
                $pass = $validator->passes();
            if (!$pass) {
                $this->option_before_shift[$key]['count_before_shift'] = '';
            }
        };
        if ($this->input_shift == null && $this->output_shift == null && $this->count_shift == null &&
            $option['time_before_shift'] != null || $option['count_before_shift'] != null && $option['time_before_shift'] == null) {
            $this->withValidatorCallback = $callback_count_before_shift;
            $this->validate([
                'input_shift' => 'required',
                'output_shift' => 'required',
                'count_shift' => 'required',
                'option_before_shift.*.time_before_shift' => 'required',
                'option_after_shift.*.time_after_shift' => 'required',
                'option_after_shift.*.count_after_shift' => 'required',
            ]);
        }
        if ($this->input_shift != null && $this->output_shift != null && $this->count_shift != null && $option['time_before_shift'] != null) {
            $this->withValidatorCallback = $callback_count_before_shift;
            $this->validate([
                'option_before_shift.*.time_before_shift' => '|numeric|between:0,3'
            ], [
                'between' => 'công nhập vào phải lớn hơn :min và nhỏ hơn :max'
            ]);
        }
    }


    public function mount()
    {

        $this->authorize("time-keep.timekeeprules.edit");
        $data = timekeeprule::findOrFail($this->record_id);
        $this->name = $data->name;
        $values = json_decode($data->value);
        $this->status = $data->status;
        $this->type = $data->type;


        if ($data->type == 1) {
            $this->input_morning = $values->morning->input_morning;
            $this->output_morning = $values->morning->output_morning;
            $this->count_morning = $values->morning->count_morning;
            $this->input_noon = $values->afternoon->input_noon;
            $this->output_noon = $values->afternoon->output_noon;
            $this->count_noon = $values->afternoon->count_noon;
            $this->option_before_morning = $values->morning->option->before_morning;
            $this->option_after_morning = $values->morning->option->after_morning;
            $this->option_before_noon = $values->afternoon->option->before_noon;
            $this->option_after_noon = $values->afternoon->option->after_noon;
            $this->option_penance_after = $values->penance->penance_after;
            $this->option_penance_before = $values->penance->penance_before;

        } else if ($data->type == 2) {
            $this->input_shift = $values->input_shift;
            $this->output_shift = $values->output_shift;
            $this->count_shift = $values->count_shift;
            $this->option_before_shift = $values->option->before_shift;
            $this->option_after_shift = $values->option->after_shift;
            $this->day_apply = $values->day_apply;
            $this->option_penance_after = $values->penance->penance_after;
            $this->option_penance_before = $values->penance->penance_before;
        }


    }


    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.timekeeprules.edit");

        $data = timekeeprule::findOrFail($this->record_id);
        $types = $this->type;

        if ($types == 1) {
            $this->validate([
                'input_morning' => 'required|date_format:"H:i"|after:00:00|before:"12:01"|',
                'output_morning' => 'required|date_format:"H:i"|after:input_morning|before:"12:01"',
                'option_after_morning.*.time_after_morning' => 'date_format:"H:i"|after:input_morning|before:output_morning',
                'option_after_morning.*.count_after_morning' => 'max:4',
                'option_before_morning.*.time_before_morning' => 'date_format:"H:i"|after:input_morning|before:output_morning',
                'option_before_morning.*.count_before_morning' => 'numeric|max:count_morning',

                //Chiều

                'input_noon' => 'required|date_format:"H:i"|after:"11:59"|before:"23:59"|',
                'output_noon' => 'required|date_format:"H:i"|after:input_noon|before:"23:59"',
                'option_after_noon.*.time_after_noon' => 'date_format:"H:i"|after:input_noon|before:output_noon',
                /*  'option_after_noon.*.count_after_noon'=>'numeric|max:2',*/
                'option_before_noon.*.time_before_noon' => 'date_format:"H:i"|after:"13:00"|before:output_noon',
                'option_before_noon.*.count_before_noon' => 'numeric|max:count_noon',
            ]);
        }
        if ($types == 2) {
            $this->validate([
                'input_shift' => 'required|date_format:"H:i"|after:"00:00"|before:"23:59"|',
                'output_shift' => 'required|date_format:"H:i"|after:input_shift|before:"23:59"',
                'option_after_shift.*.time_after_shift' => 'date_format:"H:i"|after:input_shift|before:output_shift',
                'option_after_shift.*.count_after_shift' => 'max:count_shift',
                'option_before_shift.*.time_before_shift' => 'date_format:"H:i"|after:input_shift|before:output_shift',
                'option_before_shift.*.count_before_shift' => 'max:count_shift',
                'day_apply' => 'required',

            ]);
        }

        sort($this->option_after_morning);
        rsort($this->option_before_morning);
        sort($this->option_after_noon);
        rsort($this->option_before_noon);
        sort($this->option_after_shift);
        rsort($this->option_before_shift);
        sort($this->option_penance_after);
        rsort($this->option_penance_before);
        switch ($types) {
            case 1:

                $data->fill([
                    'name' => $this->name,
                    'value' => json_encode([
                        'morning' => [
                            'input_morning' => $this->input_morning,
                            'output_morning' => $this->output_morning,
                            'count_morning' => $this->count_morning,
                            'option' => [
                                'before_morning' => $this->option_before_morning,
                                'after_morning' => $this->option_after_morning,
                            ],
                        ],
                        'afternoon' => [
                            'input_noon' => $this->input_noon,
                            'output_noon' => $this->output_noon,
                            'count_noon' => $this->count_noon,
                            'option' => [
                                'before_noon' => $this->option_before_noon,
                                'after_noon' => $this->option_after_noon,
                            ],
                        ],
                        'penance'=> [
                            'penance_after'=>$this->option_penance_after,
                            'penance_before' => $this->option_penance_before,
                        ],
                    ]),
                    'status' => $this->status,
                    'type' => $this->type,
                ]);
                break;

            case 2:
                $data->fill([
                    'name' => $this->name,
                    'value' => json_encode([
                        'input_shift' => $this->input_shift,
                        'output_shift' => $this->output_shift,
                        'count_shift' => $this->count_shift,
                        'option' => [
                            'before_shift' => $this->option_before_shift,
                            'after_shift' => $this->option_after_shift,
                        ],
                        'day_apply' => $this->day_apply,
                        'penance'=> [
                            'penance_after'=>$this->option_penance_after,
                            'penance_before' => $this->option_penance_before,
                        ],
                    ]),

                    'status' => $this->status,
                    'type' => $this->type,
                ]);
                break;
        }


        if (!$data->clean) {
            $data->update();
            $this->redirectForm("time-keep.timekeeprules", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Timekeeprules");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeeprules"), "Timekeeprules");
        lForm()->pushBreadcrumb(route("time-keep.timekeeprules.edit", $this->record_id), "Edit");

        $day_apply1 = [
            0 => 'Chủ nhật',
            1 => 'Thứ hai',
            2 => 'Thứ ba',
            3 => 'Thứ tư',
            4 => 'Thứ năm',
            5 => 'Thứ sáu',
            6 => 'Thứ bảy',
        ];

        return view("time-keep::livewire.timekeeprules.edit", compact('day_apply1'))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeprules Edit']);
    }
}
