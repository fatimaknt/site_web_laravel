        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="index.html"><img
                            src="https://ui-avatars.com/api/?name={{ AppNameGetter::getAppName() ? AppNameGetter::getAppName() : 'TP-Salaire' }}"
                            alt="user prodile" style="border-radius:50%">
                        {{ AppNameGetter::getAppName() ? AppNameGetter::getAppName() : 'TP-Salaire' }}
                    </a>
                    <span class="logo-text">
                    </span></a>

                </div><!--//app-branding-->

                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('dashboard') }}">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                        <path fill-rule="evenodd"
                                            d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('payments') }}">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                        <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                                    </svg>
                                </span>
                                <span class="nav-link-text">Paiement</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link" href="orders.html">
                                <span class="nav-link-text">overview</span> --}}
                        </a><!--//nav-link-->
                        </li><!--//nav-item-->
                        <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                                data-bs-target="#submenu-admins" aria-expanded="false" aria-controls="submenu-admins">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 7a2 2 0 1 0-4 0 2 2 0 0 0 4 0zM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                                        <path fill-rule="evenodd"
                                            d="M13 9c-2.33 0-7 1.17-7 3.5V14h14v-1.5C20 10.17 15.33 9 13 9zM6 10c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Administrateurs</span>
                            </a>
                            <div id="submenu-admins" class="collapse submenu" data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a class="submenu-link"
                                            href="{{ route('administrateurs.index') }}">Liste</a></li>
                                    <li class="submenu-item"><a class="submenu-link"
                                            href="{{ route('administrateurs.create') }}">Ajout</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                                data-bs-target="#submenu-depts" aria-expanded="false" aria-controls="submenu-depts">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-building"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6.5 15.5v-2h-2v2h2zm3 0v-2h-2v2h2zm3 0v-2h-2v2h2zm-9-3v-2h-2v2h2zm3 0v-2h-2v2h2zm3 0v-2h-2v2h2zm3 0v-2h-2v2h2zm-9-3v-2h-2v2h2zm3 0v-2h-2v2h2zm3 0v-2h-2v2h2zm3 0v-2h-2v2h2zm-9-3v-2h-2v2h2zm3 0v-2h-2v2h2zm3 0v-2h-2v2h2zm3 0v-2h-2v2h2z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Départements</span>
                            </a>
                            <div id="submenu-depts" class="collapse submenu" data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a class="submenu-link"
                                            href="{{ route('departements.index') }}">Liste</a></li>
                                    <li class="submenu-item"><a class="submenu-link"
                                            href="{{ route('departements.create') }}">Ajout</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                                data-bs-target="#submenu-employers" aria-expanded="false"
                                aria-controls="submenu-employers">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                        class="bi bi-person-badge" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.5 2a2.5 2.5 0 1 1 5 0 2.5 2.5 0 0 1-5 0zM2 14s-1 0-1-1 1-4 7-4 7 3 7 4-1 1-1 1H2zm11-1c0-.5-2.5-3-6-3s-6 2.5-6 3h12z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Employers</span>
                            </a>
                            <div id="submenu-employers" class="collapse submenu" data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a class="submenu-link"
                                            href="{{ route('employers.index') }}">Liste</a></li>
                                    <li class="submenu-item"><a class="submenu-link"
                                            href="{{ route('employers.create') }}">Ajout</a></li>
                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item has-submenu">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                    data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                    <span class="nav-link-text">External</span>
                    <span class="submenu-arrow">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </span><!--//submenu-arrow-->
                </a><!--//nav-link-->
            </li><!--//nav-item-->


            <li class="nav-item">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link" href="charts.html">
                    <span class="nav-link-text">Charts</span>
                </a><!--//nav-link-->
            </li><!--//nav-item--> --}}

                    </ul><!--//app-menu-->
                </nav><!--//app-nav-->
                <div class="app-sidepanel-footer">
                    <nav class="app-nav app-nav-footer">
                        <ul class="app-menu footer-menu list-unstyled">
                            <li class="nav-item">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a class="nav-link" href="{{ route('configurations') }}">
                                    <span class="nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                            <path d="M9.796 1.343c-.381-.81-.966-1.483-1.7-1.863a4.372 4.372 0 0 0-4.01.145l-1.204.602a4.373 4.373 0 0 0-.32 2.5l.11.634a4.373 4.373 0 0 0-.71 2.263l-.034.673a4.373 4.373 0 0 0 1.655 4.13l.66.566a4.373 4.373 0 0 0 2.185.916l.554.082a4.373 4.373 0 0 0 2.347-.563l.597-.486a4.373 4.373 0 0 0 1.738-2.127l.102-.585a4.373 4.373 0 0 0 1.46-2.995l-.006-.38c-.01-.192-.025-.383-.04-.573a4.374 4.374 0 0 0-1.226-2.6Z"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text">Configurations</span>
                                </a><!--//nav-link-->
                            </li><!--//nav-item-->
                            <li class="nav-item">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a class="nav-link"
                                    href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">
                                     <span class="nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg>
                                     </span>
                                    <span class="nav-link-text">Download</span>
                                </a><!--//nav-link-->
                            </li><!--//nav-item-->
                            <li class="nav-item">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a class="nav-link"
                                    href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">
                                    <span class="nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                                            <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text">License</span>
                                </a><!--//nav-link-->
                            </li><!--//nav-item-->
                        </ul><!--//footer-menu-->
                    </nav>
                </div><!--//app-sidepanel-footer-->

            </div><!--//sidepanel-inner-->
        </div><!--//app-sidepanel-->
