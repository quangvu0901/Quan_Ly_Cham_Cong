<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info">
        <x-lf.form.input name="name" type="string" label="Tên chấm công" onClick="this.select();"
                         placeholder="Tên chấm công ..."/>

        <div style="width: 100%">
            <div class="container mx-auto" style="padding: 5px 7px">
                <div>
                    <x-lf.form.select name="type" label="Kiểu chấm công"
                                      :params="[0 => 'Chọn kiểu tính công',1 => 'Tinh Công theo ngày',2 => 'Tinh Công theo ca']"/>
                </div>
                @if ($openDay)
                    <div style=" ">
                        <div style="display: flex; padding: 10px; margin: 10px">
                            <div style="width: 48%; ">
                                <b style="padding: 7px; font-size: 16px"> Thiết lập ca sáng</b><label
                                    style="font-size: 14px;background-color: #ffffff">(Tổng thời gian:
                                    <span>{{ $hour_morning }}</span>)</label>
                                <div style="display: flex; padding: 1% 0">
                                    <x-lf.form.input name="input_morning" type="time" label="Giờ vào làm việc"/>
                                    <x-lf.form.input name="output_morning" type="time" label="Giờ tan ca"/>
                                    <x-lf.form.input name="count_morning" type="number" onClick="this.select();"
                                                     label="Số công" placeholder="vd: 0.5,1,2,..."
                                                     style="-webkit-appearance: none;"/>
                                </div>
                                <div
                                    style="display: flex; width: 100%; border-top: 1px solid #CCCCCC;border-bottom: 1px solid #CCCCCC;">
                                    <div style=" padding: 2%">
                                        <b style="font-size: 16px">Tính công khi đi làm muộn</b>
                                        @foreach($option_after_morning as $key => $option_after_mor)
                                            <div style="display: flex;padding-bottom: 10px;width: 100%;">
                                                <a style="margin-top: 32px">Nếu</a>
                                                <x-lf.form.input name="option_after_morning.{{$key}}.time_after"
                                                                 type="time"
                                                                 label="Thực hiện chấm công sau thời gian này"
                                                                 style="width: 200px"/>
                                                <a style="margin-top: 32px">Thì</a>
                                                <x-lf.form.input type="number" onClick="this.select();"
                                                                 name="option_after_morning.{{$key}}.count_after"
                                                                 label="Số công được tính là" style="width: 200px"
                                                                 placeholder="vd: 0.5,1,2,..."/>
                                                @if(count($option_after_morning) >1)
                                                    <a style="cursor: pointer;margin-top: 32px"
                                                       wire:click.prevent="removeElementBy('option_after_morning',{{$key}})"
                                                       title="Xóa thời gian này">{!! lfIcon('delete',20) !!}</a>
                                                @endif
                                            </div>
                                        @endforeach
                                        <button class="btn-primary"
                                                wire:click.prevent="addElementBy('option_after_morning')"
                                                title="Thêm thời gian mới"
                                                style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                        </button>
                                    </div>
                                </div>

                                <div style="display: flex; width: 100%;border-bottom: 1px solid #CCCCCC;">
                                    <div style=" padding: 2%">
                                        <b style="font-size: 16px">Tính công khi đi về sớm</b>
                                        @foreach($option_before_morning as $key => $option_before_mor)
                                            <div style="display: flex;padding-bottom: 10px;width: 100%;">
                                                <a style="margin-top: 32px">Nếu</a>
                                                <x-lf.form.input
                                                    name="option_before_morning.{{$key}}.time_before"
                                                    type="time" label="Thực hiện chấm công trước thời gian này"
                                                    style="width: 200px"/>
                                                <a style="margin-top: 32px">Thì</a>
                                                <x-lf.form.input type="number" onClick="this.select();"
                                                                 name="option_before_morning.{{$key}}.count_before"
                                                                 label="Số công được tính là" style="width: 200px"
                                                                 placeholder="vd: 0.5,1,2,..."/>
                                                @if(count($option_before_morning) > 1)
                                                    <a style="cursor: pointer;margin-top: 32px"
                                                       wire:click.prevent="removeElementBy('option_before_morning',{{$key}})"
                                                       title="Xóa thời gian này">{!! lfIcon('delete',20) !!}</a>
                                                @endif
                                            </div>
                                        @endforeach
                                        <button class="btn-primary"
                                                wire:click.prevent="addElementBy('option_before_morning')"
                                                title="Thêm thời gian mới"
                                                style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div style="border-right: 1px solid #CCCCCC;margin: 0 1%"></div>
                            <div style="width: 48%">
                                <b style="padding: 7px; font-size: 16px"> Thiết lập chiều</b><label
                                    style="font-size: 14px;background-color: #ffffff">(Tổng thời
                                    gian:<span>{{ $hour_noon }}</span>)</label>
                                <div style="display: flex; padding: 1% 0">
                                    <x-lf.form.input name="input_noon" type="time" label="Giờ vào làm việc"/>
                                    <x-lf.form.input name="output_noon" type="time" label="Giờ tan ca"/>
                                    <x-lf.form.input name="count_noon" onClick="this.select();" type="number"
                                                     label="Số công" placeholder="vd: 0.5,1,2,..."/>
                                </div>

                                <div
                                    style="display: flex; width: 100%;border-top: 1px solid #CCCCCC;border-bottom: 1px solid #CCCCCC;">
                                    <div style=" padding: 2%">
                                        <b style="font-size: 16px">Tính công khi đi làm muộn</b>
                                        @foreach($option_after_noon as $key => $option_afternoon)
                                            <div style="display: flex;padding-bottom: 10px;width: 100%;">
                                                <a style="margin-top: 32px">Nếu</a>
                                                <x-lf.form.input name="option_after_noon.{{$key}}.time_after"
                                                                 type="time"
                                                                 label="Thực hiện chấm công sau thời gian này"
                                                                 style="width: 200px"/>
                                                <a style="margin-top: 32px">Thì</a>
                                                <x-lf.form.input type="number" onClick="this.select();"
                                                                 name="option_after_noon.{{$key}}.count_after"
                                                                 label="Số công được tính là" style="width: 200px"
                                                                 placeholder="vd: 0.5,1,2,..."/>
                                                @if(count($option_after_noon) > 1)
                                                    <a style="cursor: pointer;margin-top: 32px"
                                                       wire:click.prevent="removeElementBy('option_after_noon',{{$key}})"
                                                       title="Xóa thời gian này">{!! lfIcon('delete',20) !!}</a>
                                                @endif
                                            </div>
                                        @endforeach
                                        <button class="btn-primary"
                                                wire:click.prevent="addElementBy('option_after_noon')"
                                                title="Thêm thời gian mới"
                                                style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                        </button>
                                    </div>
                                </div>

                                <div style="display: flex; width: 100%;border-bottom: 1px solid #CCCCCC;">
                                    <div style=" padding: 2%">
                                        <b style="font-size: 16px">Tính công khi đi về sớm</b>
                                        @foreach($option_before_noon as $key => $option_beforenoon)
                                            <div style="display: flex;padding-bottom: 10px;width: 100%;">
                                                <a style="margin-top: 32px">Nếu</a>
                                                <x-lf.form.input name="option_before_noon.{{$key}}.time_before"
                                                                 type="time"
                                                                 label="Thực hiện chấm công trước thời gian này"
                                                                 style="width: 200px"/>
                                                <a style="margin-top: 32px">Thì</a>
                                                <x-lf.form.input type="number" onClick="this.select();"
                                                                 name="option_before_noon.{{$key}}.count_before"
                                                                 label="Số công được tính là" style="width: 200px"
                                                                 placeholder="vd: 0.5,1,2,..."/>
                                                @if(count($option_before_noon) > 1)
                                                    <a style="cursor: pointer;margin-top: 32px"
                                                       wire:click.prevent="removeElementBy('option_before_noon',{{$key}})"
                                                       title="Xóa thời gian này">{!! lfIcon('delete',20) !!}</a>
                                                @endif
                                            </div>
                                        @endforeach
                                        <button class="btn-primary"
                                                wire:click.prevent="addElementBy('option_before_noon')"
                                                title="Thêm thời gian mới"
                                                style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%; padding: 0 2% 2% 2%;display: flex">
                            <div style="width: 100%;">
                                <b style="padding: 7px; font-size: 16px">Tiền phạt đi muộn</b>
                                @foreach($option_penance_after as $key => $option_pu_after)
                                    <div style="display: flex;padding-bottom: 10px; width: 100%">
                                        <div style="display: flex; margin-right: 3px">
                                            <a style="margin-top: 32px">Nếu</a>
                                            <x-lf.form.input name="option_penance_after.{{$key}}.time_penance_after"
                                                             type="number" label="Thời gian đi muộn là"
                                                             style="width: 100px" placeholder="vd: 10" onClick="this.select();"/>
                                            <a style="margin-top: 32px">Phút</a>
                                        </div>
                                        <div style="display: flex">
                                            <a style="margin-top: 32px">Thì</a>
                                            <x-lf.form.input type="text" onClick="this.select();"
                                                             name="option_penance_after.{{$key}}.money_penance_after"
                                                             label="Số tiền phải nộp phạt là" style="width: 200px"
                                                             placeholder="vd: 20,000"/>
                                            <a style="margin-top: 32px">VNĐ</a>
                                        </div>
                                        @if(count($option_penance_after) > 1)
                                            <a style="cursor: pointer;margin-top: 32px"
                                               wire:click.prevent="removeElementBy('option_penance_after',{{$key}})"
                                               title="Xóa khung phạt này">{!! lfIcon('delete',20) !!}</a>
                                        @endif
                                    </div>
                                @endforeach
                                <button class="btn-primary" wire:click.prevent="addElementBy('option_penance_after')"
                                        title="Thêm thời gian mới"
                                        style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                </button>
                            </div>

                            <div style="width: 100%">
                                <b style="padding: 7px; font-size: 16px">Tiền phạt về sớm</b>
                                @foreach($option_penance_before as $key => $option_pu_before)
                                    <div style="display: flex;padding-bottom: 10px; width: 100%">
                                        <div style="display: flex; margin-right: 3px">
                                            <a style="margin-top: 32px">Nếu</a>
                                            <x-lf.form.input name="option_penance_before.{{$key}}.time_penance_before"
                                                             type="number" label="Thời gian đi muộn là"
                                                             style="width: 100px" placeholder="vd: 10" onClick="this.select();"/>
                                            <a style="margin-top: 32px">Phút</a>
                                        </div>
                                        <div style="display: flex">
                                            <a style="margin-top: 32px">Thì</a>
                                            <x-lf.form.input type="text" onClick="this.select();"
                                                             name="option_penance_before.{{$key}}.money_penance_before"
                                                             label="Số tiền phải nộp phạt là" style="width: 200px"
                                                             placeholder="vd: 20,000"/>
                                            <a style="margin-top: 32px">VNĐ</a>
                                        </div>
                                        @if(count($option_penance_before) > 1)
                                            <a style="cursor: pointer;margin-top: 32px"
                                               wire:click.prevent="removeElementBy('option_penance_before',{{$key}})"
                                               title="Xóa khung phạt này">{!! lfIcon('delete',20) !!}</a>
                                        @endif
                                    </div>
                                @endforeach
                                <button class="btn-primary" wire:click.prevent="addElementBy('option_penance_before')"
                                        title="Thêm thời gian mới"
                                        style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                </button>
                            </div>
                        </div>

                    </div>
                @endif

                @if ($openShift)
                    <div style=" padding: 1%">
                        <b style="padding: 7px; font-size: 16px;">Thời gian làm việc</b>
                        <b style="padding: 7px; font-size: 16px"> Thiết lập chiều</b><label
                            style="font-size: 14px;background-color: #ffffff">(Tổng thời
                            gian:<span>{{ $hour_shift }}</span>)</label>
                        <div style="display: flex; width: 70%;">
                            <x-lf.form.input name="input_shift" type="time" label="Thời gian bắt đầu ca"/>
                            <x-lf.form.input name="output_shift" type="time" label="Thời gian kết thúc ca"/>
                            <x-lf.form.input name="count_shift" onClick="this.select();" type="number"
                                             label="Số công nhận được trong ca" placeholder="vd: 0.5,1,2,..."/>
                        </div>
                        <div style="margin: 10px; display: flex">
                            <div style="display: flex; width: 100%; ">
                                <div
                                    style="width: 38%; border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC; padding: 1%">
                                    <b style="font-size: 16px">Tính công khi đi làm muộn</b>
                                    @foreach($option_after_shift as $key => $option_aftershift)
                                        <div style="display: flex;padding-bottom: 10px;width: 100%;">
                                            <a style="margin-top: 32px">Nếu</a>
                                            <x-lf.form.input name="option_after_shift.{{$key}}.time_after"
                                                             type="time" label="Thực hiện chấm công sau thời gian này"
                                                             style="width: 200px"/>
                                            <a style="margin-top: 32px">Thì</a>
                                            <x-lf.form.input type="number" onClick="this.select();"
                                                             name="option_after_shift.{{$key}}.count_after"
                                                             label="Số công được tính này là" style="width: 200px"
                                                             placeholder="vd: 0.5,1,2,..."/>
                                            @if(count($option_after_shift)>1)
                                                <a style="cursor: pointer;margin-top: 32px"
                                                   wire:click.prevent="removeElementBy('option_after_shift',{{$key}})"
                                                   title="Xóa thời gian này">{!! lfIcon('delete',20) !!}</a>
                                            @endif
                                        </div>
                                    @endforeach
                                    <button class="btn-primary" wire:click.prevent="addElementBy('option_after_shift')"
                                            title="Thêm thời gian mới"
                                            style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                    </button>
                                </div>
                                <div
                                    style="width: 38%;  border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC; padding: 1%;margin-right: 5px">
                                    <b style="font-size: 16px">Tính công khi đi về sớm</b>
                                    @foreach($option_before_shift as $key => $option_beforeshift)
                                        <div style="display: flex;padding-bottom: 10px;width: 100%;">
                                            <a style="margin-top: 32px">Nếu</a>
                                            <x-lf.form.input name="option_before_shift.{{$key}}.time_before"
                                                             type="time" label="Thực hiện chấm công trước thời gian này"
                                                             style="width: 200px"/>
                                            <a style="margin-top: 32px">Thì</a>
                                            <x-lf.form.input type="number" onClick="this.select();"
                                                             name="option_before_shift.{{$key}}.count_before"
                                                             label="Số công được tính là" style="width: 200px"
                                                             placeholder="vd: 0.5,1,2,..."/>
                                            @if(count($option_before_shift)>1)
                                                <a style="margin-top: 32px"
                                                   wire:click.prevent="removeElementBy('option_before_shift',{{$key}})"
                                                   title="Xóa thời gian này">{!! lfIcon('delete',20) !!}</a>
                                            @endif
                                        </div>
                                    @endforeach
                                    <button class="btn-primary" wire:click.prevent="addElementBy('option_before_shift')"
                                            title="Thêm thời gian mới"
                                            style="padding: 10px 10px;margin: 0 10px">Thêm luật
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%; padding: 0 2% 2% 2%;display: flex">
                            <div style="width: 62%;">
                                <b style="padding: 7px; font-size: 16px">Tiền phạt đi muộn</b>
                                @foreach($option_penance_after as $key => $option_pu_after)
                                    <div style="display: flex;padding-bottom: 10px; width: 100%">
                                        <div style="display: flex; margin-right: 3px">
                                            <a style="margin-top: 32px">Nếu</a>
                                            <x-lf.form.input name="option_penance_after.{{$key}}.time_penance_after"
                                                             type="number" label="Thời gian đi muộn là"
                                                             style="width: 100px" placeholder="vd: 10" onClick="this.select();"/>
                                            <a style="margin-top: 32px">Phút</a>
                                        </div>
                                        <div style="display: flex">
                                            <a style="margin-top: 32px">Thì</a>
                                            <x-lf.form.input type="text" onClick="this.select();"
                                                             name="option_penance_after.{{$key}}.money_penance_after"
                                                             label="Số tiền phải nộp phạt là" style="width: 200px"
                                                             placeholder="vd: 20,000"/>
                                            <a style="margin-top: 32px">VNĐ</a>
                                        </div>
                                        @if(count($option_penance_after) > 1)
                                            <a style="cursor: pointer;margin-top: 32px"
                                               wire:click.prevent="removeElementBy('option_penance_after',{{$key}})"
                                               title="Xóa khung phạt này">{!! lfIcon('delete',20) !!}</a>
                                        @endif
                                    </div>
                                @endforeach
                                <button class="btn-primary" wire:click.prevent="addElementBy('option_penance_after')"
                                        title="Thêm thời gian mới"
                                        style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                </button>
                            </div>
                            <div style="width: 100%">
                                <b style="padding: 7px; font-size: 16px">Tiền phạt về sớm</b>
                                @foreach($option_penance_before as $key => $option_pu_before)
                                    <div style="display: flex;padding-bottom: 10px; width: 100%">
                                        <div style="display: flex; margin-right: 3px">
                                            <a style="margin-top: 32px">Nếu</a>
                                            <x-lf.form.input name="option_penance_before.{{$key}}.time_penance_before"
                                                             type="number" label="Thời gian về sớm là"
                                                             style="width: 100px" placeholder="vd: 10" onClick="this.select();"/>
                                            <a style="margin-top: 32px">Phút</a>
                                        </div>
                                        <div style="display: flex">
                                            <a style="margin-top: 32px">Thì</a>
                                            <x-lf.form.input type="text" onClick="this.select();"
                                                             name="option_penance_before.{{$key}}.money_penance_before"
                                                             label="Số tiền phải nộp phạt là" style="width: 200px"
                                                             placeholder="vd: 20,000"/>
                                            <a style="margin-top: 32px">VNĐ</a>
                                        </div>
                                        @if(count($option_penance_before) > 1)
                                            <a style="cursor: pointer;margin-top: 32px"
                                               wire:click.prevent="removeElementBy('option_penance_before',{{$key}})"
                                               title="Xóa khung phạt này">{!! lfIcon('delete',20) !!}</a>
                                        @endif
                                    </div>
                                @endforeach
                                <button class="btn-primary" wire:click.prevent="addElementBy('option_penance_before')"
                                        title="Thêm thời gian mới"
                                        style="cursor: pointer;padding: 10px 10px;margin: 0 10px">Thêm luật
                                </button>
                            </div>
                        </div>

                        <div style="padding: 1%">
                            <div>
                                <p><b style="padding: 7px; font-size: 16px">Ngày áp dụng</b></p>
                                <x-lf.form.checkbox name="selected" wire:mode="selected"
                                                    :params="['true' => 'Tất cả các ngày']" type="checkbox"/>
                                <x-lf.form.checkbox wire:mode="day_apply" name="day_apply" type="checkbox"
                                                    :params="$day_apply1"/>

                            </div>
                        </div>
                    </div>
            </div>
            @endif

        </div>
</div>

<x-lf.form.done/>
<x-slot name="tools">
    <a class="btn-primary sm" href="{{route('time-keep.timekeeprules')}}">{!! lfIcon("list") !!}</a>
</x-slot>
<x-slot name="footer">
    <div class="card-footer flex justify-between">
        <label class="btn-primary flex-none" wire:click="store">Create</label>
        <a class="btn" href="{{route("time-keep.timekeeprules")}}">Cancel</a>
    </div>
</x-slot>
</x-lf.card>

</div>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>



