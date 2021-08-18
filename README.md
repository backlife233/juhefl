href="(.*?)"
href="{{asset('$1')}}"

清理/var/log 下所有日志
find /logs \( -name "*"\) -type f | while read f; do >$f; done


