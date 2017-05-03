<!-- 配置文件 -->
<script type="text/javascript" src="{{ asset('vendor/ueditor/ueditor.config.js') }}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ asset('vendor/ueditor/ueditor.all.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/ueditor/third-party/SyntaxHighlighter/shCore.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css') }}">
<script>
    window.UEDITOR_CONFIG.serverUrl = '{{ config('ueditor.route.name') }}'
</script>