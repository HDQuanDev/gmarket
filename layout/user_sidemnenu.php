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
</ul>