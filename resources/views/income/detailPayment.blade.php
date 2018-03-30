@extends('common')

@include('nav.income')

@section('content')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="/" class="maincolor">首页</a>
            <span class="c-999 en">&gt;</span>
            <a href="/income/paytotal" class="maincolor">收入类</a>
            <span class="c-999 en">&gt;</span>
            <span class="c-666">付费细节</span>
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
               href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
        </nav>

        <div class="Hui-article">
            <form action="/income/paydetail" method="post" class="form form-horizontal">
                {!! csrf_field() !!}
                <div class="row cl">
                    <label class="form-label col-xs-1 col-sm-1">选择日期：</label>
                    <div class="formControls  skin-minimal">
                        <div class="radio-box">
                            <input type="radio" name="option-date" value="1" id="sex-1" {{ $option == 1?'checked':'' }}>
                            <label for="sex-1">本日</label>
                        </div>
                        <div class="radio-box">
                            <input type="radio" name="option-date" value="2" id="sex-2" {{ $option == 2?'checked':'' }}>
                            <label for="sex-2">本周</label>
                        </div>
                        <div class="radio-box">
                            <input type="radio" name="option-date" value="3" id="sex-3" {{ $option == 3?'checked':'' }}>
                            <label for="sex-3">本月</label>
                        </div>
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-1 col-sm-1">起止日期：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                        <input type="text" name="interval-date-start"
                               onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})"
                               id="datemin" class="input-text Wdate"
                               placeholder="{{ date('Y-m-d',$start/1000) }}">
                    </div>
                    <div class="formControls col-xs-1 col-sm-1" style="width: 5px">-</div>
                    <div class="formControls col-xs-1 col-sm-1">
                        <input type="text" name="interval-date-end"
                               onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})"
                               id="datemax" class="input-text Wdate"
                               placeholder="{{ date('Y-m-d',$end/1000) }}">
                    </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-xs-1 col-sm-1">渠道ID：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                        <span class="select-box">
                            <select class="select" size="1" name="pid">
                                <option value="0" {{ $select_pid == 0?'selected':'' }}>全部</option>
                                @foreach($pid as $v)
                                    <option value="{{ $v }}" {{ $select_pid == $v?'selected':'' }}>{{ $v }}</option>
                                @endforeach
                            </select>
				        </span>
                    </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-xs-1 col-sm-1">服务器ID：</label>
                    <div class="formControls col-xs-1 col-sm-1">
                        <span class="select-box">
                            <select class="select" size="1" name="serverId">
                                <option value="0" {{ $serverId == 0?'selected':'' }}>全部</option>
                                @foreach($server as $k=>$v)
                                    <option value="{{ $k }}" {{ $serverId == $k?'selected':'' }}>{{ $v }}</option>
                                @endforeach
                            </select>
				        </span>
                    </div>
                </div>

                <div class="row cl">
                    <div class="col-xs-1 col-sm-1 col-xs-offset-1 col-sm-offset-1">
                        <button class="btn btn-success radius" type="submit"><i class="Hui-iconfont">&#xe665;</i>查询
                        </button>
                    </div>

                    <div class="col-xs-1 col-sm-1">
                        <a href="/income/paydetail?status=2" target="_blank" class="btn btn-secondary radius">导出</a>
                    </div>
                </div>
            </form>

            <div class="mt-20 col-xs-12 col-sm-12">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th>充值时间点</th>
                        <th>账号</th>
                        <th>渠道ID</th>
                        <th>服务器</th>
                        <th>角色ID</th>
                        <th>角色名</th>
                        <th>充值金额</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $v)
                        <tr class="text-c">
                            <td>{{ date('Y-m-d H:i:s',$v['payTime']/1000) }}</td>
                            <td>{{ $v['userId'] }}</td>
                            <td>{{ $v['pid'] }}</td>
                            <td>{{ $v['serverId'] }}</td>
                            <td>{{ $v['roleId'] }}</td>
                            <td>{{ $v['roleName'] }}</td>
                            <td>{{ $v['rechargeRMB'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $('.table-sort').dataTable({
            "bStateSave": true,//状态保存
        });
    </script>
@endsection