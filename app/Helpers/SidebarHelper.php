<?php

namespace App\Helpers;

class SidebarHelper {
  static $menu = [
    'brand' => [
      'title' => 'Nhà xe',
      'url' => 'admin.brand.index',
      'icon' => 'fas fa-bus',
      'permission' => 'xem-hang-xe'
    ],
    'place' => [
      'title' => 'Địa diểm',
      'url' => 'admin.place.index',
      'icon' => 'fas fa-map-marker-alt',
      'permission' => 'xem-dia-diem'
    ],
    'route' => [
      'title' => 'Tuyến đường',
      'url' => 'admin.route.index',
      'icon' => 'fas fa-road',
      'permission' => '	xem-tuyen-duong'
    ],
    'trip' => [
      'title' => 'Chuyến',
      'url' => 'admin.trip.index',
      'icon' => 'fas fa-shuttle-van',
      'permission' => 'xem-chuyen'
    ],
    'schedule' => [
      'title' => 'Lịch chạy',
      'url' => 'admin.trip_date.index',
      'icon' => 'fas fa-clipboard-list',
      'permission' => 'xem-lich-chay'
    ],
    'disctrict' => [
      'title' => 'Quận huyện',
      'url' => 'admin.district.index',
      'icon' => 'fas fa-map-signs',
      'permission' => 'xoa-khu-vuc'
    ],
    'province' => [
      'title' => 'Tỉnh thành',
      'url' => 'admin.province.index',
      'icon' => 'fas fa-city',
      'permission' => 'xem-tinh'
    ],
    'ticket' => [
      'title' => 'Vé xe',
      'url' => 'admin.ticket.index',
      'icon' => 'fas fa-ticket-alt',
      'permission' => 'xem-ve'
    ],
    'user' => [
      'title' => 'Người dùng và phân quyền',
      'url' => 'admin.user.index',
      'icon' => 'fas fa-users',
      'permission' => 'xem-nguoi-dung'
    ],
  ];

  public static function getSideBar()
  {
      $user = auth('admin')->user();

      $userPermissions = $user->role->permissions()->pluck('slug')->toArray();
      $menu = self::$menu;
      $showMenu = [];
      foreach ($menu as $key => $value) {
        if (in_array($value['permission'], $userPermissions)) {
          $showMenu[] = $value;
        }
      }
      return $showMenu;
  }
}
