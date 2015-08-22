Ext.define('SIS.view.user.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.userlist',

    title: 'All Users',
    store:'Users',
    autoload:true,
    stripeRows: true,
    renderGender:function(value){
	if(value==1){
		return "男";

	}else{
		return "女";
	}
	},	
	//设置每页显示数量
	setLimit:function(){
		console.log(this.store.pageSize);
	},
	
    initComponent: function() {
//        this.store = {
//            fields: ['name', 'email'],
//            data  : [
//                {name: 'Ed',    email: 'ed@sencha.com'},
//                {name: 'Tommy', email: 'tommy@sencha.com'}
//            ]	
//        };
		
        this.columns = [
            {header: 'ID',  dataIndex: 'id',  flex: 1},     
            {header: '用户名',  dataIndex: 'username',  flex: 1},            
            {header: '姓名',  dataIndex: 'fullname',  flex: 1},
          
            {header:'性别',dataIndex:'gender',flex:1,renderer:this.renderGender},
            {header:'主要任教学科',dataIndex:'main_subject',
				renderer : function(value, metaData, record) { // #2
					var coursesStore = Ext.getStore('courses.CoursesList');
					//var str=String(value).substring(0,7);
					//console.log(str);
					var course = coursesStore.findRecord('id', value);
					return course != null ? course.get('course_name') : value;
				}}
 
            
        ];
        this.bbar = Ext.create('Ext.PagingToolbar', {  
            store: this.store,  
            displayInfo: true,  
            displayMsg: '显示 {0} - {1} 共计 {2}',  
            emptyMsg: '没有记录',  
            items:[  
                '-', {  
                xtype: 'button',      
                text: '添加',  
                pressed: true,
                id:'add_user',
                enableToggle: true  
            },
            {  
                xtype: 'button',      
                text: '删除',  
                pressed: true,
                id:'delete_user',
                enableToggle: true  
            }]  
        });  

        this.callParent(arguments);
    }
});