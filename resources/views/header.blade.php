<!--<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
            <li><a href="{{ route('users.index') }}"> @lang('common.Users') </a></li>
            <li><a href="{{ route('permissions.index') }}"> @lang('common.Permissions') </a></li>
            <li><a href="{{ route('groups.index') }}"> @lang('common.Groups') </a></li>
            <li><a href="{{ route('roles.index') }}"> @lang('common.Roles') </a></li>
        </ul>
    </div>
</div>-->
<?php 
    $routename = request()->route()->getName();
?>
<ul class="nav nav-tabs">
  <li class="@if( $routename == 'dashboard') active @endif"><a href="{{ route('dashboard') }}"> @lang('common.Dashboard') </a></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">@lang('common.Acl')
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li class="@if ( $routename == 'users.index') active @endif"><a href="{{ route('users.index') }}"> @lang('common.Users') </a></li>
        <li class="@if ( $routename == 'permissions.index') active @endif"><a href="{{ route('permissions.index') }}"> @lang('common.Permissions') </a></li>
        <li class="@if ( $routename == 'groups.index') active @endif"><a href="{{ route('groups.index') }}"> @lang('common.Groups') </a></li>
        <li class="@if ( $routename == 'roles.index') active @endif"><a href="{{ route('roles.index') }}"> @lang('common.Roles') </a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> @lang('common.Purchase')
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li class="dropdown-submenu">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> @lang('common.Branch')
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a> Branch 1 </a></li>
                <li><a> Branch 2 </a></li>
            </ul>
          </li>
        <li><a> @lang('common.Category') </a></li>
        <li><a> @lang('common.Product') </a></li>
        <li class="@if ( $routename == 'socials.index') active @endif"><a href="{{ route('socials.index') }}"> @lang('common.Socials') </a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> @lang('common.News')
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a> @lang('common.Category') </a></li>
        <li><a> @lang('common.Post') </a></li>
    </ul>
  </li>
</ul>