<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Users Table';

$fnameOpt = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label for="loginform-email" class="field prepend-icon">{input}<label for="fname" class="field-icon"><i class="fa fa-user"></i></label></label>',
];

$fieldOptions2 = [
    'options' => ['class' => 'section'],
    'inputTemplate' => '<label for="loginform-password" class="field prepend-icon">{input}<label for="username" class="field-icon"><i class="fa fa-lock"></i></label></label>',
];
?>
<!-- begin: .tray-center -->
<div class="tray tray-center">

    <!-- create new order panel -->
    <div class="panel mb25 mt5">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Add New User</span>
        </div>
        <div class="panel-body p20 pb10">
            <div class="tab-content pn br-n admin-form">
                <div id="tab1_1" class="tab-pane active">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="section row mbn">
                        <div class="col-md-12 pl15">
                            <div class="section row mb15">

                                <div class="col-xs-3">
                                    <?= $form
                                        ->field($model, 'fname', $fnameOpt)
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('fname'),'class'=>'event-name gui-input br-light light']) ?>
                                </div>

                                <div class="col-xs-3">
                                    <label for="name2" class="field prepend-icon">
                                        <input type="text" name="name2" id="name2" class="event-name gui-input br-light light" placeholder="Last Name">
                                        <label for="name2" class="field-icon">
                                            <i class="fa fa-user"></i>
                                        </label>
                                    </label>
                                </div>

                                <div class="col-xs-3">
                                    <label for="name2" class="field prepend-icon">
                                        <input type="text" name="email" id="email" class="event-name gui-input br-light light" placeholder="Email Address">
                                        <label for="email" class="field-icon">
                                            <i class="fa fa-envelope-o"></i>
                                        </label>
                                    </label>
                                </div>

                                <div class="col-xs-3">
                                    <label for="name2" class="field prepend-icon">
                                        <input type="text" name="email" id="email" class="event-name gui-input br-light light" placeholder="User Role">
                                        <label for="email" class="field-icon">
                                            <i class="fa fa-envelope-o"></i>
                                        </label>
                                    </label>
                                </div>

                            </div>
                            <div class="section row mb15">
                                <div class="col-xs-6">
                                    <label for="password" class="field prepend-icon">
                                        <input type="password" name="password" id="password" class="event-name gui-input br-light light" placeholder="Password">
                                        <label for="name2" class="field-icon">
                                            <i class="fa fa-lock"></i>
                                        </label>
                                    </label>
                                </div>
                                <div class="col-xs-6">
                                    <label for="password2" class="field prepend-icon">
                                        <input type="password2" name="password2" id="password2" class="event-name gui-input br-light light" placeholder="Confirm Password">
                                        <label for="password2" class="field-icon">
                                            <i class="fa fa-unlock"></i>
                                        </label>
                                    </label>
                                </div>
                            </div>

                            <div class="section mb15">
                                <label for="email" class="field prepend-icon">
                                    <input type="text" name="email" id="email" class="event-name gui-input br-light bg-light" placeholder="Email Address">
                                    <label for="email" class="field-icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </label>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="section row mbn">
                        <div class="col-sm-12">
                            <p class="text-right">
                                <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
                            </p>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- recent orders table -->
    <div class="panel">
        <div class="panel-menu admin-form theme-primary">
            <div class="row">
                <div class="col-md-4">
                    <label class="field select">
                        <select id="filter-purchases" name="filter-purchases">
                            <option value="0">Filter by Purchases</option>
                            <option value="1">1-49</option>
                            <option value="2">50-499</option>
                            <option value="1">500-999</option>
                            <option value="2">1000+</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
                <div class="col-md-4">
                    <label class="field select">
                        <select id="filter-group" name="filter-group">
                            <option value="0">Filter by Group</option>
                            <option value="1">Customers</option>
                            <option value="2">Vendors</option>
                            <option value="3">Distributors</option>
                            <option value="4">Employees</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
                <div class="col-md-4">
                    <label class="field select">
                        <select id="filter-status" name="filter-status">
                            <option value="0">Filter by Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Suspended</option>
                            <option value="4">Online</option>
                            <option value="5">Offline</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body pn">
            <div class="table-responsive">
                <table class="table admin-form theme-warning tc-checkbox-1 fs13">
                    <thead>
                    <tr class="bg-light">
                        <th class="text-center">Select</th>
                        <th class="">Avatar</th>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="">Registered</th>
                        <th class="">Purchases</th>
                        <th class="">Total Spent</th>
                        <th class="text-right">Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/1.jpg">
                        </td>
                        <td class="">Dave Robert</td>
                        <td class="">dave@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">222</td>
                        <td class="">$3,600</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/2.jpg">
                        </td>
                        <td class="">Sara Marshall</td>
                        <td class="">sara@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">16</td>
                        <td class="">$4,200</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/3.jpg">
                        </td>
                        <td class="">Larry Kingster</td>
                        <td class="">larry@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">46</td>
                        <td class="">$16,200</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/4.jpg">
                        </td>
                        <td class="">Emily Roundwheel</td>
                        <td class="">emily@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">06</td>
                        <td class="">$1,400</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/5.jpg">
                        </td>
                        <td class="">Nick Cannoneer</td>
                        <td class="">sara@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">43</td>
                        <td class="">$13,600</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/6.jpg">
                        </td>
                        <td class="">Morgan Lunar</td>
                        <td class="">morgan@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">11</td>
                        <td class="">$3,200</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/4.jpg">
                        </td>
                        <td class="">Emily Roundwheel</td>
                        <td class="">emily@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">06</td>
                        <td class="">$1,400</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-warning br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> In-Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/2.jpg">
                        </td>
                        <td class="">Sara Marshall</td>
                        <td class="">sara@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">16</td>
                        <td class="">$4,200</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-warning br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> In-Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/1.jpg">
                        </td>
                        <td class="">Roger Rover</td>
                        <td class="">roger@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">33</td>
                        <td class="">$17,100</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-warning br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> In-Active
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/2.jpg">
                        </td>
                        <td class="">Laura Smileton</td>
                        <td class="">laura@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">12</td>
                        <td class="">$3,100</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-danger br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Suspended
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <label class="option block mn">
                                <input type="checkbox" name="mobileos" value="FR">
                                <span class="checkbox mn"></span>
                            </label>
                        </td>
                        <td class="w50">
                            <img class="img-responsive mw30 ib mr10" title="user" src="/img/avatars/1.jpg">
                        </td>
                        <td class="">Dave Robert</td>
                        <td class="">dave@company.com</td>
                        <td class="">12/03/2014</td>
                        <td class="">222</td>
                        <td class="">$3,600</td>
                        <td class="text-right">
                            <div class="btn-group text-right">
                                <button type="button" class="btn btn-danger br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Suspended
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="active">
                                        <a href="#">Active</a>
                                    </li>
                                    <li>
                                        <a href="#">Suspend</a>
                                    </li>
                                    <li>
                                        <a href="#">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- end: .tray-center -->