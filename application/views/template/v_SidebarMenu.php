<!--Sidebar Menu-->

<!--Quick Menu-->
<div class="quickmenu hide">
    <div class="quickmenu__cont">
        <div class="quickmenu__list">
            <div class="quickmenu__item active">
                <div class="fa fa-fw fa-home"></div>
            </div>
            <div class="quickmenu__item">
                <div class="fa fa-fw fa-envelope-o"></div>
            </div>
            <div class="quickmenu__item new">
                <div class="fa fa-fw fa-comments-o"></div>
            </div>
            <div class="quickmenu__item">
                <div class="fa fa-fw fa-feed"></div>
            </div>
            <div class="quickmenu__item">
                <div class="fa fa-fw fa-cog"></div>
            </div>
        </div>
    </div>
</div>
<!--Quick Menu-->

<!--Prime Menu-->
<div class="scrollable scrollbar-macosx ">
    <div class="sidebar__cont">
        <div class="sidebar__menu">
            <div class="sidebar__title">STATUS</div>

            <ul class="nav nav-menu">

                <li class="<?php echo ($subpage == 'Dashboard')? 'active': ''; ?>"><a href="<?php echo site_url('dashboard/rectifier/1'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-dashcube"></i></div>
                        <div class="nav-menu__text"><span>Dashboard</span></div>
                    </a></li>
                <li class="<?php echo ($subpage == 'Monitor')? 'active': ''; ?>"><a href="<?php echo site_url('monitor/rectifier/1'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-desktop"></i></div>
                        <div class="nav-menu__text"><span>Monitoring</span></div>
                    </a></li>

                <li class="<?php echo ($subpage == 'Rectifier')? 'active': ''; ?>"><a href="<?php echo site_url('rectifier'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-building"></i></div>
                        <div class="nav-menu__text"><span>Rectifier</span></div>
                    </a></li>
            </ul>



            <div class="sidebar__title">SETTINGS</div>
            <ul class="nav nav-bar">
                <li class="<?php echo ($subpage == 'Dtime')? 'active': ''; ?>">
                    <a href="<?php echo site_url('settings/dtime'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-calendar"></i></div>
                        <div class="nav-menu__text"><span>Time </span></div>
                    </a></li>
                <li class="<?php echo ($subpage == 'Network')? 'active': ''; ?>">
                    <a href="<?php echo site_url('settings/network'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-laptop"></i></div>
                        <div class="nav-menu__text"><span>Network</span></div>
                    </a></li>
                <li class=" hide <?php echo ($subpage == 'Controll')? 'active': ''; ?>">
                    <a href="<?php echo site_url('settings/controll'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-sliders"></i></div>
                        <div class="nav-menu__text"><span>Controll</span></div>
                    </a></li>

                <li class="<?php echo ($page == 'Controll')? 'active': ''; ?>">
                    <a href="<?php echo site_url('controll/ac_distribution'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-sliders"></i></div>
                        <div class="nav-menu__text"><span>Controll</span></div>
                    </a></li>

                <li class="<?php echo ($page == 'Alarms')? 'active': ''; ?>">
                    <a href="<?php echo site_url('alarms'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-bell-o"></i></div>
                        <div class="nav-menu__text"><span>Alarm</span></div>
                    </a></li>

                <li class="<?php echo ($page == 'Administrator')? 'active': ''; ?>">
                    <a href="<?php echo site_url('administrator'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-users"></i></div>
                        <div class="nav-menu__text"><span>Admin User</span></div>
                    </a></li>

            </ul>

            <div class="sidebar__title">LOGS</div>
            <ul class="nav nav-bar">
                <li class="<?php echo ($subpage == 'DataLog')? 'active': ''; ?>">
                    <a href="<?php echo site_url('logs/data_monitor'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-server"></i></div>
                        <div class="nav-menu__text"><span>Data Log</span></div>
                    </a></li>
                <li class="<?php echo ($subpage == 'EventLog')? 'active': ''; ?>">
                    <a href="<?php echo site_url('logs/event_alarm'); ?>">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-paw"></i></div>
                        <div class="nav-menu__text"><span>Event Log</span></div>
                    </a></li>
            </ul>



            <div class="sidebar__title hide">HELP</div>
            <ul class="nav nav-bar hide">
                <li>
                    <a href="#">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-info"></i></div>
                        <div class="nav-menu__text"><span>System info</span></div>
                    </a></li>
            </ul>


            <div class="sidebar__title hide">Template</div>
            <ul class="nav nav-menu hide">
                <li><a href="#">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-th-large"></i></div>
                        <div class="nav-menu__text"><span>UI Elements</span></div>
                        <div class="nav-menu__right"><i class="fa fa-fw fa-angle-right arrow"></i></div>
                    </a>
                    <ul class="nav nav-menu__second collapse">
                        <li><a href="general.html">General</a></li>
                        <li><a href="panels.html">Panels</a></li>
                        <li><a href="tabs.html">Tabs</a></li>
                        <li><a href="modals.html">Modals</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                    </ul>
                </li>
                <li><a href="#">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-clone"></i></div>
                        <div class="nav-menu__text"><span>Forms</span></div>
                        <div class="nav-menu__right"><i class="fa fa-fw fa-angle-right arrow"></i></div>
                    </a>
                    <ul class="nav nav-menu__second collapse">
                        <li><a href="controls.html">Controls</a></li>
                        <li><a href="validation.html">Validation</a></li>
                        <li><a href="texteditor.html">Text Editor</a></li>
                    </ul>
                </li>
                <li><a href="#">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-table"></i></div>
                        <div class="nav-menu__text"><span>Tables</span></div>
                        <div class="nav-menu__right"><i class="fa fa-fw fa-angle-right arrow"></i></div>
                    </a>
                    <ul class="nav nav-menu__second collapse">
                        <li><a href="table_static.html">Static</a></li>
                        <li><a href="table_sortable.html">Sortable</a></li>
                        <li><a href="table_data.html">DataTable</a></li>
                    </ul>
                </li>
                <li><a href="charts.html">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-pie-chart"></i></div>
                        <div class="nav-menu__text"><span>Charts</span></div>
                    </a></li>
            </ul>
        </div>
        <div class="sidebar__menu">
            <div class="sidebar__btn"><a href="compose.html" class="btn btn-block btn-default">Compose Mail</a></div>
            <div class="sidebar__title">Mail</div>
            <ul class="nav nav-menu">
                <li><a href="inbox.html">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-inbox"></i></div>
                        <div class="nav-menu__text"><span>Inbox</span></div>
                        <div class="nav-menu__right"><i class="badge badge-default"><b>2</b> / 100</i></div>
                    </a></li>
                <li><a href="sent.html">
                        <div class="nav-menu__ico"><i class="fa fa-fw fa-upload"></i></div>
                        <div class="nav-menu__text"><span>Sent</span></div>
                        <div class="nav-menu__right"><i class="badge badge-default">30</i></div>
                    </a></li>
            </ul>
            <div class="sidebar__title">Tags</div>
            <div class="ul nav nav-menu">
                <li><a href="inbox.html">
                        <div class="nav-menu__ico tag_clients"><i class="fa fa-fw fa-tag"></i></div>
                        <div class="nav-menu__text"><span>Clients</span></div>
                    </a></li>
                <li><a href="inbox.html">
                        <div class="nav-menu__ico tag_social"><i class="fa fa-fw fa-tag"></i></div>
                        <div class="nav-menu__text"><span>Social</span></div>
                    </a></li>
                <li><a href="inbox.html">
                        <div class="nav-menu__ico tag_support"><i class="fa fa-fw fa-tag"></i></div>
                        <div class="nav-menu__text"><span>Support</span></div>
                    </a></li>
            </div>
        </div>
        <div class="sidebar__menu">
            <div class="sidebar__title">New Messages</div>
            <div class="lm-widget">
                <div class="lm-widget__list">
                    <div class="lm-widget__item new">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_support"></i><span>Support</span></div>
                        <div class="lm-widget__text">Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item new">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_clients"></i><span>Stephen Olson</span></div>
                        <div class="lm-widget__text">Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                </div>
            </div>
            <div class="sidebar__title">Recent list</div>
            <div class="lm-widget">
                <div class="lm-widget__list">
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_social"></i><span>Jesse Shaw</span></div>
                        <div class="lm-widget__text">Nam ultrices, libero non mattis pulvinar.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag"></i><span>Mary Payne</span></div>
                        <div class="lm-widget__text">Vivamus tortor. Duis mattis egestas metus.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag"></i><span>Bob Romero</span></div>
                        <div class="lm-widget__text">Morbi porttitor lorem id ligula.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_social"></i><span>Kevin Hosser</span></div>
                        <div class="lm-widget__text">Libero non mattis pulvinar.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_clients"></i><span>Perry Winter</span></div>
                        <div class="lm-widget__text">Tortor. Duis mattis egestas metus.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_support"></i><span>Ivan Nemirov</span></div>
                        <div class="lm-widget__text">Portitor lorem id ligula.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag"></i><span>Jonny Fount</span></div>
                        <div class="lm-widget__text">Lorem id ligula morbi porttitor .</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag"></i><span>Hue Logan</span></div>
                        <div class="lm-widget__text">Pulvinar libero non mattis.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_clients"></i><span>Summer Gordon</span></div>
                        <div class="lm-widget__text">Hattis tortor. Duis egestas metus.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                    <div class="lm-widget__item">
                        <div class="lm-widget__title"><i class="fa fa-fw fa-tag tag_support"></i><span>Sonya Blade</span></div>
                        <div class="lm-widget__text">Itor lorem id ligula.</div>
                        <a href="inbox.html" class="lm-widget__link"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar__menu">
            <div class="sidebar__title">Recent activity</div>
            <div class="ra-widget">
                <div class="ra-widget__cont">
                    <div class="ra-widget__list">
                        <div class="ra-widget__item ra-widget__item_user">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text"><a href='./'>Gary Long</a> has registered.<span class="ra-widget__date">09:20</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_product">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">New product <a href='./'>Sony PlayStation 4</a>.<span class="ra-widget__date">10:08</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_order">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">Order <a href='./'>#35108243</a>.<span class="ra-widget__date">Jan 28, 09:42</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_subscriber">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text"><a href='./'>Julie Payne</a> subscribed to news.<span class="ra-widget__date">Jan 28, 18:06</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_mail">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">30 letters was sent.<span class="ra-widget__date">Jan 27, 03:08</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_order">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">Order <a href='./'>#35597433</a>.<span class="ra-widget__date">Jan 26, 19:02</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_payment">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">$385 incoming payment.<span class="ra-widget__date">Jan 26, 18:06</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_payment">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">$2824 incoming payment.<span class="ra-widget__date">Jan 26, 09:11</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_subscriber">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text"><a href='./'>Greg Bush</a> subscribed to news.<span class="ra-widget__date">Jan 26, 05:36</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_product">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">New product <a href='./'>Shoober</a>.<span class="ra-widget__date">Jan 25, 23:19</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_order">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">Order <a href='./'>#31248769</a>.<span class="ra-widget__date">Jan 25, 16:51</span></div>
                            </div>
                        </div>
                        <div class="ra-widget__item ra-widget__item_payment">
                            <div class="ra-widget__ico"><i class="fa fa-fw"></i></div>
                            <div class="ra-widget__info">
                                <div class="ra-widget__text">$3205 incoming payment.<span class="ra-widget__date">Jan 25, 10:44</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar__menu">
            <div class="sidebar__title">Settings</div>
            <div class="ss-widget">
                <div class="ss-widget__cont">
                    <div class="ss-widget__row">
                        <div class="ss-widget__cell">Site</div>
                        <div class="ss-widget__cell">
                            <input type="checkbox" checked="checked" data-size="micro" data-on-color="success" data-off-color="danger" class="bs-switch">
                        </div>
                    </div>
                    <div class="ss-widget__row">
                        <div class="ss-widget__cell">Mailing</div>
                        <div class="ss-widget__cell">
                            <input type="checkbox" data-size="micro" data-on-color="success" data-off-color="danger" class="bs-switch">
                        </div>
                    </div>
                    <div class="ss-widget__item">
                        <div class="ss-widget__label">Limit</div>
                        <div class="ss-widget__value">
                            <input type="text" name="" value="" data-grid="false" data-min="0" data-max="2000" data-from="600" data-step="200" class="settings-slider">
                        </div>
                    </div>
                    <div class="ss-widget__row">
                        <div class="ss-widget__cell">Timeout</div>
                        <div class="ss-widget__cell">
                            <input type="number" min="5" max="50" step="5" value="15" class="form-control input-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidestat">
                <div class="sidestat__cont">
                    <div class="sidestat__item">
                        <div class="sidestat__value">1,760</div>
                        <div class="sidestat__text">visits of your site</div>
                        <div class="sidestat__chart sparkline bar">
                            1699,1686,8368,9011,6129,3837,0997,2034,0483,1457,2950,8946,0866,6247,8222,5727,0020,6883,3410,5224,2034,0483,1457,2950,5946,0866
                        </div>
                    </div>
                    <div class="sidestat__item">
                        <div class="sidestat__value">2,034</div>
                        <div class="sidestat__text">views of your products</div>
                        <div class="sidestat__chart sparkline area">5696,6514,9647,6326,6028,8869,8251,9146,6137,8997,6892,9544,7011,6556,7737,8348,7011,6558,7556</div>
                    </div>
                    <div class="sidestat__item">
                        <div class="sidestat__value">$2,950</div>
                        <div class="sidestat__text">average day earning</div>
                        <div class="sidestat__chart sparkline bar_thin">
                            6658,8005,9033,8360,3385,9018,9089,7804,5574,7556,6910,4327,7500,6563,0649,2584,8757,6815,8368,9011,6129,3837,0997,2034,0483,1457,2950,8946,0866,6247,3385,9018,9089,7804,5574,7556,6910,4327,7500,7804,5574,7556,6910,4327,7500,6563,0649,2584
                        </div>
                    </div>
                    <div class="sidestat__item">
                        <div class="sidestat__value">290</div>
                        <div class="sidestat__text">month orders</div>
                        <div class="sidestat__chart sparkline line">075,487,581,520,075,630,350,631,794,666,466,322,833,471,721,703,042,328,844,996,099,342,841,599</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Prime Menu-->


<!--Sidebar Menu-->