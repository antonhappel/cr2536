
    <div class="wrapper clearfix">
        <span class="thumb avatar pull-left"> <img alt="..." width="69" class="dker" src="http://flatfull.com/themes/scale/images/a0.png"> <i class="on md b-black"></i> </span>
        <div class="user-info">
            <div class="greeting">Welcome</div>
            <div>{{Sentry::getUser()->first_name}} <span>{{Sentry::getUser()->last_name}}</span></div>
        </div>
    </div>

<ul data-ride="collapse" class="nav nav-main">
        <li>
            <a href="{{ route('core.home') }}">
                <i class="fa fa-bar-chart-o"></i> <span>{{trans('core::dashboard.dashboard')}}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('core.users.index') }}">
                <i class="fa fa-user"></i> <span>{{trans('core::dashboard.usermanagement')}}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('core.agencies.index') }}">
                <i class="fa fa-suitcase"></i> <span>{{trans('core::dashboard.agencymanagement')}}</span>
            </a>
        </li>
    </ul>
    </ul>