<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('bower_components/AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                @if (! Auth::guest())
                <a href="#"><i class="fa fa-circle text-success"></i> {{ Auth::user()->name }} </a>
                @endif
                <!-- Status -->
            </div>
        </div>
        @if(isset($menu))
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"></li>
            <li class="{{ $menu['dashboard']?'active':'' }}"><a href="{{ url('/') }}"><i class='fa fa-home'></i> <span>首页</span></a></li>

            <li class="treeview {{$menu['service']?'active':''}}">
                <a onclick="menuRang(this)"><i class='fa fa-server'></i> <span>服务管理</span> <i class="fa {{$menu['service']?'fa-angle-down':'fa-angle-right'}} pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ $menu['service_list']?'active':'' }}"><a href="{{ url('service') }}"><i class='fa fa-list-ul'></i> <span>服务列表</span></a></li>
                    <li class="{{ $menu['installed_list']?'active':'' }}"><a href="{{ url('service/installed') }}"><i class='fa fa-list-ul'></i> <span>安装服务列表</span></a></li>
                    <li class="{{ $menu['metric_list']?'active':'' }}"><a href="{{ url('service/metric') }}"><i class='fa fa-list-ul'></i> <span>服务指标列表</span></a></li>
                </ul>
            </li>

            <li class="treeview {{$menu['doc']?'active':''}}">
                <a onclick="menuRang(this)"><i class='fa fa-book'></i> <span>文档管理</span> <i class="fa {{$menu['service']?'fa-angle-down':'fa-angle-right'}} pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ $menu['type_list']?'active':'' }}"><a href="{{ url('doc/type') }}"><i class='fa fa-list-ul'></i> <span>文档类型</span></a></li>
                    <li class="{{ $menu['text_list']?'active':'' }}"><a href="{{ url('doc/text') }}"><i class='fa fa-list-ul'></i> <span>文档列表</span></a></li>
                </ul>
            </li>


            <li class="{{ $menu['admin']?'active':'' }}"><a href="{{ url('admin/list') }}"><i class='fa fa-user'></i> <span>管理员设置</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
        @endif
    </section>
    <!-- /.sidebar -->
</aside>

<script>
    function menuRang(obj){
        var item = $(obj).children('.pull-right');
        if(item.hasClass('fa-angle-right')){
            $('.treeview .pull-right').removeClass('fa-angle-down').addClass('fa-angle-right');
            item.removeClass('fa-angle-right').addClass('fa-angle-down');
        }else if(item.hasClass('fa-angle-down')){
            item.removeClass('fa-angle-down').addClass('fa-angle-right');
        }
    }
</script>
