Ext.define('SIS.view.department.Tree',{
	extend:'Ext.tree.Panel',
	alias:'widget.departmentTree',
	border:false,
	title:'班级管理',
/*	tbar: [{
        text: '展开',
        id:'expand',
        scope: this,
        //handler: this.onExpandAllClick
        iconCls : 'refreshItem',
        handler:function(){
		console.log('展开');
	}
    }, {
        text: '折叠',
        id:'collaspe',
        scope: this,
        //handler: this.onCollapseAllClick
    }],*/
	rootVisible:false,
	store:'Departments',
	bodyStyle:{
	background:'#ffc',
	padding:'10px'
}
});