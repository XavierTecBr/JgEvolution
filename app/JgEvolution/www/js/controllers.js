var retorno = undefined;
var BASE_URL = "http://localhost/jgevolution/web/";


angular.module('starter.controllers', [])


.controller('AppCtrl', function($scope, $ionicModal, $timeout) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //$scope.$on('$ionicView.enter', function(e) {
  //});

  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.modal.hide();
  };

  // Open the login modal
  $scope.login = function() {
    $scope.modal.show();
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {
    console.log('Doing login', $scope.loginData);

    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
})

.controller('PlaylistsCtrl', function($scope) {
  $scope.playlists = [
    { title: 'Reggae', id: 1 },
    { title: 'Chill', id: 2 },
    { title: 'Dubstep', id: 3 },
    { title: 'Indie', id: 4 },
    { title: 'Rap', id: 5 },
    { title: 'Cowbell', id: 6 }
  ];
})

.controller('PlaylistCtrl', function($scope, $stateParams) {
})

.controller('NewVersionCtrl', function($scope,$http) {
  $scope.bolTenteNovamente = false;
  $scope.mostrarCarregando = true;

  $scope.reloadRoute = function() {
   window.location.reload(true);
  }

  $http({
        url: BASE_URL + "Version/listVersion",
        method: "GET",
        headers: {
          'Content-Type': 'application/json' // Note the appropriate header
        }
    }).success(function(data,status){
        
        var obj = data;
        objItens = obj.result;

        if(objItens == false){
          $scope.mostrarCarregando = false;
          $scope.showAlert = function() {
            var alertPopup = $ionicPopup.alert({
              title: 'Atenção!',
              template: 'Não há Versões...'
            });
          }

          $scope.showAlert();

          $scope.bolTenteNovamente = true;
        }else{
           for(i=0; i < objItens.length; i++ ){
            if (objItens[i]['version'] == 001){
              objItens[i]['already'] = true;
             
            }else{
              objItens[i]['already'] = false;
            }

             console.log(objItens[i]);
          }
          
          $scope.versions = objItens;
          $scope.mostrarCarregando = false;
        }
      }).error(function(data,status){
          console.log(data|| "Request Failed");
      }
    );
});

