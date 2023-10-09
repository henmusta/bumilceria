


  <div class="row align-items-center">
    <div class="col-9">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($page_breadcrumbs as $item)
              @if($loop->last)
                @php
                  $active = ' active';
                @endphp
              @endif
              <li style="font-size:18px; font-weight:bold;" class="breadcrumb-item{{ $active ?? "" }}  {{ isset($active) ? "aria-current='page'" : '' }}">
                @if(!$loop->last)
                  <a href={{ $item['url'] ?? "#" }}>{{ $item['title'] ?? '' }}</a>
                @else
                  {{ $item['title' ?? ''] }}
                @endif
              </li>
            @endforeach

          </ol>
      </nav>
    </div>

  </div>


