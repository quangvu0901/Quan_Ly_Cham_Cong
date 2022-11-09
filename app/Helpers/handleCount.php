<?php

use App\Models\TimekeepRule;
use Carbon\Carbon;

class timeKeep
{
    function handleTotal($check_in = 0, $check_out = 0,$timeKeepRule)
    {
//        $timeKeepRule = TimekeepRule::where('active', 1)->get();
        if (count($timeKeepRule) == 0) {
            $all_count = [
                'count' => 0,
                'sum_money_after' => 0,
                'sum_money_before' => 0,
            ];
            return $all_count;
        } else {
            foreach ($timeKeepRule as $key => $items)
                $types = $items->type;
            switch ($types) {
                /// Chấm công theo ngày
                case 1:
                    $count_timekeepday = 0;
                    foreach ($timeKeepRule as $key => $timeRule) {
                        $types = $timeRule->type;
                        $values = json_decode($timeRule->value);
                        $default_input_morning = strtotime($values->morning->input_morning);
                        $default_output_morning = strtotime($values->morning->output_morning);
                        $default_count_morning = $values->morning->count_morning;
                        $after_morning = $values->morning->option->after_morning;
                        $before_morning = $values->morning->option->before_morning;
                        $default_input_noon = strtotime($values->afternoon->input_noon);
                        $default_output_noon = strtotime($values->afternoon->output_noon);
                        $default_count_noon = $values->afternoon->count_noon;
                        $before_noon = $values->afternoon->option->before_noon;
                        $after_noon = $values->afternoon->option->after_noon;
                        $default_penance_after = $values->penance->penance_after;
                        $default_penance_before = $values->penance->penance_before;
                    }


                    $input_morning = ($default_input_morning);
                    $output_morning = ($default_output_morning);
                    $count_morning = $default_count_morning;
                    $input_noon = ($default_input_noon);
                    $output_noon = ($default_output_noon);
                    $count_noon = $default_count_noon;
                    $penance_after = $default_penance_after;
                    $penance_before = $default_penance_before;
//                    dd($punish_after,$punish_before);
                    //sang
                    //--------------------------------------------------------------------------//

                    $arrayMorning = [
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                        'input' => $input_morning,
                        'output' => $output_morning,
                        'count' => $count_morning,
                        'after'=> $after_morning,
                        'before' => $before_morning,
                        'late' => $penance_after,
                        'soon' => $penance_before,
                    ];

                    $arrayAfterNoon = [
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                        'input' => $input_noon,
                        'output' => $output_noon,
                        'count' => $count_noon,
                        'after'=> $after_noon,
                        'before' => $before_noon,
                        'late' => $penance_after,
                        'soon' => $penance_before,
                    ];

                    $sum_count_mor = 0;
                    $sum_count_aft = 0;
                    $sum_money_late_mor = 0;
                    $sum_money_soon_mor = 0;
                    $sum_money_late_aft = 0;
                    $sum_money_soon_aft = 0;


                    if ($check_in <= $input_morning && $check_out >= $output_noon) {
                        $sum_count_mor = $count_morning;
                    }else{
                        $sum_count_mor = $this->countDay($arrayMorning);
                        $sum_money_late_mor = $this->PenanceMonneyLate($arrayMorning);
                        $sum_money_soon_mor = $this->PenanceMonneySoon($arrayMorning);
                    }
                    if ($check_in <= $input_noon && $check_out >= $output_noon) {
                        $sum_count_aft = $count_noon;
                    } else {
                        $sum_count_aft = $this->countDay($arrayAfterNoon);
                        $sum_money_late_aft = $this->PenanceMonneyLate($arrayAfterNoon);
                        $sum_money_soon_aft = $this->PenanceMonneySoon($arrayAfterNoon);
                    }

                    if($sum_count_mor + $sum_count_aft <= 0){
                        $count_timekeepday = 0;
                        $all_count = [
                            'count' => $count_timekeepday,
                            'sum_money_after' => 0,
                            'sum_money_before' => 0,
                        ];
                    }else {
                        $sum_money_late = $sum_money_late_mor + $sum_money_late_aft;
                        $sum_money_soon = $sum_money_soon_mor + $sum_money_soon_aft;
                        $count_timekeepday = $sum_count_mor + $sum_count_aft;

                        $all_count = [
                            'count' => $count_timekeepday,
                            'sum_money_after' => $sum_money_late,
                            'sum_money_before' => $sum_money_soon,
                        ];
                    }
                    return $all_count;
                    break;

                /// Chấm công theo ca
                case 2:
                    foreach ($timeKeepRule as $key => $timeRule) {
                        $values = json_decode($timeRule->value);
                        $default_input_shift = $values->input_shift;
                        $default_output_shift = $values->output_shift;
                        $default_count_shift = $values->count_shift;
                        $after_shift = $values->option->after_shift;
                        $before_shift = $values->option->before_shift;
                        $day_apply = $values->day_apply;
                        $default_penance_after = $values->penance->penance_after;
                        $default_penance_before = $values->penance->penance_before;
                    }

                    $input_shift = strtotime($default_input_shift);
                    $output_shift = strtotime($default_output_shift);
                    $count_shift = $default_count_shift;

                    $arrayShift = [
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                        'input' => $input_shift,
                        'output' => $output_shift,
                        'count' => $count_shift,
                        'before' => $before_shift,
                        'after' => $after_shift,
                        'late' => $default_penance_after,
                        'soon' => $default_penance_before,
                    ];

                    $sum_count = 0;
                    $sum_money_late = 0;
                    $sum_money_soon = 0;

                    if ($check_in <= $input_shift && $check_out >= $output_shift) {
                        $sum_count = $count_shift;
                    } else {
                        $sum_count = $this->countDay($arrayShift);
                        $sum_money_late = $this->PenanceMonneyLate($arrayShift);
                        $sum_money_soon = $this->PenanceMonneySoon($arrayShift);
                    }
                    if ($sum_count <= 0) {
                        $handle = [
                            'count' => 0,
                            'sum_money_late' => 0,
                            'sum_money_soon' => 0
                        ];
                    } else {

                        $handle = [
                            'count' => $sum_count,
                            'sum_money_late' => $sum_money_late,
                            'sum_money_soon' => $sum_money_soon
                        ];
                    }
                    return $handle;
                    break;
                default:
                    break;
            }
        }
    }

