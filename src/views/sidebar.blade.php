<?php
    function checkActive($items){
        return collect($items)->contains(function($item){
            $path = request()->decodedPath();
            return $item['url'] == "/" .$path;
        });
    }

    $userSidebar = config('sidebar');
?>

<ul class="nav nav-pills nav-stacked side-navigation">
    @foreach($userSidebar as $sidebar)
        <li class="@if(isset($sidebar['children'])) menu-list @endif @if(isset($sidebar['children']) && checkActive($sidebar['children'])) nav-active @endif" >
            <a href="#">
                <i class="fa fa-{{ $sidebar['icon'] }}">
                </i> <span>{{ $sidebar['title'] }}</span>
            </a>
            @if(isset($sidebar['children']))
                <ul class="child-list">
                    @foreach($sidebar['children'] as $item)
                        <li @if("/" . request()->path() == $item['url']) class="active" @endif><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
