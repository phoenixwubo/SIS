Ext.define('SIS.view.elective.ElectiveLesson' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.electivelesson',

    title: '选修课程计划',
    store:'electives.ElectiveLessons',
    autoload:true,
//    stripeRows: true,
    dockedItems: [
                  {
                      xtype: 'addeditdelete'
                  }
              ],    

    initComponent: function() {
		
        this.columns = [
            {header:'学期',dataIndex:'sem_name',flex:1},
            {header:'年级',dataIndex:'department_id',
            	renderer : function(value, metaData, record) { // #2
					var usersStore = Ext.getStore('departments.DepartmentsList');
					var user = usersStore.findRecord('id', value);
					return user != null ? user.get('dept_name') : value;
				}},
            {	
            	header:'课时数量',
            	dataIndex:'lesson_number',
            }
            
 
            
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