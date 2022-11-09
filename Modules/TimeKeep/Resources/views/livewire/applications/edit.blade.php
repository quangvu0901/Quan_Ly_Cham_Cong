<div class="w-full p-1 md:p-4">
    <x-lf.card title="Edit" class="warning">
        <x-lf.form.input name="name" type="string" label="Tên loại nghỉ" placeholder="Tên loại nghỉ ..."/>
        <div class="flex">
            <x-lf.form.input name="salary_rate" type="string" label="Phần trăm lương nhận" placeholder="Phần trăm lương nhận ..."/>
            <x-lf.form.input name="day_off" type="string" label="Số ngày được nghỉ" placeholder="Số ngày được nghỉ ..."/>
        </div>
        <x-lf.form.textarea name="note" label="Ghi chú" />
        <x-lf.form.toggle name="status" label="Trạng thái" />

        <x-lf.form.done :params="['Listing','Create','Show']"/>
        <x-slot name="tools" >
            @can('time-keep.applications.show')
            <a class="btn-success sm" href="{{route('time-keep.applications.show',$record_id)}}">{!! lfIcon("launch",11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{route('time-keep.applications')}}">{!! lfIcon("list",11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Update</label>
                <a class="btn" href="{{route("time-keep.applications")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>

