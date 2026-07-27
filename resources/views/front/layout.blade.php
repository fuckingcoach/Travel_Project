<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield("title")</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/my.css') }}">
  <link rel="stylesheet" href="/css/front/news.css">
  <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.min.css" rel="stylesheet">
  @stack("style")
</head>

<body>
  @if (Session::has("message"))
  <script>
    Swal.fire({
      title: "{{ Session::get('message') }}",
      text: "",
      icon: "success"
    });
  </script>
  @endif

  @if (Request::is("/"))
  @include("front.header")
  @else
  @include("front.header2")
  @endif

  @yield("content")
  <footer>&copy; 2026 AI輔助全端程式與專案設計班. All rights reserved.</footer>

</body>

</html>