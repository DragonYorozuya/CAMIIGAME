<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script src="./js/angular.js"></script>
</head>
<style>
.bg-tpreto{
    background-color: #2d2d2d;
}
.bg-tbranco{
    background-color: #ebebeb;
}

@font-face {
    font-family: switch;
    src: url(./fonts/Switch.otf);
}
.fontSwitch{
    font-family: switch;
}

.boxTOP{
    height: 25% !important;
}
.relogio{
   font-size: 1.9em;
}

.game{
    overflow: auto;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* ICON */
.boxUser{
    cursor: pointer;
}
.ic-box{
    overflow: auto;
}
.ic{
    height: 50%;
    border: 2px solid #4c4f54;
}


.ic-linkBtw{
    background-image: url(img/switch/icon_23.gif);
    background-position: -1 -1;
}



/* SCROLLBAR */
#style-4::-webkit-scrollbar
{
	width: 1em;
	height: 4px;
}

#style-4::-webkit-scrollbar-thumb
{
	background-color: darkgrey;
    outline: 1px solid slategrey;
}

@media (max-width: 778px) {
    .boxTOP{
        height: 15% !important;
    }
    
    .relogio{
       font-size: 0.9em;
    }
    .UserName{
        display: none;
    }
}
</style>
<body>
<div ng-app="CAMII" ng-controller="camiiCtr">
	<div class="container-fluid bg-tpreto">
		<div class="row">
			<div class="col-12 h-100 text-white fontSwitch">
				<!-- TOP -->
				<div class="row m-0 p-0 col-md-12 boxTOP">
    				<div class="d-flex flex-row dragscroll col-md-9  col-9 pt-3 pl-5 ic-box" id="style-4">
    					<div class="boxUser" >
    					 	<img ng-click="userSelect(1,$event)" class="ic mr-2 rounded-circle" src="img/switch/icon_25.gif">
    					 	<div class="text-center UserName" >Guh</div>
    					 </div>
    					<div class="boxUser" >
    					 	<img ng-click="userSelect(2,$event)" class="ic mr-2 rounded-circle" src="img/switch/icon_26.gif">
    					 	<div class="text-center UserName" >Gustavo</div>
    					 </div>
    					<div class="boxUser" >
    					 	<img ng-click="userSelect(3,$event)" class="ic mr-2 rounded-circle" src="img/switch/icon_23.gif">
    					 	<div class="text-center UserName" >Jonata</div>
    					 </div>
    					<div class="boxUser" >
    					 	<img ng-click="userSelect(4,$event)" class="ic mr-2 rounded-circle" src="img/switch/icon_59.gif">
    					 	<div class="text-center UserName" >Paulo</div>
    					</div> 
    					
    					 
    				</div>
    				
					<div class="col-3 col-md-3 pt-3 ">
						<div class="relogio mt-4 fontSwitch">{{hora | date:'h:mm a'}}</div>
					</div>
				</div>
				
				<!-- JOGOS  -->
				<div class="row m-0 p-0 col-md-12 h-50">
				<div class="d-flex flex-row game dragscroll w-100" id="style-4">
                  
                  <img alt="" class="h-100 p-2" ng-repeat="x in camii | filter : filtro | orderBy: 'nome'  " src="img/boxart/{{x.img}}">		
                  
                  		
                </div>
				</div>
				
				
				
				
			    <!-- DOWN -->
		
			</div>
		</div>
    </div>
</div>
</body>

<script type="text/javascript" src="./js/dragscroll.js"></script>
    
<script type="text/javascript">



// var clicked = false, clickY;
// $(".game").on({
//     'mousemove': function(e) {
//         clicked && updateScrollPos(e);
//     },
//     'mousedown': function(e) {
//         clicked = true;
//         clickY = e.pageX;
//     },
//     'mouseup': function() {
//         clicked = false;
//         $('html').css('cursor', 'auto');
//     }
// });

// var updateScrollPos = function(e) {
// //     $('html').css('cursor', 'row-resize');
//     $(window).scrollTop($(window).scrollTop() + (clickY - e.pageX));
// }


	var app = angular.module('CAMII',[]);
	app.controller('camiiCtr', function($scope, $http, $interval){
		
		$scope.hora = new Date();
        var updateTime = $interval(function() {
        	$scope.hora = new Date();
        }, 1000);


        var games =[
                    {user : 1, cod:1,nome:"Mario Odyssey",img:"marioodyssey.jpg"},
                    {user : 1, cod:2,nome:"Mario Kart 8 Deluxe",img:"marioKart8Deluxe.jpg"},
                    {user : 1, cod:3,nome:"Xenoblade Chronicles 2",img:"xenoart.jpg"},
                    {user : 1, cod:3,nome:"Xenoblade Chronicles 2: Torna the Golden Country DLC",img:"xeno2DLC.png"},
                    {user : 1, cod:4,nome:"Golf Story",img:"golfStory.jpg"},
                    {user : 1, cod:5,nome:"Okami Hd",img:"OkamiHD.jpg"},
                    {user : 1, cod:6,nome:"I am Setsuna",img:"IamSetsuna.jpg"},
                    {user : 1, cod:6,nome:"The Legend of Zelda: Breath of the Wild Expansion Pass",img:"zeldaBOTWdlc.jpg"},
                    {user : 2, cod:20,nome:"Fifa 18",img:"Fifa18.jpg"},
                    {user : 2, cod:21,nome:"METAL SLUG",img:"metalSlug.jpg"},
                    {user : 3, cod:50,nome:"NBA 2K19",img:"nba2k19.jpg"},
                    {user : 4, cod:100,nome:"Super Mario Party",img:"super mario party.jpg"},
                ]

        $scope.camii = games;

        $scope.userSelect=function(cod,user){
//             console.log(user.target);
            $(".UserName.d-block").removeClass("d-block");
			$(user.target).parent().find(".UserName").addClass("d-block");
            
			$scope.filtro = {user : cod};
        }
		
	})
// 	.directive('menu', ['$http', function($http) { 
// 		  return {
//             restrict: 'AE',
//             replace: true,
//             transclude: true,
//             scope: false,
// 			templateUrl: './tp/menu.html'
// 		};
// 	}])
</script>
</html>