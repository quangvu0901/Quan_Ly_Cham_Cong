<div class="w-full p-2 md:p-4">
    <x-lf.card title="Listing">
        @foreach($data as $k=> $module)
            <div class="tree">
                <div class="tree-header">
                    <div class="flex-1">
                        <span class="label">{{$module["info"]["name_headline"]}}</span>
                        <span class="text-red-700">{{optional($module["info"]['permission'])->name}}</span>
                    </div>
                    <div class="tools">
                    @can("admin.permissions.create")
                        <a href="{{route("admin.permissions.create",['module'=>$k])}}" class="btn-primary xs">{!! lfIcon("add",11) !!}</a>
                    @endcan
                    </div>
                </div>
                <div class="tree-content">
                    @foreach($module["permissions"] as $item)
                        <div class="item">
                            <div class="item-content">
                                <div class="flex-1">
                                    <span>{{$item->label}}</span>
                                    <span class="text-red-700">({{$item->name}})</span>
                                    <span>{{$item->type}}</span>
                                </div>
                                <div class="tools">
                                    @can("admin.permissions.show")
                                        <a href="{{route("admin.permissions.show",$item->id)}}" class="btn-info xs">{!! lfIcon("launch",11) !!}</a>
                                    @endcan
                                    @can("admin.permissions.edit")
                                        <a href="{{route("admin.permissions.edit",$item->id)}}" class="btn-warning xs">{!! lfIcon("edit",11) !!}</a>
                                    @endcan
                                    @can("admin.permissions.delete")
                                        <x-lf.btn.delete :record="$item->id" :confirm="$confirm" />
                                    @endcan
                                </div>
                            </div>
                            @if($item->children)
                                <div class="tree-content">
                                    @foreach($item->children as $child)
                                        <div class="item">
                                            <div class="item-content">
                                                <div class="flex-1">
                                                    <span>{{$child->label}}</span>
                                                    <span class="text-red-700">({{$child->name}})</span>
                                                    <span>{{$child->type}}</span>
                                                </div>
                                                <div class="tools">
                                                    @can("admin.permissions.show")
                                                        <a href="{{route("admin.permissions.show",$child->id)}}" class="btn-info xs">{!! lfIcon("launch",11) !!}</a>
                                                    @endcan
                                                    @can("admin.permissions.edit")
                                                        <a href="{{route("admin.permissions.edit",$child->id)}}" class="btn-warning xs">{!! lfIcon("edit",11) !!}</a>
                                                    @endcan
                                                    @can("admin.permissions.delete")
                                                        <x-lf.btn.delete :record="$child->id" :confirm="$confirm" />
                                                    @endcan
                                                </div>
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
</div>
