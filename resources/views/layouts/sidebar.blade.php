<nav class="sidebar-nav d-print-none">
    <ul class="nav in side-menu">

            <li class="sub-menu">
                <a href="{{ route('profil.index') }}">
                    <i class="list-icon feather feather-user"></i> <span class="hide-menu">Profilim</span>
                </a>

            </li>





            <li class="menu-item-has-children">
                <a href="javascript:void(0);">
                    <i class="list-icon feather feather-clock"></i> <span class="hide-menu">Çalışma Saatleri</span>
                </a>
                <ul class="list-unstyled sub-menu">
                    <li>
                        <a href="{{ route('workinghours.index') }}">Çalışma Saatleri</a>
                    </li>
                    <li>
                        <a href="{{ route('workinghours.create') }}">Çalışma Saati Ekle</a>
                    </li>

                </ul>
            </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-check-circle"></i> <span class="hide-menu">Servisler</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('servicelist.index') }}">Servislerim</a>
                </li>
                <li>
                    <a href="{{ route('servicelist.create') }}">Servis Ekle</a>
                </li>

            </ul>
        </li>

        <li class="menu-item-has-children">
            <a href="javascript:void(0);">
                <i class="list-icon feather feather-calendar"></i> <span class="hide-menu">Randevu</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('appointment.index') }}">Randevularım</a>
                </li>


            </ul>
        </li>



    </ul>
    <!-- /.side-menu -->
</nav>
