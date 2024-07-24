<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="javascript:void(0)" class="sidebar-logo">
            <img src="https://www.unimed.ac.id/wp-content/uploads/2022/07/Unimed-2.svg" alt="site logo" class="light-logo">
            <img src="https://www.unimed.ac.id/wp-content/uploads/2022/07/Unimed-2.svg" alt="site logo" class="dark-logo">
            <img src="https://www.unimed.ac.id/wp-content/uploads/2022/07/Unimed-2.svg" alt="site logo" class="logo-icon">
        </a>
    </div>
    @php
        // Get the first segment of the URL
        $url = request()->segment(2);
    @endphp
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="sidebar-menu-group-title">Menu</li>
            <li class="{{ ($url == "data-surat") ? "active-page" : "" }}">
                <a href="{{ route('arsip.index') }}" class="{{ ($url == "data-surat") ? "active-page" : "" }}">
                    <iconify-icon icon="ion:mail" class="menu-icon"></iconify-icon>
                    <span>Data Surat</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
