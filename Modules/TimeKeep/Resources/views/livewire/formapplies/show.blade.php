<div class="w-full p-2 md:p-4 max-w-lg">
    <x-lf.card class="success" title="Show">
        <div style="width: 50%">
            <span>
                <b>Mã nhân viên</b>
                <p>{{$data->user_id}}</p>
            </span>
            <span>
                <b>Người nộp đơn</b>
                <p>{{$data->creator}}</p>
            </span>
            <span>
                <b>Tên công ty</b>
                <p>{{$data->companies->name}}</p>
            </span>
            <span>
                <b>Phòng ban</b>
                <p>{{$data->departments->name}}</p>
            </span>
            <span>
                <b>Tên loại nghỉ</b>
                <p>{{$data->formApply->name}}</p>
            </span>
            <span>
                <b>Phần trăm lương</b>
                <p>{{$data->formApply->salary_rate}}</p>
            </span>
        </div>
        <div style="width: 50%">
            <span>
                <b>số ngày được nghỉ</b>
                <p>{{$data->formApply->day_off }}</p>
            </span>
            <span>
                <b>Từ ngày</b>
                <p>{{$data->from}}</p>
            </span>
            <span>
                <b>Đến ngày</b>
                <p>{{$data->to}}</p>
            </span>
{{--            <span>--}}
{{--                <b>Số ngày xin nghỉ</b>--}}
{{--                <p>{{$data->days}}</p>--}}
{{--            </span>--}}
            <span>
                <b>Lý do xin nghỉ</b>
                <p>{{$data->reason}}</p>
            </span>
            <span>
                <b>Trạng thái</b>
                <p>
                    @if($data->status == 0)
                        <a >Chờ duyệt</a>
                    @elseif($data->status == 1)
                        <a >Đã duyệt</a>
                    @elseif($data->status == 2)
                        <a >Không duyệt</a>
                    @endif
                </p>
            </span>
        </div>
        <x-slot name="tools">
            @can("time-keep.formapplies.listing")
                <a class="btn-primary xs" href="{{route("time-keep.formapplies")}}">{!! lfIcon("list",11) !!}</a>
            @endcan
            @can("time-keep.formapplies.edit")
                <a class="btn-warning xs" href="{{route("time-keep.formapplies.edit",$data->id)}}">{!! lfIcon("edit",11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can("time-keep.formapplies.listing")
                    <a class="btn-primary" href="{{route("time-keep.formapplies")}}">{!! lfIcon("list") !!} <span>Listing</span></a>
                @endcan
                <div>
                    @can("time-keep.formapplies.edit")
                        <a class="btn-warning" href="{{route("time-keep.formapplies.edit",$data->id)}}">{!! lfIcon("edit") !!} <span>Edit</span></a>
                    @endcan
                </div>
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
    p{
        line-height: 46px;
        font-size: 14px;
        width: 100%;
        padding: 0 10px;
        border: 1px solid #DDDDDD;
        border-radius: 5px;
    }
</style>
