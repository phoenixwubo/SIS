<?php
class Category extends AppModel {
public $actsAs = array('Tree');
var $name='Category';
var $order = 'Category.lft DSC';
}