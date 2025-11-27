<?php


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Members
Breadcrumbs::for('members', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Members', route('members'));
});

// Dashboard > Members > View Profile
Breadcrumbs::for('view-profile', function (BreadcrumbTrail $trail, $member) {
    $trail->parent('members');
    $trail->push('View Profile', route('view-profile', $member->id));
});








// Dashboard > Grants and Equipment
Breadcrumbs::for('grantsNequipment', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Grants and Equipment', route('grantsNequipment'));
});

// Dashboard > Grants and Equipment > View Grant
Breadcrumbs::for('view-grant', function (BreadcrumbTrail $trail, $grant) {
    $trail->parent('grantsNequipment');
    $trail->push('View Grant', route('view-grant', $grant->id));
});
// Dashboard > Grants and Equipment > View Grant > View Profile
Breadcrumbs::for('grant-view-profile', function (BreadcrumbTrail $trail, $grant, $member) {
    $trail->parent('view-grant', $grant); // pass grant here
    $trail->push('View Profile', route('view-profile', [$grant->id, $member->id]));
});