    function countDay($array = [])
    {
        foreach ($array['after'] as $key => $item1) {
            $time_after[$key] = strtotime($item1->time_after);
            $count_after[$key] = $item1->count_after;
        }
        foreach ($array['before'] as $key => $item2) {
            $time_before[$key] = strtotime($item2->time_before);
            $count_before[$key] = $item2->count_before;
        }

        $n1 = count($time_after);
        $n2 = count($time_before);
        $sum_count = 0;

        if (!empty($time_after[0]) && !empty($time_before[0])) {
            for ($i = 0; $i < $n1; $i++) {
                /// đi sớm về đúng giờ
                if ($time_after[$i] < $array['check_in'] ) {
                    $sum_count = $count_after[$i];
                /// đi muộn về đúng giờ
                } elseif ($time_after[0] >= $array['check_in']) {
                    $sum_count = $array['count'];
                }
            }
            for ($i = 0; $i < $n1; $i++) {
                for ($j = 0; $j < $n2; $j++) {

                    if ($time_after[0] >= $array['check_in'] && $array['check_out'] < $time_before[$j]) {
                        $sum_count = $count_before[$j];
                    } elseif ($time_after[0] >= $array['check_in'] && $array['check_out'] >= $time_before[0]) {
                        $sum_count = $array['count'];
                    } elseif ($time_after[$i] < $array['check_in'] && $array['check_out'] < $time_before[$j]) {
                        $sum_count = round((($array['check_out'] - $array['check_in']) / ($array['output'] - $array['input'])) * $array['count'], 2);
                    }
                }
            }
        } elseif (!empty($time_after[0]) && empty($time_before[0])) {
            for ($i = 0; $i < $n1; $i++) {
                if ($time_after[$i] < $array['check_in']) {
                    $sum_count = $count_after[$i];
                } elseif ($time_after[0] >= $array['check_in']) {
                    $sum_count = $array['count'];
                }
            }
        } elseif (empty($time_after[0]) && !empty($time_before[0])) {
            for ($j = 0; $j < $n2; $j++) {
                if ($array['check_out'] < $time_before[$j]) {
                    $sum_count = $count_before[$j];
                } elseif ($array['check_out'] >= $time_before[0]) {
                    $sum_count = $array['count'];
                }
            }
        } else {
            $sum_count = $array['count'];
        }
        return $sum_count;
    }

//Hàm tính tiền phạt khi đi muộn
    function PenanceMonneyLate($array = []){
//        dd($array);
        foreach ($array['late'] as $key => $item3) {
            $time_penance_after[$key] = $item3->time_penance_after;
            $money_penance_after[$key] = str_replace(',','',$item3->money_penance_after);
        }

        $n3 = count($time_penance_after);
        $sum_money_late = 0;

        if (!empty($time_penance_after[0])) {
            if ($array['check_in'] < $array['output']) {
                for ($x = 0; $x < $n3; $x++) {
                    if (($array['check_in'] - $array['input']) >= $time_penance_after[$x] * 60) {
                        $sum_money_late = $money_penance_after[$x];
                    }
                }
            }
        } else {
            $sum_money_late = 0;
        }
        return $sum_money_late;
    }

//Hàm tính tiền phạt khi về sớm
    function PenanceMonneySoon($array = [])
    {
        foreach ($array['soon'] as $key => $item3) {
            $time_penance_before[$key] = $item3->time_penance_before;
            $money_penance_before[$key] = str_replace(',','',$item3->money_penance_before);
        }

        $n3 = count($time_penance_before);
        $sum_money_soon = 0;

        if (!empty($time_penance_before[0])) {
            if ($array['check_out'] > $array['input']) {
                for ($x = 0; $x < $n3; $x++) {
                    if (($array['output'] - $array['check_out']) >= $time_penance_before[$x] * 60) {
                        $sum_money_soon = $money_penance_before[$x];
                    }
                }
            }
        } else {
            $sum_money_soon = 0;
        }
        return $sum_money_soon;
    }


}




