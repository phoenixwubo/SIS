
Ext.define('SIS.view.elective.Selector',{
		  extend: 'Ext.panel.Panel',
		  requires: [
		             'Ext.ux.form.ItemSelector'
		  ],

		    alias: 'widget.electiveselector',
		    title:'选修课',
		    items:[
		           { xtype:'form',
		        	  title:'选择选修课',
		           	items:[{
		           		xtype:'itemselector',
		           		name:'itemselector',
		           		id:'itemselector_elective',
		           		anchor:'100%',
		           		filedLabel:'请选择',
		           		store:'Students',
		           		valueField:'stuid',
		           		displayFileld:'stu_name',
		           		fromTitle:'可选',
		           		toTltle:'已选'
		           	}
   	            	       ]}
		           ]}
   	            
		    );