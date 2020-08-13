<div class="col-md-3 side-bar">

  <div class="panel panel-default corner-radius">
    <div class="panel-body text-center sidebar-sponsor-box">
      @if(isset($banners['sidebar-sponsor']))
        @foreach($banners['sidebar-sponsor'] as $banner)
          <a class="sidebar-sponsor-link" href="{{ $banner->link }}" target="_blank">
            <img src="{{ $banner->image_url }}" class="popover-with-html" data-content="{{ $banner->title }}" width="100%">
          </a>
          <hr>
        @endforeach
      @endif
    </div>
  </div>

  <div class="panel panel-default corner-radius" style="color:#a5a5a5">
    <div class="panel-body text-center">
      <!-- <span>纵向广告为测试</span>-->
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- 纵向广告 -->
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-1931887165710574"
           data-ad-slot="5611470128"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
  </div>
</div>
<div class="clearfix"></div>

