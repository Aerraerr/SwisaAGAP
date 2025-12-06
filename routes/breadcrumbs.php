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


// Dashboard > Giveback
Breadcrumbs::for('giveback', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Giveback', route('giveback'));
});

// Dashboard > Giveback > View Giveback
Breadcrumbs::for('view-giveback', function (BreadcrumbTrail $trail, $giveback) {
    $trail->parent('giveback');
    $trail->push('View Giveback', route('view-giveback', $giveback->id));
});


// Dashboard > Training
Breadcrumbs::for('training-workshop', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Initiatives', route('training-workshop'));
});

// Dashboard > training > View training
Breadcrumbs::for('view-training', function (BreadcrumbTrail $trail, $training) {
    $trail->parent('training-workshop');
    $trail->push('View Initiatives', route('view-training', $training->id));
});

// Dashboard > Announcements
Breadcrumbs::for('announcements', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Announcements', route('announcements'));
});

// Dashboard > Assist
Breadcrumbs::for('assisted-creation', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Assisted Creation', route('assisted-creation'));
});

// Dashboard > Announcements
Breadcrumbs::for('grant-request', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Grant Request', route('grant-request'));
});

// Dashboard > Announcements
Breadcrumbs::for('member-application', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Membership Application', route('member-application'));
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


