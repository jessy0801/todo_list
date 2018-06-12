/*
function todoList($scope) {
    /!*$.post('ajax.php', {item : 'all'}).done(function (data) {

    })*!/
    //$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    $http.post("ajax.php", {'item' : 'all'}).then(function (data) {
        $scope.itemsTodo = data;
        console.log(data)
    })

}*/

var app = angular.module('myTodoList', []);
app.controller('todoCtrl', function($scope, $http) {

    $scope.items = [];

    //$scope.sortby = 'date';
    $scope.order = 'DESC';

    var sortBy = 'add_time';
    $scope.optionsSort = [
        {
            name: 'Date d\'ajout',
            value: 'add_time'
        },
        {
            name: 'Piorité',
            value: 'priority'
        },
        {
            name: 'Categorie',
            value: 'id_cat'
        }
    ];
    $scope.sortby = $scope.optionsSort[0];

    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

    getItems();

    function getItems() {

        $http.post("ajax.php", 'item=all&sortBy='+sortBy+'&order='+$scope.order)
            .then(function (response) {
                $scope.items = response.data;
            });
    }

    $scope.changeSort = function () {
        sortBy = $scope.sortby.value;
        getItems();
    };
    $scope.changeOrder = function () {
        if ($scope.order === 'DESC') {
            $scope.order = 'ASC'
        } else {
            $scope.order = 'DESC'
        }
        getItems();
    };
    $scope.addItem = function () {
        console.log($scope.textInput);

        $http.post("ajax.php", 'item=add&text='+$scope.textInput ).then(function (response) {
            console.log(response);
            getItems();
            $scope.textInput = '';
        });

    };
    $scope.doneItem = function (idItem) {
        console.log('ok');

        $http.post("ajax.php", 'item=done&id=' + idItem)
            .then(function (response) {
                console.log(response);
                getItems();
            });

    };

    $scope.addPrio = function (idItem, defaultPrio) {
        console.log(defaultPrio);
        if (defaultPrio == 0) {
            $http.post("ajax.php", 'item=addPrio&id='+idItem )
                .then(function (response) {
                    console.log(response);
                    getItems();
                });
        } else  {
            $http.post("ajax.php", 'item=rmPrio&id='+idItem )
                .then(function (response) {
                    console.log(response);
                    getItems();
                });
        }

    };


    /* $scope.increasePrio = function (idItem) {
         console.log('add prio');
         $http.post("ajax.php", 'item=addPrio&id='+idItem )
             .then(function (response) {
                 console.log(response);
                 getItems();
             });
     };
     $scope.decreasePrio = function (idItem) {
         console.log('rm prio');
         $http.post("ajax.php", 'item=downPrio&id='+idItem )
             .then(function (response) {
                 console.log(response);
                 getItems();
             });
     };*/

    $scope.saveEdit =function (text, id) {
        console.log(id + 'te:' + text);
        eval('$scope.edit'+id+' = false');
        eval('$scope.cancel'+id+' = false');
        $http.post("ajax.php", 'item=edit&id=' + id + '&text=' + text).then(function (response) {
            console.log(response);
            getItems();
        });

    };
    $scope.cancelEdit = function (id) {
        eval('$scope.edit'+id+' = false');
        eval('$scope.cancel'+id+' = false');
        getItems();
    };

    $scope.delItem = function (id) {
        $http.post("ajax.php", 'item=del&id='+id ).then(function (response) {
            console.log(response);
            getItems();
        });
    };


    $scope.tesf = function (id) {
        eval('$scope.edit'+id+' = true');
        eval('$scope.cancel'+id+' = true');
        //test =true;
        console.log('et');

    }


}).directive('contenteditable', function() {
    return {
        require: 'ngModel',
        restrict: 'A',
        link: function(scope, elm, attr, ngModel) {

            function updateViewValue() {
                ngModel.$setViewValue(this.innerHTML);
            }

            //Or bind it to any other events
            elm.on('keyup', updateViewValue);

            scope.$on('$destroy', function() {
                elm.off('keyup', updateViewValue);
            });

            ngModel.$render = function() {
                elm.html(ngModel.$viewValue);
            }

        }
    }
}).directive('ngFocusOut', function( $timeout ) {
    return function( $scope, elem, attrs ) {
        $scope.$watch(attrs.ngFocusOut, function( newval ) {
            if ( newval ) {
                $timeout(function() {
                    elem[0].focusout();
                }, 0, false);
            }
        });
    };
});

app.controller('doneTask', function ($scope, $http) {
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    $scope.order = 'DESC';
    var sortBy = 'add_time';
    $scope.optionsSort = [
        {
            name: 'Date d\'ajout',
            value: 'add_time'
        },
        {
            name: 'Piorité',
            value: 'priority'
        },
        {
            name: 'Categorie',
            value: 'id_cat'
        }
    ];
    $scope.sortby = $scope.optionsSort[0];


    getItems();
    function getItems() {

        $http.post("ajax.php", 'item=doneTask&sortBy='+sortBy+'&order='+$scope.order)
            .then(function (response) {
                $scope.items = response.data;
            });
    }
    $scope.undoneItem = function (idItem) {
        $http.post("ajax.php", 'item=undone&id='+idItem )
            .then(function (response) {
                console.log(response);
                getItems();
            });
    };
    $scope.delItem = function (id) {
        $http.post("ajax.php", 'item=del&id='+id ).then(function (response) {
            console.log(response);
            getItems();
        });
    };
    $scope.changeSort = function () {
        sortBy = $scope.sortby.value;
        getItems();
    };
    $scope.changeOrder = function () {
        if ($scope.order === 'DESC') {
            $scope.order = 'ASC'
        } else {
            $scope.order = 'DESC'
        }
        getItems();
    };
    $scope.saveEdit =function (text, id) {
        console.log(id + 'te:' + text);
        eval('$scope.edit'+id+' = false');
        eval('$scope.cancel'+id+' = false');
        $http.post("ajax.php", 'item=edit&id=' + id + '&text=' + text).then(function (response) {
            console.log(response);
            getItems();
        });

    };
    $scope.cancelEdit = function (id) {
        eval('$scope.edit'+id+' = false');
        eval('$scope.cancel'+id+' = false');
        getItems();
    };
    $scope.tesf = function (id) {
        eval('$scope.edit'+id+' = true');
        eval('$scope.cancel'+id+' = true');
        //test =true;
        console.log('et');

    }
});
app.controller('about' , function ($scope, $http) {


});