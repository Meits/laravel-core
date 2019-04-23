<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Menu;

class AdminController extends Controller
{
    //var for template
    protected $vars = array();
    //var for title page
    protected $title = FALSE;

    protected $description = FALSE;
    //var for template
    protected $template = FALSE;
    //var for template
    protected $locale;

    protected $user;

    /**
     * AdminController constructor.
     */
    public function __construct() {
        $this->template = 'administrator::pages';

        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user();

            return $next($request);
        });
    }

    /**
     * @return $this
     */
    protected function renderOutput() {
        //render view
        $menu = $this->getMenu();
        $photo = Setting::where('field','system_photo')->first()->value;

        $sidebar = view('administrator::layouts.parts.sidebar')->with(['menu'=>$menu, 'photo' => $photo, 'user' => Auth::user()])->render();
        $this->vars = array_add($this->vars, 'sidebar', $sidebar);

        return view($this->template)->with($this->vars);
    }

    public function getMenu()
    {
        $this->locale = App::getLocale();
        return Menu::make('adminMenu', function ($menu) {

            $menu->add(__('admin.menu_title_content'),'#')->data('group', true)->data('permissions', ['SUPER_ADMINISTRATOR','PAGES_ACCESS']);
            $menu->add(__('admin.menu_title_pages'), array('route' => ['pages.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','PAGES_ACCESS']);
            $menu->add(__('admin.menu_title_seo_pages'), array('route' => ['seo.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','PAGES_ACCESS']);
            $menu->add(__('admin.menu_title_users'), array('route' => ['users.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','USERS_ACCESS']);
            $menu->add(__('admin.menu_title_roles'), array('route' => ['roles.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','ROLES_ACCESS']);
            $menu->add(__('admin.menu_title_permissions'), array('route' => ['permissions.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','ROLES_ACCESS']);
            $menu->add(__('admin.menu_title_faq'), array('route' => 'faq.index'))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','FAQ_ACCESS']);
            $menu->add(__('admin.menu_title_contacts'), array('route' => 'contacts.index'))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR']);


            $menu->add(__('admin.menu_title_system'),'#')->data('group', true)->data('permissions', ['SUPER_ADMINISTRATOR','SETTINGS_ACCESS','USERS_ACCESS','ROLES_ACCESS']);
            $menu->add(__('admin.menu_title_settings'), array('route' => ['settings.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);
            $menu->add(__('admin.menu_title_seo_google_container'), array('route' => ['scripts.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);
            $menu->add(__('admin.menu_title_seo_robots'), array('route' => ['robots.index']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);
            $menu->add(__('admin.menu_title_image_manager'), array('route' => ['ckfinder_examples','example' => 'full-page-open']))->prepend('<i class="icon-home4"></i>')->data('permissions', ['SUPER_ADMINISTRATOR','SETTINGS_ACCESS']);

        })->filter(function ($item) {

            if ($this->user && $this->user->canDo($item->data('permissions'))) {
                return true;
            }
            return false;
        });;
    }
}
