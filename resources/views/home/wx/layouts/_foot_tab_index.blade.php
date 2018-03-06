@inject('presenter', 'App\Presenters\WiewPresenter')
<nav class="mui-bar mui-bar-tab">
    <a href="http://{{ \Request::server('HTTP_HOST') }}" class="mui-tab-item {{ $presenter->muiFootTabActive('http://'.\Request::server('HTTP_HOST'))}} a-can-do">
        <span class="mui-icon mui-icon-home"></span>
        <span class="mui-tab-label">首页</span>
    </a>
    <a href="{{ route('home.brands') }}" class="mui-tab-item {{ $presenter->muiFootTabActive(route('home.brands')) }} a-can-do">
        <span class="mui-icon icon iconfont icon-brand" style="color: #fff; font-size: 22px;"></span><br />
        <span class="mui-tab-label">品牌券</span>
    </a>
    <a href="{{ route('home.zhibo.index') }}" class="mui-tab-item {{ $presenter->muiFootTabActive(route('home.zhibo.index')) }} a-can-do">
        <span class="mui-icon icon iconfont icon-live_icon" style="color: #fff; font-size: 22px;"></span>
        <span class="mui-tab-label">优惠直播</span>
    </a>
    <a href="{{ route('home.superSearch.index') }}" class="mui-tab-item {{ $presenter->muiFootTabActive(route('home.superSearch.index')) }} a-can-do">
        <span class="mui-icon mui-icon-search"></span>
        <span class="mui-tab-label">超级搜索</span>
    </a>
    <a href="#" class="mui-tab-item a-can-do">
        <span class="mui-icon icon iconfont icon-followus" style="color: #fff; font-size: 22px;"></span>
        <span class="mui-tab-label">关注我们</span>
    </a>
</nav>
