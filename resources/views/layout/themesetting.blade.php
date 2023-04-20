<div class="themesetting">
    <a href="javascript:void(0);" class="theme_btn"><i class="fa fa-gear fa-spin"></i></a>
    <ul class="list-group">
        <li class="list-group-item">
            <ul class="choose-skin list-unstyled mb-0">
                @if (isset($themesettings->theme))
                    <li data-theme="green" class="{{$themesettings->theme == 'theme-green' ? 'active' : ''  }}"><div class="green"></div></li>
                    <li data-theme="orange" class="{{$themesettings->theme == 'theme-orange' ? 'active' : ''  }}"><div class="orange"></div></li>
                    <li data-theme="blush" class="{{$themesettings->theme == 'theme-blush' ? 'active' : ''  }}"><div class="blush"></div></li>
                    <li data-theme="cyan"  class="{{$themesettings->theme == 'theme-cyan' ? 'active' : ''  }}"><div class="cyan"></div></li>
                    <li data-theme="timber" class="{{$themesettings->theme == 'theme-timber' ? 'active' : ''  }}"><div class="timber"></div></li>
                    <li data-theme="blue" class="{{$themesettings->theme == 'theme-blue' ? 'active' : ''  }}"><div class="blue"></div></li>
                    <li data-theme="amethyst" class="{{$themesettings->theme == 'theme-amethyst' ? 'active' : ''  }}"><div class="amethyst"></div></li>
                @else
                <li data-theme="green"><div class="green"></div></li>
                <li data-theme="orange"><div class="orange"></div></li>
                <li data-theme="blush"><div class="blush"></div></li>
                <li data-theme="cyan"  class="active"><div class="cyan"></div></li>
                <li data-theme="timber" ><div class="timber"></div></li>
                <li data-theme="blue" ><div class="blue"></div></li>
                <li data-theme="amethyst" ><div class="amethyst"></div></li>
                @endif

            </ul>
        </li>
        <li class="list-group-item d-flex align-items-center justify-content-between">
            <span>Light Sidebar</span>
            <label class="switch sidebar_light">
                <input type="checkbox" @if (isset($themesettings->light_sidebar)) {{$themesettings->light_sidebar == 'light_active' ? 'checked="checked"' : '' }} @endif>
                <span class="slider round"></span>
            </label>
        </li>
        <li class="list-group-item d-flex align-items-center justify-content-between">
            <span>Gradient</span>
            <label class="switch gradient_mode">
                <input type="checkbox" @if(isset($themesettings->gradient)) {{$themesettings->gradient == 'gradient' ? 'checked="checked"' : '' }} @endif>
                <span class="slider round"></span>
            </label>
        </li>
        <li class="list-group-item d-flex align-items-center justify-content-between">
            <span>Dark Mode</span>
            <label class="switch dark_mode">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </li>
        <li class="list-group-item d-flex align-items-center justify-content-between">
            <span>RTL version</span>
            <label class="switch rtl_mode">
                <input type="checkbox" @if(isset($themesettings->rtl_mode)) {{$themesettings->rtl_mode == 'rtl_active' ? 'checked="checked"' : '' }} @endif>
                <span class="slider round"></span>
            </label>
        </li>
    </ul>
    <hr>

</div>
