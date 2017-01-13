@if (session('showStatus'))
    <div class="status-container">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('statusSuccess') ? session('statusSuccess') : '操作成功' }} <span class="alert-time">5</span>
            </div>
        @else
            <div class="alert alert-danger">
                {{ session('statusError') ? session('statusError') : '操作失败' }} <span class="alert-time">5</span>
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var alertTime = 4;
            var intervalid;
            intervalid = setInterval(function countAlertTime() {
                if (alertTime == 0) {
                    $('.status-container').hide();
                    clearInterval(intervalid);
                }
                $(".alert-time").html(alertTime);
                alertTime--;
            }, 1000);
        })
    </script>
@endif
