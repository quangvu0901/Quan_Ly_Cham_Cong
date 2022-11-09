<div class=" p-1 md:p-4" style="width: 100%">
    <x-lf.card title="Thêm mới" class="info" >
        <div style="width: 50%">
            <span>
                <b>Mã nhân viên</b>
                <x-lf.form.input name="user_id" type="integer" disabled style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
            <span>
                <b>Người nộp đơn</b>
                <x-lf.form.input name="creator" type="string" readonly style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
            <span>
                <b>Tên công ty</b>
                <x-lf.form.input name="company_id" type="integer" disabled style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
            <span>
                <b>Phòng ban</b>
                <x-lf.form.input name="department_id" type="integer" disabled style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
            <span>
                <b>Tên loại nghỉ</b>
                <x-lf.form.select name="apply_id" type="integer" :default="['----Chọn loại nghỉ----']" :params="$nameApply"/>
            </span>
            <span>
                <b>Phần trăm lương</b>
                <x-lf.form.input name="salary_rate" type="string" disabled style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
        </div>
        <div style="width: 50%">
            <span>
                <b>số ngày được nghỉ</b>
                <x-lf.form.input name="total_dayoff" type="string" disabled style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
            <span>
                <b>Từ ngày</b>
                <x-lf.form.input name="from" type="date" />
            </span>
            <span>
                <b>Đến ngày</b>
                <x-lf.form.input name="to" type="date" />
            </span>
            <span>
                <b>Số ngày xin nghỉ</b>
                <x-lf.form.input name="days" type="string" disabled style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
            <span>
                <b>Lý do xin nghỉ</b>
                <x-lf.form.textarea name="reason"/>
            </span>
            <span>
                <b>Trạng thái</b>
                <x-lf.form.select name="status" type="integer" :params="$statusApply" disabled style="background-color: #DDDDDD; border-radius: 5px"/>
            </span>
        </div>
        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('time-keep.formapplies')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Thêm mới</label>
                <a class="btn" href="{{route("time-keep.formapplies")}}">Quay lại</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>


<style>
    span{
        display: flex;
        padding: 10px 10px 5px 10px;
    }
    b{
        width: 200px;
        line-height: 46px;
        font-size: 14px;
    }
</style>
