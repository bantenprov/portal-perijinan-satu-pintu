# portal-perijinan-satu-pintu

[![Join the chat at https://gitter.im/perijinan-satu-pintu/Lobby](https://badges.gitter.im/perijinan-satu-pintu/Lobby.svg)](https://gitter.im/perijinan-satu-pintu/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/perijinan-satu-pintu/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/perijinan-satu-pintu/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/perijinan-satu-pintu/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/perijinan-satu-pintu/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/perijinan-satu-pintu/v/stable)](https://packagist.org/packages/bantenprov/perijinan-satu-pintu)
[![Total Downloads](https://poser.pugx.org/bantenprov/perijinan-satu-pintu/downloads)](https://packagist.org/packages/bantenprov/perijinan-satu-pintu)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/perijinan-satu-pintu/v/unstable)](https://packagist.org/packages/bantenprov/perijinan-satu-pintu)
[![License](https://poser.pugx.org/bantenprov/perijinan-satu-pintu/license)](https://packagist.org/packages/bantenprov/perijinan-satu-pintu)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/perijinan-satu-pintu/d/monthly)](https://packagist.org/packages/bantenprov/perijinan-satu-pintu)
[![Daily Downloads](https://poser.pugx.org/bantenprov/perijinan-satu-pintu/d/daily)](https://packagist.org/packages/bantenprov/perijinan-satu-pintu)

PerijinanSatuPintu

### Install via composer

- Development snapshot

```bash
$ composer require bantenprov/perijinan-satu-pintu:dev-master
```

- Latest release:

```bash
$ composer require bantenprov/perijinan-satu-pintu
```

### Download via github

```bash
$ git clone https://github.com/bantenprov/perijinan-satu-pintu.git
```

#### Edit `config/app.php` :

```php
'providers' => [

    /*
    * Laravel Framework Service Providers...
    */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    //....
    Bantenprov\PerijinanSatuPintu\PerijinanSatuPintuServiceProvider::class,
```

#### Lakukan migrate :

```bash
$ php artisan migrate
```

#### Publish database seeder :

```bash
$ php artisan vendor:publish --tag=perijinan-satu-pintu-seeds
```

#### Lakukan auto dump :

```bash
$ composer dump-autoload
```

#### Lakukan seeding :

```bash
$ php artisan db:seed --class=BantenprovPerijinanSatuPintuSeeder
```

#### Lakukan publish component vue :

```bash
$ php artisan vendor:publish --tag=perijinan-satu-pintu-assets
$ php artisan vendor:publish --tag=perijinan-satu-pintu-public
```
#### Tambahkan route di dalam file : `resources/assets/js/routes.js` :

```javascript
{
    path: '/dashboard',
    redirect: '/dashboard/home',
    component: layout('Default'),
    children: [
        //== ...
        {
         path: '/dashboard/perijinan-satu-pintu',
         components: {
            main: resolve => require(['./components/views/bantenprov/perijinan-satu-pintu/DashboardPerijinanSatuPintu.vue'], resolve),
            navbar: resolve => require(['./components/Navbar.vue'], resolve),
            sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
          },
          meta: {
            title: "PerijinanSatuPintu"
           }
       },
        //== ...
    ]
},
```

```javascript
{
    path: '/admin',
    redirect: '/admin/dashboard/home',
    component: layout('Default'),
    children: [
        //== ...
        {
            path: '/admin/perijinan-satu-pintu',
            components: {
                main: resolve => require(['./components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintu.index.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "PerijinanSatuPintu"
            }
        },
        {
            path: '/admin/perijinan-satu-pintu/create',
            components: {
                main: resolve => require(['./components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintu.add.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Add PerijinanSatuPintu"
            }
        },
        {
            path: '/admin/perijinan-satu-pintu/:id',
            components: {
                main: resolve => require(['./components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintu.show.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "View PerijinanSatuPintu"
            }
        },
        {
            path: '/admin/perijinan-satu-pintu/:id/edit',
            components: {
                main: resolve => require(['./components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintu.edit.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Edit PerijinanSatuPintu"
            }
        },
        //== ...
    ]
},
```
#### Edit menu `resources/assets/js/menu.js`

```javascript
{
    name: 'Dashboard',
    icon: 'fa fa-dashboard',
    childType: 'collapse',
    childItem: [
        //== ...
        {
        name: 'PerijinanSatuPintu',
        link: '/dashboard/perijinan-satu-pintu',
        icon: 'fa fa-angle-double-right'
        },
        //== ...
    ]
},
```

```javascript
{
    name: 'Admin',
    icon: 'fa fa-lock',
    childType: 'collapse',
    childItem: [
        //== ...
        {
        name: 'PerijinanSatuPintu',
        link: '/admin/perijinan-satu-pintu',
        icon: 'fa fa-angle-double-right'
        },
        //== ...
    ]
},
```

#### Tambahkan components `resources/assets/js/components.js` :

```javascript
//== PerijinanSatuPintu

import PerijinanSatuPintu from './components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintu.chart.vue';
Vue.component('echarts-perijinan-satu-pintu', PerijinanSatuPintu);

import PerijinanSatuPintuKota from './components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuKota.chart.vue';
Vue.component('echarts-perijinan-satu-pintu-kota', PerijinanSatuPintuKota);

import PerijinanSatuPintuTahun from './components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuTahun.chart.vue';
Vue.component('echarts-perijinan-satu-pintu-tahun', PerijinanSatuPintuTahun);

import PerijinanSatuPintuAdminShow from './components/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuAdmin.show.vue';
Vue.component('admin-view-perijinan-satu-pintu-tahun', PerijinanSatuPintuAdminShow);

//== Echarts Group Egoverment

import PerijinanSatuPintuBar01 from './components/views/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuBar01.vue';
Vue.component('perijinan-satu-pintu-bar-01', PerijinanSatuPintuBar01);

import PerijinanSatuPintuBar02 from './components/views/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuBar02.vue';
Vue.component('perijinan-satu-pintu-bar-02', PerijinanSatuPintuBar02);

//== mini bar charts
import PerijinanSatuPintuBar03 from './components/views/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuBar03.vue';
Vue.component('perijinan-satu-pintu-bar-03', PerijinanSatuPintuBar03);

import PerijinanSatuPintuPie01 from './components/views/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuPie01.vue';
Vue.component('perijinan-satu-pintu-pie-01', PerijinanSatuPintuPie01);

import PerijinanSatuPintuPie02 from './components/views/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuPie02.vue';
Vue.component('perijinan-satu-pintu-pie-02', PerijinanSatuPintuPie02);

//== mini pie charts


import PerijinanSatuPintuPie03 from './components/views/bantenprov/perijinan-satu-pintu/PerijinanSatuPintuPie03.vue';
Vue.component('perijinan-satu-pintu-pie-03', PerijinanSatuPintuPie03);

```

