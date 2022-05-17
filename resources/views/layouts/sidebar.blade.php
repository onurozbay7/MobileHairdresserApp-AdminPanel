<nav class="sidebar-nav d-print-none">
    <ul class="nav in side-menu">

            <li class="sub-menu">
                <a href="{{ route('profil.index') }}">
                    <i class="list-icon feather feather-user"></i> <span class="hide-menu">Profilim</span>
                </a>

            </li>





            <li class="menu-item-has-children">
                <a href="javascript:void(0);">
                    <i class="list-icon feather feather-file-text"></i> <span class="hide-menu">Randevu</span>
                </a>
                <ul class="list-unstyled sub-menu">
                    <li>
                        <a href="{{ route('workinghours.index') }}">Çalışma Saatleri</a>
                    </li>
                    <li>
                        <a href="">Gelir Fişi Ekle</a>
                    </li>
                    <li>
                        <a href="">Gider Fişi Ekle</a>
                    </li>

                </ul>
            </li>



    </ul>
    <!-- /.side-menu -->
</nav>
