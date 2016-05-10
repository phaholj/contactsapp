 'use strict';
 
  app.controller('ContactEditCtrl', function ($scope, $http, $location, $routeParams, $filter, AlertService, ContactsFactory) {
	  
      var id = $routeParams.id;
	  $scope.ContactDetail = [];
	  var message = '';
	  
      // Load contact
      $http.get('/contactsapp/api/contacts/'+id).success(function(data) {
        $scope.ContactDetail = data;
      });
	  
	  // Save contacts
      $scope.save = function(contact) {
          $http.put('/contactsapp/api/contacts/'+id, contact).success(function(data) {
          $scope.ContactDetail = data;
		  
		  // Display the message
		  message = 'Contact "' + data.name + '" with id "' + data.id+ '" was updated successfully.';
          AlertService.add('success', message, 5000);
		  
		  $location.path('/');
        }); 
      };
  });