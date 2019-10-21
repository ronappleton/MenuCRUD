@foreach($menuItems as $menuItem)
    @if($menuItem->children->isEmpty())
        <li class="nav-item">
            <a class="nav-link" href="{{$menuItem->url()}}">
                @if($menuItem->icon)
                    <i class="{{$menuItem->icon}}"></i>
                @endif
                <span>{{$menuItem->name}}</span>
            </a>
        </li>
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown-{{$menuItem->id}}" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if($menuItem->icon)
                    <i class="{{$menuItem->icon}}"></i>
                @endif
                <span>{{$menuItem->name}}</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown-{{$menuItem->id}}">
                @foreach($menuItem->children as $child)
                    @if($child->children->isEmpty())
                        <li>
                            <a class="dropdown-item" href="{{$child->url()}}">
                                @if($child->icon)
                                    <i class="{{$child->icon}}"></i>
                                @endif
                                <span>{{$child->name}}</span>
                            </a>
                        </li>
                    @else
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-submenu">
                            <a id="dropdownMenu-{{$child->id}}" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if($child->icon)
                                    <i class="{{$child->icon}}"></i>
                                @endif
                                <span>{{$child->name}}</span>
                            </a>
                            <ul aria-labelledby="dropdownMenu-{{$child->id}}" class="dropdown-menu border-0 shadow">
                                @foreach($child->children as $subChild)
                                    <a class="dropdown-item" href="{{$subChild->url()}}">
                                        @if($subChild->icon)
                                            <i class="{{$subChild->icon}}"></i>
                                        @endif
                                        <span>{{$subChild->name}}</span>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown-divider"></li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endif
@endforeach

<!--
if menuitem has no children
show link
else
show toggle link
end if
foreach menu children
include self
end foreach

-->
