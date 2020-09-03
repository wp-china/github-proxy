# github-proxy
用作代理GitHub仓库中的文件，之所以不直接使用Nginx达成此目的是因为通过GitHub的RAW模式读取的文件的Content-Type都是“text/plain; charset=utf-8”
