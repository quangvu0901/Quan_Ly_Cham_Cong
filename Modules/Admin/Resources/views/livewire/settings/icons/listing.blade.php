<div class="w-full p-2 md:p-4">
    <x-lf.card title="Icons" class="info">
        <div class="w-full block md:flex md:space-x-2 p-4">
            @if(lfCheckLocalhost())
                <div class="w-full flex-none md:max-w-md bg-gray-100">
                    <x-lf.form.picture name="file" :src="$icon_url"/>
                    <x-lf.form.input type="text" name="name" label="Name" placeholder="Name ..."/>
                    <div class="w-full border-t p-1">
                        <label class="btn-primary" wire:click="store">Add</label>
                    </div>
                </div>
            @endif
            <div class="w-full flex-auto p-4 border-orange-500 border bg-orange-100 text-red-800">
                <b>Lưu ý:</b>
                <div>- Chỉ thực hiện thêm icon ở <b>localhost</b>.</div>
                <div>- Không thêm icon ở <b>server</b>.</div>
                <p>- Truy cập trang <a href="https://fonts.google.com/icons" target="_blank" class="font-bold text-blue-500">Google font icon</a></p>
                <p>- Chọn icon, tải về với <span class="font-bold text-blue-500">size 24</span></p>
                <p>- Upload và nhập tên icon</p>
            </div>
        </div>
        <div class="w-full flex flex-wrap p-2">
            @foreach($data as $icon=>$val)
                <div class="p-1 flex-auto">
                    <div class="w-full h-full border block rounded p-2 text-slate-600 hover:bg-gray-100">
                        <div class="icon  flex items-center justify-center">{!! lfIcon($icon,32) !!}</div>
                        <div class="w-full text-center">{{$icon}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-lf.card>
</div>
