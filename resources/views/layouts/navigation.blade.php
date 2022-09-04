<aside class="flex">
    <div tabindex="0" role="button" @click="isSideMenuOpen = false" :class="isSideMenuOpen ? 'block' : 'hidden'"
        class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden">
    </div>

    <div class="sidebar" :class="isSideMenuOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="brand-logo" :class="{ 'justify-center': isMiniSidebar }">
            <a href="/index.html" class="flex items-center">
                <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                        fill="#4C51BF" stroke="#4C51BF" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                    <path
                        d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                        fill="white" />
                </svg>

                <span class="app-name"> Analyzen </span>
            </a>
            <span @click="isSideMenuOpen = false" class="material-icons sidebar-close"> close </span>
        </div>

        <nav id="sidebar-menu" class="overflow-y-auto h-sidebar" x-init="$store.dropdown.tab = 'dashboard'">
            <ul class="nav-menu space-y-2">
                <li x-data="dropdownItem('dashboard')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">dashboard</span>
                        <span class="link-label">Dashboards</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="index.html" class="dropdown-item-link dropdown-link-active">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Default</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="ecommerce.html" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>eCommerce</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="projects.html" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Projects</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="online-courses.html" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Online Courses</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="marketing.html" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Marketing</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('components')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">layers</span>
                        <span class="link-label">Components</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="./alerts.html" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Alert</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Badge</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Button</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Dropdown</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Collapse</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Pagination</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Modals</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header">Forms & Tables</li>
                <li x-data="dropdownItem('form-elements')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">hexagon</span>
                        <span class="link-label">Form Elements</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Input</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Input Group</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Select</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Radio</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Checkbox</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Textarea</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="./form.html" class="nav-link">
                        <span class="material-icons">description</span>
                        <span class="link-label">Form Layout</span>
                    </a>
                </li>

                <li class="menu-header">Pages</li>
                <li x-data="dropdownItem('user-profile')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">perm_contact_calendar</span>
                        <span class="link-label">User Profile</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Overview</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Documents</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Followers</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Activities</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('account')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons rotate-90">label_important_outline</span>
                        <span class="link-label">Account</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Overview</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Statements</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Activities</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Logs</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('authentication')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">person</span>
                        <span class="link-label">Authentication</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="/login.html" class="dropdown-item-link" target="_blank">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Login</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Register</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Reset Password</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Forget Password</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>New Password</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('corporate')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">corporate_fare</span>
                        <span class="link-label">Corporate</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>About</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Our Team</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Contact Us</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Licenses</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Sitemap</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('utilities')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">construction</span>
                        <span class="link-label">Utilities</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Modals</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Search</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Wizards</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('careers')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">work</span>
                        <span class="link-label">Careers</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Careers List</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Careers Apply</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('widgets')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">widgets</span>
                        <span class="link-label">Widgets</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Lists</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Statistics</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Charts</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Mixed</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Tables</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Feeds</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header">Apps</li>
                <li x-data="dropdownItem('projects')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">fence</span>
                        <span class="link-label">Projects</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>My Project</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>View Project</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Users</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Files</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('eCommerce')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">shopping_basket</span>
                        <span class="link-label">eCommerce</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Category</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Sales</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Customers</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('contacts')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">interests</span>
                        <span class="link-label">Contacts</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Getting Started</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Add Contact</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Edit Contact</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>View Contact</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('user-management')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">workspaces</span>
                        <span class="link-label">User Management</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Users</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Roles</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Permissions</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li x-data="dropdownItem('customers')">
                    <div role="button" @click="handleClick()" class="nav-link" :class="activeDropdown()">
                        <span class="material-icons">change_history</span>
                        <span class="link-label">Customers</span>
                        <span class="material-icons dropdown-icon" :class="handleRotate()">
                            expand_more
                        </span>
                    </div>
                    <ul x-ref="tab" :style="handleToggle()" class="dropdown-menu">
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Getting Started</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>CUstomer Listing</span>
                            </a>
                        </li>
                        <li role="menuitem" class="dropdown-item group">
                            <a href="#" class="dropdown-item-link">
                                <span class="dropdown-circle material-icons">circle</span>
                                <span>Customer Details</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
