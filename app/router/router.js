'use strict';

app.config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'app/views/list.html',
        controller: 'ContactsListCtrl'
      })
      .when('/contacts', {
        templateUrl: 'app/views/list.html',
        controller: 'ContactsListCtrl'
      })
      .when('/contacts/new', {
        templateUrl: 'app/views/new.html',
        controller: 'ContactAddCtrl'
      })
      .when('/contacts/:id/edit', {
        templateUrl: 'app/views/edit.html',
        controller: 'ContactEditCtrl',
      })
      .otherwise({
        redirectTo: '/'
      });
  });