Ext.define('SIS.view.sheet.ResultSheet' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.resultsheet',

    title: '成绩单',
//    store:'Scores',
    bodyPadding: 5,  // 避免Panel中的子元素紧邻边框
    width: 300,
    title: 'Filters',
    dockedItems: [{
        xtype: 'toolbar',
        dock: 'top',
        items:[{
    	xtype: 'textfield',
    	id: 'stu_number',
        fieldLabel: '学号'
        },{xtype: 'button',
            text : '搜索',
            id:'search'
        },]}],
    items: [
        	
        
            {
        xtype: 'scoresearchresult',
//        fieldLabel: '学号'
    }, {xtype:'electivesearchresult'
    }]    
});