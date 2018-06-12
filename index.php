<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Todo list</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/angular.min.js"></script>
    <script src="public/js/main.js"></script>

</head>
<body ng-app="myTodoList"  ng-controller="todoCtrl" >
<div class="jumbotron">
    <h1>Todo List</h1>
    <h3>Vous avez {{itemnodone}} chose a faire</h3>
</div>
<header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="">Categorie</a></li>
            <li class="nav-item"><a class="nav-link" href="">A propos</a></li>
        </ul>
    </nav>
</header>


<aside class="col-5 float-right">

</aside>

<section class="container" style="background-color: #8f9aa5;padding: 40px;">
    <form ng-submit="addItem()" >
        <input style="margin-bottom: 30px" class="form-control" type="text" ng-model="textInput"  placeholder="Quelque chose a faire ..." >
    </form>
    <label class="form-inline form-group" for="sortBy">Trier par :
        <select
                class="form-control"
                ng-model="sortby"
                ng-options="option.name for option in optionsSort"
                ng-change="changeSort()">
        </select>
        <button class="btn btn-light" ng-mousedown="changeOrder()" ><img style="max-height: 22px;" src="public/icon/829020_down_512x512.png" class="order-{{order}}" alt=""></button>
    </label>
    <ul style="list-style: none" >


        <li ng-repeat="item in items"  style="text-align: center; background-color: white; border-radius: 5px;padding: 10px; font-size: 1.6em;margin-bottom: 15px" >

            <input style="float: left" type="checkbox" id="item-{{item.id}}" value="{{item.done}}" ng-checked="item.done==1" ng-click="doneItem(item.id, item.done)">
            <span class="float-left" style="font-size: 0.6em; vertical-align: bottom">{{item.add_time}}</span>
            <div class="d-inline itemdone{{item.done}}" contenteditable="true" ng-click="tesf(item.id)" ng-model="test" >{{item.text}}
            </div>

                <button class="btn btn-success" ng-show="edit{{item.id}}" ng-mousedown="saveEdit(test, item.id)" >Save</button>
            <button class="btn btn-danger" ng-show="cancel{{item.id}}"  ng-mousedown="cancelEdit(item.id)" >Cancel</button>
            <button  ng-show="{{item.done}} == 1" style="float: right;padding: 4px;margin-left: 10px" class=" btn btn-danger" ng-mousedown="delItem(item.id)">
                <img style="max-width: 28px;" src="public/icon/693474_delete_512x512.png" alt=""></button>
            <button style="float: right; " class=" btn btn-danger" ng-mousedown="decreasePrio(item.id)">-</button>
            <span style="margin: 0 10px" class="float-right">{{item.priority}}</span>
            <button  style="float: right" class=" btn btn-success" ng-mousedown="increasePrio(item.id)">+</button>

            </li>

    </ul>
</section>
</body>
</html>
