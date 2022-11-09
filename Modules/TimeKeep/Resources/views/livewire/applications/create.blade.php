<div class="w-full p-1 md:p-4">
    <x-lf.card title="Thêm mới" class="info">
        <x-lf.form.input name="name" type="string" label="Tên loại nghỉ" placeholder="Tên loại nghỉ ..."/>
        <div class="flex">
            <x-lf.form.input name="salary_rate" type="string" label="Phần trăm lương nhận" placeholder="Phần trăm lương nhận ..."/>
            <x-lf.form.input name="day_off" type="string" label="Số ngày được nghỉ" placeholder="Số ngày được nghỉ ..."/>
        </div>
		<x-lf.form.textarea name="note" label="Ghi chú" />
		<x-lf.form.toggle name="status" label="Trạng thái" />

        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('time-keep.applications')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Thêm mới</label>
                <a class="btn" href="{{route("time-keep.applications")}}">Quay lại</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



