<?php

namespace Modules\Ciudades\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterCiudadesSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item('Ciudades', function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->append('admin.ciudades.ciudad.create');
                $item->route('admin.ciudades.ciudad.index');
                $item->authorize(
                    $this->auth->hasAccess('ciudades.ciudads.index')
                );
            });
        });

        return $menu;
    }
}
