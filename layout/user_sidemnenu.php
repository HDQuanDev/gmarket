<ul class="aiz-side-nav-list px-2" data-toggle="aiz-side-menu">

    <li class="aiz-side-nav-item">
        <a href="/dashboard" class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/dashboard"?"active":""?>   ">
            <i class="las la-home aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Dashboard</span>
        </a>
    </li>

    <li class="aiz-side-nav-item">
        <a href="/purchase_history" class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/purchase_history"?"active":""?> "><i class="las la-file-alt aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Purchase History</span>
            <span class="badge badge-inline badge-success">new</span>
        </a>
    </li>

    <li class="aiz-side-nav-item">
        <a href="/digital-purchase-history" class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/digital-purchase-history"?"active":""?> ">
            <i class="las la-download aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Downloads</span>
        </a>
    </li>


    <li class="aiz-side-nav-item">
        <a href="/wishlists"
            class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/wishlists"?"active":""?>  ">
            <i class="la la-heart-o aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Wishlist</span>
        </a>
    </li>

    <li class="aiz-side-nav-item">
        <a href="/compare" class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/compare"?"active":""?> ">
            <i class="la la-refresh aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Compare</span>
        </a>
    </li>

    <li class="aiz-side-nav-item">
        <a href="/customer_products" class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/customer_products"?"active":""?>   ">
            <i class="lab la-sketch aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Classified Products</span>
        </a>
    </li>


    <li class="aiz-side-nav-item">
        <a href="/conversations" class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/conversations"?"active":""?> ">
            <i class="las la-comment aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Conversations</span>
        </a>
    </li>


    <li class="aiz-side-nav-item">
        <a href="/wallet"
            class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/wallet"?"active":""?>    ">
            <i class="las la-dollar-sign aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">My Wallet</span>
        </a>
    </li>





    <li class="aiz-side-nav-item">
        <a href="/support_ticket" class="aiz-side-nav-link  <?=$_SERVER['REQUEST_URI']=="/support_ticket"?"active":""?>  ">
            <i class="las la-atom aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Support Ticket</span>
        </a>
    </li>
    <li class="aiz-side-nav-item">
        <a href="/profile" class="aiz-side-nav-link <?=$_SERVER['REQUEST_URI']=="/profile"?"active":""?> ">
            <i class="las la-user aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Manage Profile</span>
        </a>
    </li>

    <li class="aiz-side-nav-item">
        <a href="#" onclick="account_delete_confirm_modal('/account-deletion')" class="aiz-side-nav-link">
            <i class="las la-user aiz-side-nav-icon"></i>
            <span class="aiz-side-nav-text">Delete My Account</span>
        </a>
    </li>

</ul>