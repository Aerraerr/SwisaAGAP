<?php


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// FOR MEMBERS
// Dashboard > Members
Breadcrumbs::for('members', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Members', route('members'));
});

// Dashboard > Members > View Profile
Breadcrumbs::for('view-profile', function (BreadcrumbTrail $trail) {
    $trail->parent('members');
    $trail->push('View Profile', route('view-profile'));
});

// FOR GRANTS AND EQUIPMENTS
// Dashboard > Grants
Breadcrumbs::for('grantsNequipment', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Grants and Equipment', route('grantsNequipment'));
});

// Dashboard > Grants > View grant
Breadcrumbs::for('view-grant', function (BreadcrumbTrail $trail) {
    $trail->parent('grantsNequipment');
    $trail->push('View Grant', route('view-grant'));
});

// Dashboard > Grants > View grant > View Profile
Breadcrumbs::for('grant-view-profile', function (BreadcrumbTrail $trail) {
    $trail->parent('view-grant');
    // 👇 important: use grant-view-profile route, not view-profile
    $trail->push('View Profile', route('grant-view-profile'));
});
