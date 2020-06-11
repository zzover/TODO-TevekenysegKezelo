<!-- Oldalsáv  -->
<nav id="sidebar">
            <div class="sidebar-header">
                <h3>ToDo</h3>
                <strong>TD</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#Overview" title="<?php echo textHome[$lang]['itemOverview'];?>" class="hivatkozas" id="menuOverview">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 9.185l7 6.514v6.301h-14v-6.301l7-6.514zm0-2.732l-9 8.375v9.172h18v-9.172l-9-8.375zm2 14.547h-4v-6h4v6zm10-8.852l-1.361 1.465-10.639-9.883-10.639 9.868-1.361-1.465 12-11.133 12 11.148z"/></svg>
                        <span class="elrejt"><?php echo textHome[$lang]['itemOverview'];?></span>
                    </a>
                </li>

                <li>
                    <a href="#Important" title="<?php echo textHome[$lang]['itemImportant'];?>" class="hivatkozas" id="menuImportant">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 5.173l2.335 4.817 5.305.732-3.861 3.71.942 5.27-4.721-2.524-4.721 2.525.942-5.27-3.861-3.71 5.305-.733 2.335-4.817zm0-4.586l-3.668 7.568-8.332 1.151 6.064 5.828-1.48 8.279 7.416-3.967 7.416 3.966-1.48-8.279 6.064-5.827-8.332-1.15-3.668-7.569z"/></svg>
                        <span class="elrejt"><?php echo textHome[$lang]['itemImportant'];?></span>
                    </a>
                </li>

                <li>
                    <a href="#Notification" title="<?php echo textHome[$lang]['itemNotification'];?>" class="hivatkozas" id="menuNotification">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10.771 22c-.646.646-1.535 1-2.422 1-.874 0-1.746-.346-2.376-.976-1.27-1.27-1.308-3.563-.024-4.846l4.822 4.822zm10.859-22c-.618 0-1.238.237-1.713.711l-.002.003c-.604.605-1.48.845-2.3.627-5.929-1.574-11.011 7.82-16.21 5.179l-1.405 1.406 16.075 16.074 1.404-1.406c-2.641-5.197 6.756-10.28 5.179-16.21-.217-.817.023-1.696.627-2.298l.002-.003c.475-.476.713-1.096.713-1.714 0-1.31-1.055-2.369-2.37-2.369zm-3.479 13.443c-2.026 2.957-2.729 4.233-3.14 6.668l-11.123-11.125.527-.088c2.237-.374 4.312-1.795 6.144-3.049 2.212-1.516 4.503-3.122 6.544-2.575 1.793.475 3.147 1.829 3.624 3.624.535 2.01-.976 4.213-2.576 6.545zm4.353-10.339c-.444.443-1.163.442-1.607-.001-.443-.443-.444-1.163 0-1.606.444-.444 1.164-.444 1.607-.001.443.443.443 1.165 0 1.608z"/></svg>
                        <span class="elrejt"><?php echo textHome[$lang]['itemNotification'];?></span>
                        <span class="badge badge-primary" id="notificationBadge"></span>
                    </a>
                </li>

                
                <hr>
                <li>
                    <a href="#Calendar" title="<?php echo textHome[$lang]['itemCalendar'];?>" class="hivatkozas" id="menuCalendar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M17 3v-2c0-.552.447-1 1-1s1 .448 1 1v2c0 .552-.447 1-1 1s-1-.448-1-1zm-12 1c.553 0 1-.448 1-1v-2c0-.552-.447-1-1-1-.553 0-1 .448-1 1v2c0 .552.447 1 1 1zm13 13v-3h-1v4h3v-1h-2zm-5 .5c0 2.481 2.019 4.5 4.5 4.5s4.5-2.019 4.5-4.5-2.019-4.5-4.5-4.5-4.5 2.019-4.5 4.5zm11 0c0 3.59-2.91 6.5-6.5 6.5s-6.5-2.91-6.5-6.5 2.91-6.5 6.5-6.5 6.5 2.91 6.5 6.5zm-14.237 3.5h-7.763v-13h19v1.763c.727.33 1.399.757 2 1.268v-9.031h-3v1c0 1.316-1.278 2.339-2.658 1.894-.831-.268-1.342-1.111-1.342-1.984v-.91h-9v1c0 1.316-1.278 2.339-2.658 1.894-.831-.268-1.342-1.111-1.342-1.984v-.91h-3v21h11.031c-.511-.601-.938-1.273-1.268-2z"/></svg>
                    <span class="elrejt"><?php echo textHome[$lang]['itemCalendar'];?></span>
                    </a>
                </li>
                <hr>
                
                <li>
                    <a href="#ProjectMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" title="<?php echo textHome[$lang]['itemProject'];?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7v13h-20v-10h5.262c2.169 0 3.417-.944 5.812-3h8.926zm2-2h-11.668c-2.659 2.292-3.512 3-5.07 3h-7.262v14h24v-17zm-16.738 1c.64 0 1.11-.271 2.389-1.34l-2.651-2.66h-7v4h7.262z"/></svg>
                        <span class="elrejt"><?php echo textHome[$lang]['itemProject'];?></span>
                    </a>
                    <ul class="collapse list-unstyled" id="ProjectMenu">
                        <li>
                        <a href="#Projects" title="<?php echo textHome[$lang]['itemAllProjects'];?>" class="hivatkozas" id="menuProjects">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M2.688 6l-.688-2h20l-.604 2h-18.708zm17.541-4l.739-2h-17.968l.792 2h16.437zm2.162 8l.609-2h-22l.609 2h20.782zm-.752 4l-1.333 8h-16.612l-1.333-8h3.639l2.25 3h7.5l2.25-3h3.639zm2.361-2h-7l-2.25 3h-5.5l-2.25-3h-7l2 12h20l2-12z"/></svg>
                            <span class="elrejt"><?php echo textHome[$lang]['itemAllProjects'];?></span>
                            </a>
                        </li>

                        <li>
                            <a href="#NewProject" title="<?php echo textHome[$lang]['itemNewProject'];?>" class="hivatkozas" id="menuNewProject">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 17h-3v-3h-2v3h-3v2h3v3h2v-3h3v-2zm-10 5h-14v-20h7c1.695 1.942 2.371 3 4 3h13v7h-2v-5h-11c-2.34 0-3.537-1.388-4.916-3h-4.084v16h12v2z"/></svg>
                            <span class="elrejt"><?php echo textHome[$lang]['itemNewProject'];?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>