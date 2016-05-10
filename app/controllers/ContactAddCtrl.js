'use strict';
   
   app.controller('ContactAddCtrl', function ($scope, $http, $location, AlertService) {
       
	  var message = '';
	  
	  // Add new contacts
      $scope.save = function(contact) {
          $http.post('/contactsapp/api/contacts', contact).success(function(data) {
		  
		  // Display the message
		  message = 'Contact "' + contact.name+ '" was added successfully.';
          AlertService.add('success', message, 5000);
		  
		  $location.path('/');
        }); 
      };
	  
   });