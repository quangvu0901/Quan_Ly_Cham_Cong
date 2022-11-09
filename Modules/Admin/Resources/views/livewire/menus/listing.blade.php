<div class="w-full p-2 md:p-4">
    <x-lf.card title="Listing">
        <div class="w-full p-4">
            <div class="w-full p-4 border-orange-500 border bg-orange-200 text-red-800">
                <b>Lưu ý:</b>
                <div>- Chỉ thực hiện thêm, sửa, xóa danh mục ở <b>localhost</b>.</div>
                <div>- Không thêm, sửa, xóa danh mục ở <b>server</b>.</div>
            </div>
        </div>
        @foreach($data as $module => $menus)
            <div class="tree">
                <div class="tree-header">
                    <div class="flex-1">
                        <span class="label">{{lfHeadLine($module)}}</span>
                    </div>
                    <span class="tools">
                    @if(lfCheckLocalhost())
                            <a class="btn-primary xs" href="{{route("admin.menus.create",["module"=>$module])}}">{!! lfIcon("add",11) !!}</a>
                        @endif
                    </span>
                </div>
                <div class="tree-content">
                    @foreach($menus as $k => $item)
                        <div class="item">
                            <div class="item-content p-0">
                                <span class="pr-2 flex-none flex items-start" title="Icon">{!! lfIcon($item["icon"]) !!}</span>
                                <span class="flex-auto flex flex-wrap pl-1  border-l">
                                    <b class=" pl-1 flex-none" title="Label">{{$item["label"]}}</b>
                                    <span class="pl-1 flex-none" title="Route Name">({{$item["route"]}})</span>
                                    <span class=" pl-1 flex-auto text-red-700" title="Permission">{{$item['permission']}}</span>
                                </span>
                                <span class="tools">
                                @if(lfCheckLocalhost())
                                        <a class="btn-warning xs" href="{{route("admin.menus.edit",["module"=>$module,"item"=>$k])}}">{!! lfIcon("edit",11) !!}</a>
                                        <span class="btn-danger xs" wire:click="delete('{{$module}}','{{$k}}')">{!! lfIcon("delete",11) !!}</span>
                                    @endif
                            </span>
                            </div>
                            @if($item["children"])
                                <div class="tree-content">
                                    @foreach($item["children"] as $kChild => $child)
                                        <div class="item">
                                            <div class="item-content">
                                                <span class="pr-2 flex-none flex items-start" title="Icon">{!! lfIcon($child["icon"]) !!}</span>
                                                <span class="flex-auto flex flex-wrap pl-1 border-l">
                                                <b class=" pl-1 flex-none" title="Label">{{$child["label"]}}</b>
                                                <span class="pl-1 flex-none" title="Route Name">({{$child["route"]}})</span>
                                                <span class=" pl-1 flex-auto text-red-700" title="Permission">{{$child['permission']}}</span>
                                            </span>
                                                <span class="tools">
                                                @if(lfCheckLocalhost())
                                                        <a class="btn-warning xs" href="{{route("admin.menus.edit",["module"=>$module,"item"=>$k.'.children.'.$kChild])}}">{!! lfIcon("edit",11) !!}</a>
                                                        <span class="btn-danger xs" wire:click="delete('{{$module}}','{{$k}}.children.{{$kChild}}')">{!! lfIcon("delete",11) !!}</span>
                                                    @endif
                                            </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach
    </x-lf.card>
    @if (session()->has('message') && session('message')=="done")
        <div x-data="{time:10,
                    init() {
                    setInterval(() => {
                            this.time--
                            if(this.time <=0){
                                window.location.reload();
                            }
                          }, 1000)
                        }
                    }"
             class="fixed left-0 top-0 right-0 bottom-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="w-full max-w-sm bg-white rounded p-4 text-2xl text-center">
                Đợi <span x-text="time"></span>s để đồng bộ dữ liệu
            </div>
        </div>
    @endif
</div>
