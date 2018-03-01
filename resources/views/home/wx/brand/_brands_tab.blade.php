<div class="mui-scroll-wrapper mui-slider-indicator mui-segmented-control mui-segmented-control-inverted" style="background: #FFFFFF; border-bottom: 1px solid #efeff4;">
    <div class="mui-scroll">
        @inject('active', 'App\Presenters\WiewPresenter')
        <a href="{{ route('home.brands') }}" class="mui-control-item {{ $active->muiActive(0, $id) }} a-can-do">全部</a>
        @foreach($AllBrandCategorys as $brandCategory)
        <a href="{{ route('home.brands', $brandCategory->id) }}" class="mui-control-item {{ $active->muiActive($id, $brandCategory->id) }} a-can-do" href="{{ $brandCategory->id }}">{{ $brandCategory->name }}</a>
        @endforeach
    </div>
</div>
