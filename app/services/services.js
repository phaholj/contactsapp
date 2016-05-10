'use strict';

app.factory('ContactsFactory', ['$http', function($http) {
    var urlBase = '/contactsapp/api/contacts';
  
    var obj = {};
	
	obj.getContacts = function () {
        return $http.get(urlBase);
    };
	
	
    obj.getContact = function(customerID){
        return $http.get(urlBase + '/' + customerID);
    };

	
	obj.updateContact = function (contacts) {
        return $http.put(urlBase + '/' + contacts.ID, contacts);
    };
	
	
	obj.deleteContact = function (id) {
        return $http.delete(urlBase + '/' + id);
    };

    return obj;   
}]);


