<div class="w-full  p-4 max-w-screen-lg">
    <x-lf.card title="Create" class="info">
        <div class="w-full p-4">
            <div class="w-full p-4 border-orange-500 border bg-orange-200 text-red-800">
                <b>Lưu ý:</b>
                <div>- Chỉ thực hiện thêm, sửa, xóa danh mục ở <b>localhost</b>.</div>
                <div>- Không thêm, sửa, xóa danh mục ở <b>server</b>.</div>
            </div>
        </div>
        <x-lf.form.select name="module" label="Module" :params="$modules" />
        <x-lf.form.select name="route" class="w-full md:w-1/2" label="Chọn Route" :params="$routes" />
        <x-lf.form.input name="route" class="w-full md:w-1/2" label="Hoặc nhập" placeholder="Route ..." />
        <x-lf.form.icon name="icon" label="Icon" :val="$icon" />
        <x-lf.form.input name="label" label="Label" placeholder="Label ..." />
        <x-lf.form.select name="permission" class="w-full md:w-1/2" label="Chọn Permission" :params="$permissions" />
        <x-lf.form.input name="permission" class="w-full md:w-1/2" label="Hoặc nhập" placeholder="Permission ..." />
        <x-lf.form.select name="parent_id" label="Cấp cha" :params="$parents" />
        <x-lf.form.select name="sort" label="Vị trí" :params="$sorts" />
        <x-lf.form.done :params="['Listing','Create']" />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('admin.settings.menus')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("admin.settings.menus")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



