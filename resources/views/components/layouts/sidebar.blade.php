<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}" aria-expanded="false">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">لوحة التحكم</span>
            </a>
        </li>
        <li class="nav-item nav-category">المستخدمين</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admins.index')}}">
                <i class="menu-icon mdi mdi-account-key"></i>
                <span class="menu-title">المدراء</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
               aria-controls="form-elements">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">المستخدمين</span>
                <i class="menu-arrow mdi mdi-chevron-left"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">جميع المستخدمين</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('users.state',['state'=>0])}}">المفعلين</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('users.state',['state'=>1])}}">المحظورين</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">ادارة عامة</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#posts" aria-expanded="false"
               aria-controls="charts">
                <i class="menu-icon mdi mdi-rename-box"></i>
                <span class="menu-title">المنشورات</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="posts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts.index')}}">جميع المنشورات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts.state',0)}}">المنشورات المفعلة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts.state',1)}}">المنشورات المحظورة</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">الإعدادات العامة</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
               aria-controls="auth">
                <i class="menu-icon mdi mdi-settings"></i>
                <span class="menu-title">الإعدادات</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('profile')}}"> الملف الشخصي </a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
