<?php

namespace App\Classes\Theme;

use App\Models\MenuManager;
// use App\Models\Theme;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class Menu
{

  public static function sidebar()
  {
    $menuManager = new MenuManager;
    $roleId = isset(Auth::user()->roles[0]) ? Auth::user()->roles[0]->id : NULL;
    $menu_list = $menuManager->getall($roleId);
    $roots = $menu_list->where('parent_id', 0) ?? array();
    return self::tree($roots, $menu_list, $roleId);
  }



  public static function trees($roots, $menu_list, $roleId, $parentId = 0)
  {
    $html = '
    <ul id="sidebarnav">
    <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">Home</span>
    </li>

    <li class="sidebar-item">
      <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
        <span class="d-flex">
          <i class="ti ti-chart-donut-3"></i>
        </span>
        <span class="hide-menu">Blog</span>
      </a>
      <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
          <a href="blog-posts.html" class="sidebar-link">
            <div class="round-16 d-flex align-items-center justify-content-center">
              <i class="ti ti-circle"></i>
            </div>
            <span class="hide-menu">Posts</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="blog-detail.html" class="sidebar-link">
            <div class="round-16 d-flex align-items-center justify-content-center">
              <i class="ti ti-circle"></i>
            </div>
            <span class="hide-menu">Details</span>
          </a>
        </li>
      </ul>
    </li>

  </ul>';

    return $html;

  }


  public static function tree($roots, $menu_list, $roleId, $parentId = 0)
  {
    $html = '<ul  id="sidebarnav">';
    $segment ='/'.request()->segment(1). '/' .request()->segment(2);
    foreach ($roots as $item) {
        $find = $menu_list->where('parent_id', $item['id']);
        if($find->count()){
          $mm_active = "";
          $segment_child ='/'.request()->segment(1). '/' .request()->segment(2);
          foreach ($find as $val) {
              if( $val->menupermission->path_url == $segment_child){
                  $mm_active = "mm-active" ;
              }
          }
          $html .= '
              <li class="sidebar-item '.$mm_active.'">
                    <a class="sidebar-link '.($find->count() > 0  ? "has-arrow" : '').'" href ="'.(isset($item->path_url) ? $item->path_url  : 'javascript: void(0);').'">
                        <i class="' . (!$item->menu_permission_id ? $item->icon : $item->menupermission->icon) . '" ></i>
                        <span class="hide-menu">'. (!$item->menu_permission_id ? $item->title : $item->menupermission->title) . '</span>
                    </a>

          ';
        }else{
          $html .= '
          <li class="sidebar-item">
             <a  class="sidebar-link" href ="'.(!$item->menu_permission_id ? 'javascript: void(0);' : $item->menupermission->path_url).'">
              <i class="' . (!$item->menu_permission_id ? $item->icon : $item->menupermission->icon) . '"></i>
              <span class="hide-menu">'. (!$item->menu_permission_id ? $item->title : $item->menupermission->title) . '</span>
          </a>
          ';
        }

        if ($find->count()) {
          $html .= self::children($find, $menu_list, $roleId, $item['id']);
        }
        $html .= '</li>';
        $html .= '</li>';
      }

    return $html;

  }



  public static function children($roots, $menu_list, $roleId, $parentId = 0){
    $segment ='/'.request()->segment(1). '/' .request()->segment(2);
    foreach ($roots as $item) {
     //   $show = (isset($item->menupermission->path_url)  ?  ($segment == $item->menupermission->path_url) ? 'show' : '' : '');
        $html = '<ul aria-expanded="false" class="collapse first-level">';
    }


    foreach ($roots as $item) {

      $find = $menu_list->where('parent_id', $item['id']);
      $active = (isset($item->menupermission->path_url)  ?  ($segment == $item->menupermission->path_url) ? 'mm-active' : '' : '');
      if ($find->count() > 0) {

        // $segment_child ='/'.request()->segment(1). '/' .request()->segment(2);
        // foreach ($find as $val) {
        //     if( ){
        //         $active = "mm-active" ;
        //     }
        // }
        $htmlChildren = self::children($find, $menu_list, $roleId, $item['id']);
        $html .= '
        <li class="sidebar-item '.$active.'">
            <a class="sidebar-link">
            <i class="' . (!$item->menu_permission_id ? $item->icon : $item->menupermission->icon) . '"></i>
                ' . (!$item->menu_permission_id ? $item->title : $item->menupermission->title) . '
            </a>
            '.$htmlChildren.'
        </li>';
      }else{
        $html .= '
        <li class="sidebar-item '.$active.'">
            <a class="sidebar-link" href="'.(!$item->menu_permission_id ? ($item->path_url ? $item->path_url : '#') : $item->menupermission->path_url).'">
            <i class="' . (!$item->menu_permission_id ? $item->icon : $item->menupermission->icon) . '"  >
            </i>
            <span class="hide-menu">' . (!$item->menu_permission_id ? $item->title : $item->menupermission->title) . '</span>
            </a>
        </li>';
      }
    }
    $html .= '</ul>';
    return $html;
  }
}


