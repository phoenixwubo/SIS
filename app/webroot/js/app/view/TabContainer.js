var tabCount = 4;
Ext.define('SIS.view.TabContainer', {					
	extend : 'Ext.tab.Panel',
	activeTab: 0,
	defaults: {
        bodyPadding: 10
    },
    alias : 'widget.tabcontainer', 
    items: [	
            	{
    	xtype:'electivelist'
    },
            	{
    	xtype:'tabhome'
    },{
    	xtype:'userlist',
    	iconCls:'users',
    	title:'用户信息',
    	id:'userlist',
    	closable: false,
    }/**/
    ],
    dockedItems: {
        dock: 'bottom',
        xtype: 'toolbar',
        items: [{
            text : '全部关闭',
            id:'closeall'
            
        }, {}, {}]
    }
});