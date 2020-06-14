@if (count($breadcrumbs))

<ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)

    @if ($breadcrumb->url && !$loop->last)
    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">
                @if (!empty($breadcrumb->icon))
                <img style="color:#5e72e4;margin-right:5px;margin-top:-3px;" width="20" height="20" src="{{asset('template/back-ui/vendor/@fortawesome/fontawesome-free/svgs/'.$breadcrumb->icon)}}" alt=""> 
                @endif
        {{ $breadcrumb->title }}</a></li>
    @else
    <li class="breadcrumb-item active">
            @if (!empty($breadcrumb->icon))
                    <img style="color:#5e72e4;margin-right:5px;margin-top:-3px;" width="20" height="20" src="{{asset('template/back-ui/vendor/@fortawesome/fontawesome-free/svgs/'.$breadcrumb->icon)}}" alt="">
            @endif
        {{ $breadcrumb->title }}
    </li>
    @endif

    @endforeach
</ol>

@endif