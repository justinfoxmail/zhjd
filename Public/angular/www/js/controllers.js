angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $http, $ionicModal, $timeout) {
  $scope.loginData = {};

  $ionicModal.fromTemplateUrl('Template/home/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

  $scope.closeLogin = function() {
    $scope.modal.hide();
  };

  $scope.login = function() {
    $scope.loginData.loginstatus = "";
    $scope.modal.show();
  };

  $scope.doLogin = function() {
    $http.post("/index.php/Index/doLogin",$scope.loginData).success(function(data) {
      switch(data) {
        case 0:
              $scope.loginData.loginstatus = "登录失败";
              break;
        case 1:
              $scope.loginData.loginstatus = "登录成功";
              $timeout(function() {
                $scope.closeLogin();
              }, 1000);
      }
    });
  };
})

.controller('PlaylistsCtrl', function($scope,$http) {
  $scope.goIndex = function(target) {
    window.location = "/index.php/Place/info?place="+target;
  }

  $scope.goPlace = function(target) {
    window.location = "/index.php/Place/index?pid="+target;
  }

  $scope.goPhotos = function(target) {
    window.location = "/index.php/Place/photos?place="+target;
  }

   $scope.doRefresh = function() {
    setTimeout( function() {
      $scope.$broadcast('scroll.refreshComplete');
    }, 1000);
  }

  $http.get("/index.php/Index/getIndexs").success(function(data) {
      $scope.playlists=data;
  });
})

.controller('BrowseCtrl', function($scope,$ionicModal,$http) {
  $scope.getNews = function() {
    $http.get("index.php/Index/getNews").success(function(data) {
        $scope.news=data;
    });
  }

   $scope.doRefresh = function() {
    $scope.getNews();
    setTimeout( function() {
      $scope.$broadcast('scroll.refreshComplete');
    }, 2000);
  }

  $scope.getNews();
})

.factory('FlightDataService', function($q, $timeout) {
    var searchAirlines = function(searchFilter,data) {
        var deferred = $q.defer();

      var matches = data.filter( function(data) {
        if(data.name.indexOf(searchFilter) !== -1 ) return true;
      })
        $timeout( function(){
           deferred.resolve( matches );
        }, 100);
        return deferred.promise;
    };
    return {
        searchAirlines : searchAirlines
    }
})

.controller('SearchCtrl', ['$scope', '$http', 'FlightDataService', function($scope, $http, FlightDataService) {

    $http.get("/index.php/Index/getIndexs").success(function(data) {
        $scope.playlists=data;
        $scope.search();
    });

    $scope.data = { "playlists" : [], "search" : '' };

    $scope.search = function() {
        
      FlightDataService.searchAirlines($scope.data.search, $scope.playlists).then(
        function(matches) {
          $scope.data.playlists = matches;
        }
      )
    }

    $scope.cancel = function() {
      $scope.data.search = "";
      $scope.search();
    }

}]);

