<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-danger elevation-4 rounded-right-admin" style="border-top-right-radius: 40px; border-bottom-right-radius: 40px">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{ URL::asset('img/SRlogo2.png')}}" class="brand-image img-circle">
        <span class="brand-text">Klinik Samratulangi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{Request::is('dashboard')?' active':''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                @if(Auth::user()->level === 'admin')
                    <li class="nav-item">
                        <a href="/pasien" class="nav-link {{Request::is('pasien*')?' active':''}}">
                            <i class="nav-icon fas fa-wheelchair"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter" class="nav-link {{Request::is('dokter*')?' active':''}}">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item {{Request::is('janji*')?' menu-open active':''}}"">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>
                                Janji
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/janji/admin/tambah" class="nav-link {{Request::is('janji/admin/tambah')?' active':''}}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Tambah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/janji/admin/hari-ini" class="nav-link {{Request::is('janji/admin/hari-ini*')?' active':''}}">
                                    <i class="far fa-clipboard nav-icon"></i>
                                    <p>Hari Ini</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/janji/admin/yang-akan-datang" class="nav-link {{Request::is('janji/admin/yang-akan-datang*')?' active':''}}">
                                    <i class="far fa-clipboard nav-icon"></i>
                                    <p>Yang Akan Datang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/janji/admin/lampau" class="nav-link {{Request::is('janji/admin/lampau*')?' active':''}}">
                                    <i class="far fa-clipboard nav-icon"></i>
                                    <p>Lampau</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->level === 'admin' || Auth::user()->level === 'doctor')
                    <li class="nav-item">
                        <a href="/diagnosis" class="nav-link {{Request::is('diagnosis*')?' active':''}}">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>Diagnosis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/rekam-medis" class="nav-link {{Request::is('rekam-medis*')?' active':''}}">
                            <i class="nav-icon fas fa-file-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>
                    <li class="nav-item {{Request::is('surat*')?' menu-open active':''}}"">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Surat
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/surat/keterangan-istirahat" class="nav-link {{Request::is('surat/keterangan-istirahat*')?' active':''}}">
                                    <i class="far fa-envelope nav-icon"></i>
                                    <p>Keterangan Istirahat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/surat/rujukan" class="nav-link {{Request::is('surat/rujukan*')?' active':''}}">
                                    <i class="far fa-envelope nav-icon"></i>
                                    <p>Rujukan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->level === 'patient')
                    <li class="nav-item">
                        <a href="/janji" class="nav-link {{Request::is('janji*')?' active':''}}">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>Janji</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
