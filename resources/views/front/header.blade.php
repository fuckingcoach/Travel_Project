<div id="topbar">
  <a href="/member/home"><i class="fa fa-user-circle"></i> 會員中心</a>
  <span class="sep">|</span>
  @if (empty(session()->get("memberId")))
  <a href="/member/login"><i class="fa fa-sign-in-alt"></i> 登入</a>
  @endif
  <span class="sep">|</span>
  <a href="/member/register"><i class="fa fa-user-plus"></i> 加入會員</a>
  <span class="sep">|</span>
  @if (!empty(session()->get("memberId")))
  <a href="/member/logout" onclick="return confirm('確定要登出？')"><i class="fa fa-sign-out-alt"></i> 登出</a>
  @endif
</div>

<!-- ===== Navbar ===== -->
<nav id="navbar">
  <a href="/" class="nav-logo">
    <div class="logo-box">B</div>
    <span class="logo-text">品牌名稱</span>
  </a>
  <button class="nav-toggle" onclick="document.querySelector('.nav-links').classList.toggle('open')">
    <i class="fa fa-bars"></i>
  </button>
  <ul class="nav-links">
    <li>
      <a href="/news"><i class="fa fa-newspaper" style="font-size:13px"></i> 最新消息</a>
      <!--
        <ul class="dropdown">
          <li><a href="news-list.html?cat=1">公司公告</a></li>
          <li><a href="news-list.html?cat=2">活動資訊</a></li>
          <li><a href="news-list.html?cat=3">產品動態</a></li>
        </ul>
        -->
    </li>
    <li>
      <a href="/product"><i class="fa fa-box-open" style="font-size:13px"></i> 產品介紹</a>
      <!--
        <ul class="dropdown">
          <li><a href="products-list.html?cat=1">系列一</a></li>
          <li><a href="products-list.html?cat=2">系列二</a></li>
          <li><a href="products-list.html?cat=3">系列三</a></li>
        </ul>-->
    </li>
    <li><a href="/events"><i class="fa fa-history" style="font-size:13px"></i> 大事記</a></li>
    <li><a href="/about"><i class="fa fa-building" style="font-size:13px"></i> 關於我們</a></li>
    <li><a href="/member/home"><i class="fa fa-user" style="font-size:13px"></i> 會員中心</a></li>
  </ul>
  <a href="/cart" class="nav-cart">
    <i class="fa fa-shopping-cart"></i>
    <span>購物車</span>
    <span class="cart-badge" id="cart-badge">3</span>
  </a>
</nav>