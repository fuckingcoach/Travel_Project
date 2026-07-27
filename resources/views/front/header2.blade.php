<div class="d-top">
    @if (!empty(session()->get("memberId")))
    <a href="/member/home"><i class="fa fa-user-circle"></i> 會員中心</a>
    <span>|</span>
    <a href="/member/logout"><i class="fa fa-sign-out-alt"></i> 登出</a>
    @else
    <a href="/member/register"><i class="fa fa-user-circle"></i> 註冊 </a>
    <span>|</span>
    <a href="/member/login"><i class="fa fa-sign-in-alt"></i> 登入</a>
    @endif
</div>
<nav class="d-nav">
    <div class="lb"><a href="/">Logo</a></div>
    <span class="brand"><a href="/">XXX系統</a></span>
    <div class="links">
        <a href="/news"{!! Request::is("news") ? " class='active'" : "" !!}>最新消息</a>
        <a href="/product"{!! Request::is("product") ? " class='active'" : "" !!}>產品介紹</a>
        <a href="/events"{!! Request::is("events") ? " class='active'" : "" !!}>大事記</a>
        <a href="/about"{!! Request::is("about") ? " class='active'" : "" !!}>關於我們</a>
        @if (!empty(session()->get("memberId")))
        <a href="/member/home">會員中心</a>
        @endif
    </div>
    <a href="/cart" class="cart">
        <i class="fa fa-shopping-cart"></i> 購物車
        <span class="cart-badge" id="cart">3</span>
    </a>
</nav>