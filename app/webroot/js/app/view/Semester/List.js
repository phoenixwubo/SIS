Ext.define('SIS.view.semester.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.semesterlist',

    title: 'All Semesters',
    store:'Semesters',
    autoload:true,
    stripeRows: true,
    dockedItems: [
                  {
                      xtype: 'addeditdelete'
                  }
              ],    
    renderCurrent:function(value){
	if(value==true){
		return "是";

	}else{
		return "否";
	}
	},	
	//设置每页显示数量
	setLimit:function(){
		console.log(this.store.pageSize);
	},

//    dockedItems: [
//                  {
//                      xtype: 'addeditdelete'
//                  }
//              ],
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
            {header: '开始年份',  dataIndex: 'year',  flex: 1},            
            {header: '名称',  dataIndex: 'sem_name',  flex: 1},
            {header:'学期序号',dataIndex:'sem_number'},
            {header:'当前学期',dataIndex:'current',flex:1,renderer:this.renderCurrent},
 
            
        ];
        this.bbar = Ext.create('Ext.PagingToolbar', {  
            store: this.store,  
            displayInfo: true,  
            displayMsg: '显示 {0} - {1} 共计 {2}',  
            emptyMsg: '没有记录', 
        });  

        this.callParent(arguments);
    }
});