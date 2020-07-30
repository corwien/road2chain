<footer class="footer">
      <div class="container">
        <div class="row footer-top">

          <div class="col-sm-5 col-lg-5">

              <p class="padding-top-xsm">我们是高品质的 AI 学习社区，致力于为 AI 学习者提供一个分享创造、结识伙伴、协同互助的平台。</p>

              <div class="text-md " >
                  <a class="popover-with-html" data-content="反馈问题" target="_blank" style="padding-right:8px" href="mailto:407544577@qq.com"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                  <a class="popover-with-html" data-content="查看源代码" target="_blank" style="padding-right:8px" href="https://github.com/corwien"><i class="fa fa-github-alt" aria-hidden="true"></i></a>
                  <a class="popover-with-html" data-content="下载 Chrome 消息通知插件" target="_blank" style="padding-right:8px" href="https://chrome.google.com/webstore/detail/phphub-notifier/fcopfkdgikhodlcjkjdppdfkbhmehdon"><i class="fa fa-chrome" aria-hidden="true"></i></a>
              </div>
              <br>
              <span style="font-size:0.9em">
                  Powered by <a href="https://github.com/summerblue/phphub5" target="_blank" style="color:inherit">Digtime</a>
              </span>&nbsp;
              <span style="font-size:0.9em">
                  Designed by <span style="color: #e27575;font-size: 14px;">❤</span> <a href="https://github.com/corwien" target="_blank" style="color:inherit">Summer</a>
              </span>
            <span style="font-size:1.0em;margin-left: 50px;">
              <a href="http://www.miibeian.gov.cn/" target="_blank">粤ICP备15053415号-1</a>
            </span>


          </div>

          <div class="col-sm-6 col-lg-6 col-lg-offset-1">

              <div class="row">

                  <div class="col-sm-4">
                    <h4>{{ lang('Site Status') }}</h4>
                    <ul class="list-unstyled">
                        <li>{{ lang('Total User') }}: {{ $siteStat->user_count }} </li>
                        <li>{{ lang('Total Topic') }}: {{ $siteStat->topic_count }} </li>
                        <li>{{ lang('Total Reply') }}: {{ $siteStat->reply_count }} </li>
                    </ul>
                  </div>


                </div>

          </div>
        </div>
        <br>
        <br>
      </div>
    </footer>
