<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
        <tr>
            <th><x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort></th>
            <x-lf.table.label name="user_id" :fields="$fields">Mã NV</x-lf.table.label>
			<x-lf.table.label name="company_id" :fields="$fields">Công ty</x-lf.table.label>
			<x-lf.table.label name="department_id" :fields="$fields">Phòng ban</x-lf.table.label>
			<x-lf.table.label name="apply_id" :fields="$fields">Tên loại nghỉ</x-lf.table.label>
			<x-lf.table.label name="creator" :fields="$fields">Người nộp đơn</x-lf.table.label>
			<x-lf.table.label name="sensor" :fields="$fields">Người phê duyệt</x-lf.table.label>
            <x-lf.table.label name="created_at" :fields="$fields">Ngày nộp đơn</x-lf.table.label>
			<x-lf.table.label name="from" :fields="$fields">Từ ngày</x-lf.table.label>
			<x-lf.table.label name="to" :fields="$fields">Đến ngày</x-lf.table.label>
			<x-lf.table.label name="reason" :fields="$fields">Lý do nghỉ</x-lf.table.label>
			<x-lf.table.label name="status" :fields="$fields">Trạng thái</x-lf.table.label>

{{--			<x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label>--}}

            <th></th>
        </tr>
        </thead>
        @foreach($data as $item)
            <tr>
                <th class="stt">{{$item->id}} </th>
                <x-lf.table.item name="user_id" :fields="$fields">{{$item->user_id}}</x-lf.table.item>
				<x-lf.table.item name="company_id" :fields="$fields">
                    {{ $item->companies->name }}
                </x-lf.table.item>
				<x-lf.table.item name="department_id" :fields="$fields">
                    {{ $item->departments->name }}
                </x-lf.table.item>
				<x-lf.table.item name="apply_id" :fields="$fields">
                    {{$item->formApply->name}}
                </x-lf.table.item>
				<x-lf.table.item name="creator" :fields="$fields">{{$item->creator}}</x-lf.table.item>
{{--				<x-lf.table.item name="sensor" :fields="$fields">{{$item->sensor}}</x-lf.table.item>--}}
                <x-lf.table.item name="created_at" :fields="$fields">{{$item->created_at->toDateString()}}</x-lf.table.item>
				<x-lf.table.item name="from" :fields="$fields">{{$item->from}}</x-lf.table.item>
				<x-lf.table.item name="to" :fields="$fields">{{$item->to}}</x-lf.table.item>
				<x-lf.table.item name="reason" :fields="$fields">{{$item->reason}}</x-lf.table.item>
				<x-lf.table.item name="status" :fields="$fields">
                    @if($item->status == 0)
                        <a style="background-color: yellow">Chờ duyệt</a>
                    @elseif($item->status == 1)
                        <a style="background-color: greenyellow">Đã duyệt</a>
                    @elseif($item->status == 2)
                        <a style="background-color: red">Không duyệt</a>
                    @endif
                </x-lf.table.item>

{{--				<x-lf.table.item name="updated_at" :fields="$fields">{{$item->updated_at}}</x-lf.table.item>--}}

                <td class="action">
                    @can('time-keep.formapplies.show')
                    <a class="btn-success xs" href="{{route("time-keep.formapplies.show",$item->id)}}">{!! lfIcon("launch",10) !!}</a>
                    @endcan
                    @can('time-keep.formapplies.edit')
                    <a class="btn-info xs" href="{{route("time-keep.formapplies.edit",$item->id)}}">{!! lfIcon("edit",10) !!}</a>
                    @endcan
                    @can('time-keep.formapplies.delete')
                    <x-lf.btn.delete :record="$item->id" :confirm="$confirm"/>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <x-slot name="filters">
        <x-lf.filter.input name="fId" type="number" placeholder="Id ..." />
    </x-slot>
    <x-slot name="tools">
        @can("time-keep.formapplies.create")
           <div> <a class="btn-primary sm" href="{{route("time-keep.formapplies.create")}}">{!! lfIcon("add") !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
