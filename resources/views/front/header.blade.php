<div id="topbar" class="d-top">
  <a href="/member/home"><i class="fa fa-user-circle"></i> 會員中心</a>
  <span class="sep">|</span>
  @if (empty(session()->get("memberId")))
  <a href="/member/login"><i class="fa fa-sign-in-alt"></i> 登入</a>
  @endif
  <span class="sep">|</span>
  <a href="/member/register"><i class="fa fa-user-plus"></i> 加入會員</a>
  <span class="sep">|</span>
  @if (!empty(session()->get("memberId")))
  <a href="#" onclick="return confirm('確定要登出？')"><i class="fa fa-sign-out-alt"></i> 登出</a>
  @endif
</div>

<!-- ===== Navbar ===== -->
<nav class="d-nav">
  <div class="lb"><a href="/">Logo</a></div>
  <span class="brand"><a href="/">島嶼漫遊</a></span>
  <div class="links">
    <a href="/views" {!! Request::is("views") ? " class='active'" : "" !!}>景點探索</a>
    <a href="/travelfood" {!! Request::is("travelfood") ? " class='active'" : "" !!}>地方美食</a>
    <a href="/events" {!! Request::is("events") ? " class='active'" : "" !!}>旅遊靈感</a>
    <a href="/about" {!! Request::is("about") ? " class='active'" : "" !!}>認識台灣</a>
    @if (!empty(session()->get("memberId")))
    <a href="/member/home">會員中心</a>
    @endif
  </div>
  <a href="/cart" class="cart">
    <i class="fa fa-shopping-cart"></i> 收藏清單
    <span class="cart-badge" id="cart">3</span>
  </a>
</nav>