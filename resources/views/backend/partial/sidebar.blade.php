<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('f.index') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('images/') }}/{{ $setting->site_logo ?? '' }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">{{ $setting->site_name ?? '' }}</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->is(['admin/dashboard*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link {{ request()->is(['admin/categories*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-view-list"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.subCategories.index') }}"
                        class="nav-link {{ request()->is(['admin/subCategories*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-view-list"></i>
                        <p>Breed</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pets.index') }}"
                        class="nav-link {{ request()->is(['admin/pets*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-list-ul"></i>
                        <p>Pet Listing</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.customers.index') }}"
                        class="nav-link {{ request()->is(['admin/customers*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi bi-people"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.promote-pets.index') }}"
                        class="nav-link {{ request()->is(['admin/promote-pets*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-card-text"></i>
                        <p>Promote Pets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.subscriptionPlans.index') }}"
                        class="nav-link {{ request()->is(['admin/subscriptionPlans*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-card-text"></i>
                        <p>Subscription Plan</p>
                    </a>
                </li>
                <!--<li class="nav-item">-->
                <!--    <a href="{{ route('admin.promotions.index') }}"-->
                <!--        class="nav-link {{ request()->is(['admin/customers*']) ? 'active' : '' }}">-->
                <!--        <i class="nav-icon bi bi-view-list"></i>-->
                <!--        <p>Promotion Package</p>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}"
                        class="nav-link {{ request()->is(['admin/subscriptions*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-vcard"></i>
                        <p>Contact form</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.chat') }}"
                        class="nav-link {{ request()->is(['admin/chat']) ? 'active' : '' }}">
                        <i class="nav-icon bi-chat-square-text"></i>
                        <p>Chat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.chat.index') }}"
                        class="nav-link {{ request()->is(['admin/chat/conversetion']) ? 'active' : '' }}">
                        <i class="nav-icon bi-chat-square-text-fill"></i>
                        <p>Chat Conversation</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.banners.index') }}"
                        class="nav-link {{ request()->is(['admin/banners*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-image-fill"></i>
                        <p>Ad Banner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cities.index') }}"
                        class="nav-link {{ request()->is(['admin/cities*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-geo-alt"></i>
                        <p>Locations</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pages.index') }}"
                        class="nav-link {{ request()->is(['admin/pages*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark"></i>
                        <p>Pages</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.scams.index') }}"
                        class="nav-link {{ request()->is(['admin/scams*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-list-check"></i>
                        <p>Buyer's checklist</p>
                    </a>
                </li>
                <!--<li class="nav-item">-->
                <!--    <a href="{{ route('admin.checklists.index') }}"-->
                <!--        class="nav-link {{ request()->is(['admin/checklists*']) ? 'active' : '' }}">-->
                <!--        <i class="nav-icon bi bi-card-checklist"></i>-->
                <!--        <p>Checklist</p>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="nav-item">
                    <a href="{{ route('admin.faqs.index') }}"
                        class="nav-link {{ request()->is(['admin/faqs*']) ? 'active' : '' }}">
                        <i class="nav-icon bi-question-square"></i>
                        <p>Faqs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reports.index') }}"
                        class="nav-link {{ request()->is(['admin/reports*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-flag"></i>
                        
                        <p></p>Reports</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.newsletters.index') }}"
                        class="nav-link {{ request()->is(['admin/newsletter/subscriptions']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-view-list"></i>
                        <p>Newsletters</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ request()->is(['admin/users*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Users</p>
                    </a>
                </li> --}}

                <li class="nav-item {{ request()->is(['admin/users*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            User Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ request()->is(['admin/roles*']) ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Roles & Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ request()->is(['admin/users*']) ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}"
                        class="nav-link {{ request()->is(['admin/settings*']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>Settings</p>
                    </a>
                </li>



            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
