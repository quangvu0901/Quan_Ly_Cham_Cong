@if (session()->has('error'))
    <div class="alert alert-danger text-center">
        {{ session()->get('error') }}
    </div>
@endif

<x-lf.page.listing :fields="$fields">
    <div wire:poll.5000ms class="col-5 visible-print text-center" style="padding: 5%">
        {!! QrCode::size(300)->generate("http://192.168.1.3:8080/time-keep/timekeeps/chamcong/$key") !!}
    </div>
    @if(!empty($message))
        <label style="width: 100%;height: 50px; text-align: center; font-size: 16px; background-color: rgba(255,48,48,0.5);line-height: 50px">
            {{ $message }} Vui lòng
            <a href="{{ route("time-keep.timekeeprules") }}" style="color: #2563eb;text-decoration: underline"> Kích hoạt </a> hoặc
            <a href="{{ route("time-keep.timekeeprules.create") }}" style="color: #2563eb;text-decoration: underline">Tạo luật chấm công </a>
        </label>
    @endif
    <div id="message">
        @if(session()->has('error'))
            {{ session()->get('error') }}
        @endif
    </div>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th>
                <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
            </th>
            <x-lf.table.label name="user_id" :fields="$fields">Nhân viên</x-lf.table.label>
            <x-lf.table.label name="note" :fields="$fields">Ghi chú</x-lf.table.label>
            <x-lf.table.label name="created_at" :fields="$fields">Ngày tháng</x-lf.table.label>
            <x-lf.table.label name="created_at" :fields="$fields">Giờ vào</x-lf.table.label>
            <x-lf.table.label name="updated_at" :fields="$fields">Giờ ra</x-lf.table.label>
{{--            <x-lf.table.label name="count" :fields="$fields">Công</x-lf.table.label>--}}
            <x-lf.table.label name="punish" :fields="$fields">Phạt</x-lf.table.label>

            <th></th>
        </tr>
        </thead>
        @foreach ($data as $item)
            <tr>

                <th class="stt">{{ $item->id }}</th>
                <x-lf.table.item name="user_id" :fields="$fields">

                       {{ $item->user->name }}

                </x-lf.table.item>
                <x-lf.table.item name="note" :fields="$fields">{{ $item->note }}</x-lf.table.item>
                <x-lf.table.item name="created_at" :fields="$fields">{{ $item->created_at->format('d-m-y') }}
                </x-lf.table.item>
                <x-lf.table.item name="created_at" :fields="$fields">
                    {{ $item->created_at != null ? $item->created_at->format('H:i:s') : '' }}</x-lf.table.item>
                <x-lf.table.item name="updated_at" :fields="$fields">
                    {{ $item->updated_at != null ? $item->updated_at->format('H:i:s') : '' }}</x-lf.table.item>
                <x-lf.table.item name="updated_at" :fields="$fields">
                   </x-lf.table.item>
                <x-lf.table.item name="updated_at" :fields="$fields">

                </x-lf.table.item>
            </tr>
        @endforeach
    </table>
    <div style="padding: 20px; width: 100%"></div>
    <table class="table" style="text-align: center">
        <thead>
        <tr >
            <th style="text-align: center; ">Tên NV</th>
            @foreach($days as $day)
                @if($day['day_text']=='CN')
                    <th style=" background-color: rgba(255, 28, 28, 0.7);padding: 10px;text-align: center;color: #ffffff; width: 55px">{{$day['day_text']}}<br>{{$day['day']}}</th>
                @elseif($day['day_text']=='T7')
                    <th style=" background-color: rgba(255, 238, 0, 0.45);padding: 10px;text-align: center;width: 55px">{{$day['day_text']}}<br>{{$day['day']}}</th>
                @else
                    <th style="padding: 10px;text-align: center">{{$day['day_text']}}<br>{{$day['day']}}</th>
                @endif
            @endforeach
            <th style="text-align: center;">Tổng công</th>

        </tr>
        </thead>
        <tbody>
        @if (!empty($array_staffs))

            @foreach ($array_staffs as $id => $staff)
                {{--                    @dd($staff )--}}
                <tr>
                    @can('time-keep.timekeeps.show')
                        <td><a href="{{route("time-keep.timekeeps.show",$staff['user_id'])}}">{{ $staff['name'] }}</a>
                        </td>
                    @endcan

                    @if (!empty($staff['timekeep']))
                        @foreach ($staff['timekeep'] as $kt => $cong)
{{--                                @dd($staff)--}}
                            @if($cong['days']=='CN' )
                                <td style="background-color:rgba(255, 28, 28, 0.7);color: #ffffff">{{ $cong['timekeep'] }}</td>
                            @elseif($cong['days']=='T7')
                                <td style="background-color: rgba(255, 238, 0, 0.45)">{{ $cong['timekeep'] }}</td>
                            @else
                                <td>{{ $cong['timekeep'] }}</td>
                            @endif
                        @endforeach
                    @endif
                    <td>{{ $staff['count'] }}</td>
                </tr>
            @endforeach
        @endif


        </tbody>
    </table>

    <a class="btn-primary flex-none" href="{{ route('time-keep.timekeeps.store', $key) }}">Chấm công</a>
</x-lf.page.listing>
