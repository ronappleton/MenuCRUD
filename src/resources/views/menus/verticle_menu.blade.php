@foreach($menuItems as $menuItem)
    @if($menuItem->children->isEmpty())
        <li>
            <a href="{{$menuItem->url()}}">
                @if($menuItem->icon)
                    <i class="fa {{$menuItem->icon}}"></i>
                @endif
                <span>{{$menuItem->name}}</span>
            </a>
        </li>
    @else
        <li class="treeview">
            <a href="#">
                @if($menuItem->icon)
                    <i class="fa {{$menuItem->icon}}"></i>
                @endif
                <span>{{$menuItem->name}}</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @foreach($menuItem->children as $child)
                    <li>
                        <a href="{{$child->url()}}">
                            @if($child->icon)
                                <i class="fa {{$child->icon}}"></i>
                            @endif
                            <span>{{$child->name}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endif
@endforeach
